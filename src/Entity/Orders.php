<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: "nc_orders")]
#[ORM\Entity]
class Orders
{
    #[ORM\Column(name: "id", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    private $id;

    #[ORM\Column(name: "account_id_customer", type: "string", length: 255, nullable: true)]
    private $accountIdCustomer;

    #[ORM\Column(name: "calculated_price", type: "decimal", precision: 10, scale: 2, nullable: true)]
    private $calculatedPrice;

    #[ORM\Column(name: "ordered_at", type: "datetime", nullable: true)]
    private $orderedAt;

    #[ORM\Column(name: "payment_created_at", type: "datetime", nullable: true)]
    private $paymentCreatedAt;

    #[ORM\Column(name: "payment_paid_at", type: "datetime", nullable: true)]
    private $paymentPaidAt;

    #[ORM\Column(name: "shipment_created_at", type: "datetime", nullable: true)]
    private $shipmentCreatedAt;

    #[ORM\Column(name: "shipment_shipped_at", type: "datetime", nullable: true)]
    private $shipmentShippedAt;

    #[ORM\Column(name: "invoice_created_at", type: "datetime", nullable: true)]
    private $invoiceCreatedAt;

    #[ORM\Column(name: "invoice_generated_at", type: "datetime", nullable: true)]
    private $invoiceGeneratedAt;

    #[ORM\Column(name: "status", type: "string", length: 255, nullable: true)]
    private $status;
}
