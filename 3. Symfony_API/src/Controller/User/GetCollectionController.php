<?php

namespace App\Controller\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetCollectionController extends AbstractController
{
    public function __construct (
        private readonly EntityManagerInterface $entityManager
    ) {}

    public function __invoke(mixed $data): JsonResponse
    {
        $users = $this->entityManager->getRepository(User::class)->findAll();

        $usersArr = ["items"=>[]];

        foreach ($users as &$user){
            $usersArr["items"][] = ["id" => $user->getId(),
                                    "name" => $user->getName(),
                                    "email" => $user->getEmail(),
                                    "username" => $user->getUsername(),
                                    "password" => $user->getPassword()];
        }

        return new JsonResponse($usersArr, 200);
    }
}