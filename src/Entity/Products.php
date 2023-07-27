<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: "nc_products")]
#[ORM\Entity]
class Products
{
    #[ORM\Column(name: "id", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    // #[ORM\GeneratedValue(strategy: "UUID")]
    // #[ORM\CustomIdGenerator(class: "Ramsey\Uuid\Doctrine\UuidGenerator")]
    private $id;

    #[ORM\Column(name: "name", type: "string", length: 255, nullable: true)]
    private $name;

    #[ORM\Column(name: "price", type: "decimal", precision: 10, scale: 2, nullable: true)]
    private $price;

    #[ORM\Column(name: "quantity", type: "integer", nullable: true)]
    private $quantity;

    #[ORM\Column(name: "dimension_x", type: "float", precision: 10, scale: 0, nullable: true)]
    private $dimensionX;

    #[ORM\Column(name: "dimension_y", type: "float", precision: 10, scale: 0, nullable: true)]
    private $dimensionY;

    #[ORM\Column(name: "dimension_z", type: "float", precision: 10, scale: 0, nullable: true)]
    private $dimensionZ;

    #[ORM\Column(name: "weight", type: "float", precision: 10, scale: 0, nullable: true)]
    private $weight;

    #[ORM\Column(name: "gtin", type: "string", length: 255, nullable: true)]
    private $gtin;

    #[ORM\Column(name: "brand", type: "string", length: 255, nullable: true)]
    private $brand;
}
