<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: "nc_complaints")]
#[ORM\Entity]
class Complaints
{
    #[ORM\Column(name: "id", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    private $id;

    #[ORM\Column(name: "order_id", type: "string", length: 36, nullable: true, options: ["fixed" => true])]
    private $orderId;

    #[ORM\Column(name: "product_id", type: "integer", nullable: true)]
    private $productId;

    #[ORM\Column(name: "reason", type: "string", length: 2048, nullable: true)]
    private $reason;

    #[ORM\Column(name: "created_at", type: "datetime", nullable: true)]
    private $createdAt;

    #[ORM\Column(name: "account_id_creator", type: "string", length: 36, nullable: true, options: ["fixed" => true])]
    private $accountIdCreator;
}
