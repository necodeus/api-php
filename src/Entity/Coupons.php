<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

class Coupons
{
    #[ORM\Column(name: "id", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    private $id;

    #[ORM\Column(name: "code", type: "string", length: 255, nullable: true)]
    private $code;

    #[ORM\Column(name: "created_at", type: "datetime", nullable: true)]
    private $createdAt;

    #[ORM\Column(name: "account_id_creator", type: "string", length: 36, nullable: true, options: ["fixed" => true])]
    private $accountIdCreator;

    #[ORM\Column(name: "discount_type", type: "string", length: 36, nullable: true, options: ["fixed" => true])]
    private $discountType;
}
