<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\CustomIdGenerator;
use Symfony\Component\Uid\Uuid;


#[ORM\Table(name: "nc_accounts")]
#[ORM\Entity]
class Accounts
{
    #[ORM\Id]
    #[ORM\Column(type: "string", unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[CustomIdGenerator(class: \App\Generator\UUIDv4Generator::class)]
    public string $id;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    public $name;

    #[ORM\Column(type: "string", length: 255, nullable: false, unique: true)]
    public $email;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    public $phone;

    #[ORM\Column(type: "datetime", nullable: false)]
    public $createdAt;

    #[ORM\Column(type: "boolean", nullable: false)]
    public $isVerified;

    #[ORM\Column(type: "string", length: 36, nullable: true, options: ["fixed" => true])]
    public $authkeyId;

    #[ORM\Column(type: "string", length: 36, nullable: true, options: ["fixed" => true])]
    public $roleId;

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function isIsVerified(): ?bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getAuthkeyId(): ?string
    {
        return $this->authkeyId;
    }

    public function setAuthkeyId(?string $authkeyId): static
    {
        $this->authkeyId = $authkeyId;

        return $this;
    }

    public function getRoleId(): ?string
    {
        return $this->roleId;
    }

    public function setRoleId(?string $roleId): static
    {
        $this->roleId = $roleId;

        return $this;
    }
}
