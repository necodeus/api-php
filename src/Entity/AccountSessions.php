<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: "nc_account_sessions")]
#[ORM\Entity]
class AccountSessions
{
    #[ORM\Column(name: "id", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    private $id;

    #[ORM\Column(name: "account_id", type: "string", length: 36, nullable: true, options: ["fixed" => true])]
    private $accountId;

    #[ORM\Column(name: "key", type: "string", length: 255, nullable: true)]
    private $key;

    #[ORM\Column(name: "ua", type: "string", length: 255, nullable: true)]
    private $ua;

    #[ORM\Column(name: "ip", type: "string", length: 255, nullable: true)]
    private $ip;

    #[ORM\Column(name: "created_at", type: "datetime", nullable: true)]
    private $createdAt;

    #[ORM\Column(name: "accessed_at", type: "datetime", nullable: true)]
    private $accessedAt;
}
