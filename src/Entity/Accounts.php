<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: "nc_accounts")]
#[ORM\Entity]
class Accounts
{
    #[ORM\Column(name: "id", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    private $id;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    public $name;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    private $email;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    private $phone;

    #[ORM\Column(type: "datetime", nullable: false)]
    private $createdAt;

    #[ORM\Column(type: "boolean", nullable: false)]
    private $isVerified;

    #[ORM\Column(type: "string", length: 36, nullable: true, options: ["default" => "DEFAULT", "fixed" => true])]
    private $authkeyId = 'DEFAULT';

    #[ORM\Column(type: "string", length: 36, nullable: true, options: ["fixed" => true])]
    private $roleId;

    public function getData(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'createdAt' => $this->createdAt->format('Y-m-d H:i:s'),
            'isVerified' => $this->isVerified,
            'authkeyId' => $this->authkeyId,
            'roleId' => $this->roleId,
        ];
    }
}
