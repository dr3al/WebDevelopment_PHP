<?php

namespace App\Controller\User;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class DeleteController extends AbstractController
{
    public function __construct (
        private readonly EntityManagerInterface $entityManager,
    ) {}

    public function __invoke(mixed $data): JsonResponse
    {
        $this->entityManager->remove($data);
        $this->entityManager->flush();

        return new JsonResponse(["message" => "Пользователь удален."], 200);
    }
}