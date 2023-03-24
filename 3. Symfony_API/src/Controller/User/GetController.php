<?php

namespace App\Controller\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetController extends AbstractController
{
    public function __construct (
        private readonly EntityManagerInterface $entityManager
    ) {}

    public function __invoke(mixed $data): JsonResponse
    {
        $user = $this->entityManager->getRepository(User::class)->findOneBy([
            'id' => $data->getId()
        ]);

        return new JsonResponse(["id" => $user->getId(),
                                 "name" => $user->getName(),
                                 "email" => $user->getEmail(),
                                 "username" => $user->getUsername(),
                                 "password" => $user->getPassword()], 200);
    }
}
