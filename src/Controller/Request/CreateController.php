<?php

declare(strict_types=1);

namespace App\Controller\Request;

use App\Exception\VacancyNotFound;
use App\Entity\Vacancy\Request as VacancyRequest;
use App\Repository\VacancyRepository;
use Doctrine\ORM\EntityManagerInterface;
use JsonException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class CreateController
{
    private VacancyRepository $vacancies;
    private ValidatorInterface $validator;
    private EntityManagerInterface $em;

    public function __construct(VacancyRepository $vacancies, ValidatorInterface $validator, EntityManagerInterface $em)
    {
        $this->vacancies = $vacancies;
        $this->validator = $validator;
        $this->em = $em;
    }

    /**
     * @Route("/vacancy/{vacancyId}/request", name="vacancy.request", methods={"POST"})
     * @param string $vacancyId
     * @param Request $request
     * @throws JsonException
     * @return Response
     */
    public function create(string $vacancyId, Request $request): Response
    {
        try {
            $vacancy = $this->vacancies->getById($vacancyId);
        } catch (VacancyNotFound $e) {
            return new Response($e->getMessage(), Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $violationList = $this->validator->validate($data, new Assert\Collection([
            'full_name' => [
                new Assert\NotBlank(),
                new Assert\Type('string'),
                new Assert\Length(['max' => 255])
            ],
            'birthday_date' => [
                new Assert\NotBlank(),
                new Assert\Type('string'),
                new Assert\Regex('~^([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))$~')
            ],
            'gender' => [
                new Assert\NotBlank(),
                new Assert\Type('string'),
                new Assert\Choice(['choices' => ['male', 'female']])
            ],
            'phone' => [
                new Assert\NotBlank(),
                new Assert\Type('string'),
                new Assert\Regex('~^((7|8)+([0-9]){10})$~')
            ],
            'cv_file' => new Assert\Optional([
                new Assert\NotBlank(),
                new Assert\Type('string'),
                new Assert\Length(['max' => 255])
            ]),
            'cv_description' => new Assert\Optional([
                new Assert\NotBlank(),
                new Assert\Type('string'),
                new Assert\Length(['max' => 255]),
            ])
        ]));

        if ($violationList->count()) {
            $violations = [];

            foreach ($violationList as $violation) {
                $violations[] = [
                    'path' => $violation->getPropertyPath(),
                    'error' => $violation->getMessage(),
                ];
            }

            return new JsonResponse([
                'errors' => $violations
            ]);
        }

        $vacancyRequest =
            (new VacancyRequest())
            ->setVacancy($vacancy)
            ->setFullName($data['full_name'])
            ->setBirthdayDate($data['birthday_date'])
            ->setGender($data['gender'])
            ->setPhone($data['phone'])
            ->setCvFile($data['cv_file'] ?? null)
            ->setCvDescription($data['cv_description'] ?? null)
        ;

        $this->em->persist($vacancyRequest);
        $this->em->flush();

        return new JsonResponse([], 201);
    }
}
