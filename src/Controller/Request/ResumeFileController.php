<?php

declare(strict_types=1);

namespace App\Controller\Request;

use App\Service\FileUploader;
use OpenApi\Annotations as OA;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class ResumeFileController
{
    private FileUploader $fileUploader;
    private ValidatorInterface $validator;

    public function __construct(FileUploader $fileUploader, ValidatorInterface $validator)
    {
        $this->fileUploader = $fileUploader;
        $this->validator = $validator;
    }

    /**
     * @Route("/resume/upload", name="resume.upload", methods={"POST"})
     * @OA\Post(
     *     path="/resume/upload",
     *     tags={"Upload resume file"},
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              required={"resume"},
     *              @OA\Property(property="resume", type="string")
     *         ),
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                   property="resume",
     *                   description="Resume File",
     *                   type="file",
     *                   @OA\Items(type="string", format="binary")
     *                )
     *            )
     *        )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Success response"
     *     )
     * )
     * @param Request $request
     * @return Response
     */
    public function upload(Request $request): Response
    {
        $resume = $request->files->get('resume');

        $violationList = $this->validator->validate($resume, [
                new Assert\NotNull(),
                new Assert\File([
                    'mimeTypes' => [
                    'application/msword',
                    'application/pdf',
                    'image/png',
                    'image/jpeg'
                ]])
            ]
        );

        if ($violationList->count()) {
            $violations = [];

            foreach ($violationList as $violation) {
                $violation[] = [
                    'path' => $violation->getPropertyPath(),
                    'error' => $violation->getMessage(),
                ];
            }

            return new JsonResponse([
                'errors' => $violations
            ], Response::HTTP_BAD_REQUEST);
        }

        $url = $this->fileUploader->upload($resume);

        return new JsonResponse([
            'url' => $url
        ]);
    }
}
