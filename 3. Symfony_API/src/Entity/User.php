<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Controller\User\CreateController;
use App\Controller\User\DeleteController;
use App\Controller\User\GetCollectionController;
use App\Controller\User\GetController;
use App\Controller\User\PatchController;
use App\Controller\User\PutController;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource(operations: [
    new Get(
        uriTemplate: "/user/get/{id}",
        controller: GetController::class
    ),
    new GetCollection(
        uriTemplate: "/user/get",
        controller: GetCollectionController::class),
    new Post(
        uriTemplate: "/user/create",
        controller: CreateController::class,
        normalizationContext: ['groups'=>['create']]
    ),
    new Delete(
        uriTemplate: "/user/delete/{id}",
        controller: DeleteController::class,
    ),
    new Put(
        uriTemplate: "/user/put/{id}",
        controller: PutController::class,
        normalizationContext: ['groups'=>['put']]
    ),
    new Patch(
        uriTemplate: "/user/patch/{id}",
        controller: PatchController::class,
        normalizationContext: ['groups'=>['patch']]
    )
])]

class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['create', 'put', 'patch'])]
    #[ORM\Column(length: 40)]
    private ?string $name = null;

    #[Groups(['create', 'put', 'patch'])]
    #[ORM\Column(length: 50, unique: true)]
    private ?string $email = null;

    #[Groups(['create', 'put', 'patch'])]
    #[ORM\Column(length: 25, unique: true)]
    private ?string $username = null;

    #[Groups(['create', 'put', 'patch'])]
    #[ORM\Column(length: 255)]
    private ?string $password = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
}