<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: "nc_discount_types")]
#[ORM\Entity]
class DiscountTypes
{
    #[ORM\Column(name: "id", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    private $id;

    #[ORM\Column(name: "name", type: "string", length: 255, nullable: true)]
    private $name;

    #[ORM\Column(name: "description", type: "string", length: 255, nullable: true)]
    private $description;

    #[ORM\Column(name: "value", type: "float", precision: 10, scale: 0, nullable: true)]
    private $value;
}
