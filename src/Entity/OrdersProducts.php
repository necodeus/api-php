<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: "nc_orders_products")]
#[ORM\Entity]
class OrdersProducts
{
    #[ORM\Column(name: "id", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    private $id;

    #[ORM\Column(name: "order_id", type: "string", length: 36, nullable: true, options: ["fixed" => true])]
    private $orderId;

    #[ORM\Column(name: "product_id", type: "string", length: 36, nullable: true, options: ["fixed" => true])]
    private $productId;

    #[ORM\Column(name: "quantity", type: "integer", nullable: true)]
    private $quantity;
}
