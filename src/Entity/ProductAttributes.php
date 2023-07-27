<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: "nc_product_attributes")]
#[ORM\Entity]
class ProductAttributes
{
    #[ORM\Column(name: "id", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    private $id;

    #[ORM\Column(name: "name", type: "string", length: 255, nullable: true)]
    private $name;

    #[ORM\Column(name: "description", type: "string", length: 255, nullable: true)]
    private $description;
}
