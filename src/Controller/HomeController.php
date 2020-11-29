<?php

declare(strict_types=1);

namespace App\Controller;

use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class HomeController
{
    /**
     * @Route("/", name="home", methods={"GET"})
     * @OA\Info(
     *     version="1.0.0",
     *     title="Vacancy API",
     *     description="HTTP JSON API",
     * ),
     * @OA\Server(
     *     url="http://localhost:8086"
     * ),
     * @OA\Schema(
     *     schema="ErrorModel",
     *     type="object",
     *     @OA\Property(property="error", type="object", nullable=true,
     *         @OA\Property(property="code", type="integer"),
     *         @OA\Property(property="message", type="string")
     *     ),
     *     @OA\Property(property="violations", type="array", nullable=true, @OA\Items(
     *         type="object",
     *         @OA\Property(property="propertyPath", type="string"),
     *         @OA\Property(property="title", type="string")
     *     ))
     * ),
     * @OA\Get(
     *     path="/",
     *     tags={"API"},
     *     description="API Home",
     *     @OA\Response(
     *         response="200",
     *         description="Success response",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="version", type="string")
     *         )
     *     )
     * )
     */
    public function index(): Response
    {
        return new JsonResponse([
            'version' => '1.0'
        ]);
    }
}
