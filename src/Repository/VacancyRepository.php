<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Vacancy\Vacancy;
use App\Exception\VacancyNotFound;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

final class VacancyRepository
{
    private EntityManagerInterface $em;
    private EntityRepository $repository;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        /** @var EntityRepository $repository */
        $repository = $this->em->getRepository(Vacancy::class);
        $this->repository = $repository;
    }

    public function getList(): array
    {
        return $this->repository->findAll();
    }

    /**
     * @param string $id
     * @return Vacancy
     * @throws VacancyNotFound
     */
    public function getById(string $id): Vacancy
    {
        if (!$vacancy = $this->findById($id))  {
            throw new VacancyNotFound();
        }

        return $vacancy;
    }

    public function findById(string $id): ?Vacancy
    {
        /** @var Vacancy $vacancy */
        $vacancy = $this->repository->find($id);
        return $vacancy;
    }
}
