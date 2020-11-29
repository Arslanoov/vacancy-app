<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Vacancy\Vacancy;
use App\Repository\VacancyRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class VacancyController
{
    private VacancyRepository $vacancies;

    public function __construct(VacancyRepository $vacancies)
    {
        $this->vacancies = $vacancies;
    }

    /**
     * @Route("/vacancies", name="vacancies", methods={"GET"})
     * @return Response
     */
    public function index(): Response
    {
        return new JsonResponse($this->vacancies($this->vacancies->getList()));
    }

    /**
     * @param array<Vacancy> $vacancies
     * @return array<array>
     */
    private function vacancies(array $vacancies): array
    {
        return array_map(function (Vacancy $vacancy) {
            return [
                'id' => $vacancy->getId(),
                'name' => $vacancy->getName(),
                'description' => $vacancy->getDescription()
            ];
        }, $vacancies);
    }
}
