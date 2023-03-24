<?php

namespace App\Controller\User;

use ApiPlatform\Validator\ValidatorInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class PutController extends AbstractController
{
    public function __construct (
        private readonly EntityManagerInterface $entityManager,
        private readonly ValidatorInterface     $validator,
    ) {}

    public function __invoke(User $user): JsonResponse
    {
        $this->validator->validate($user);
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return new JsonResponse(["message" => "Пользователь изменен."], 200);
    }
}