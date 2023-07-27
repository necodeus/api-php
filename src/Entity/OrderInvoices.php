<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: "nc_order_invoices")]
#[ORM\Entity]
class OrderInvoices
{
    #[ORM\Column(name: "id", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    private $id;

    #[ORM\Column(name: "order_id", type: "string", length: 36, nullable: true, options: ["fixed" => true])]
    private $orderId;

    #[ORM\Column(name: "local_path", type: "string", length: 255, nullable: true)]
    private $localPath;

    #[ORM\Column(name: "remote_path", type: "string", length: 255, nullable: true)]
    private $remotePath;

    #[ORM\Column(name: "created_at", type: "datetime", nullable: true)]
    private $createdAt;

    #[ORM\Column(name: "generated_at", type: "datetime", nullable: true)]
    private $generatedAt;
}
