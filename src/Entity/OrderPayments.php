<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: "nc_order_payments")]
#[ORM\Entity]
class OrderPayments
{
    #[ORM\Column(name: "id", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    private $id;

    #[ORM\Column(name: "order_id", type: "string", length: 36, nullable: true, options: ["fixed" => true])]
    private $orderId;

    #[ORM\Column(name: "payment_provider_id", type: "string", length: 36, nullable: true, options: ["fixed" => true])]
    private $paymentProviderId;

    #[ORM\Column(name: "value", type: "float", precision: 10, scale: 0, nullable: true)]
    private $value;

    #[ORM\Column(name: "status", type: "string", length: 255, nullable: true)]
    private $status;

    #[ORM\Column(name: "created_at", type: "datetime", nullable: true)]
    private $createdAt;

    #[ORM\Column(name: "paid_at", type: "datetime", nullable: true)]
    private $paidAt;
}
