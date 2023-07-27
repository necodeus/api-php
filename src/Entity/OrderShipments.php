<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: "nc_order_shipments")]
#[ORM\Entity]
class OrderShipments
{
    #[ORM\Column(name: "id", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    private $id;

    #[ORM\Column(name: "order_id", type: "string", length: 36, nullable: true, options: ["fixed" => true])]
    private $orderId;

    #[ORM\Column(name: "shipping_provider_id", type: "string", length: 36, nullable: true, options: ["fixed" => true])]
    private $shippingProviderId;

    #[ORM\Column(name: "status", type: "string", length: 255, nullable: true)]
    private $status;

    #[ORM\Column(name: "created_at", type: "datetime", nullable: true)]
    private $createdAt;

    #[ORM\Column(name: "shipped_at", type: "datetime", nullable: true)]
    private $shippedAt;
}
