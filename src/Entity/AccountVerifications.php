<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: "nc_account_verifications")]
#[ORM\Entity]
class AccountVerifications
{
    #[ORM\Column(name: "id", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    private $id;

    #[ORM\Column(name: "account_id", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    private $accountId;

    #[ORM\Column(name: "type", type: "string", length: 255, nullable: false)]
    private $type;

    #[ORM\Column(name: "code", type: "string", length: 255, nullable: false)]
    private $code;

    #[ORM\Column(name: "created_at", type: "datetime", nullable: false)]
    private $createdAt;

    #[ORM\Column(name: "verified_at", type: "datetime", nullable: false)]
    private $verifiedAt;
}
