<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: "nc_categories_product_attributes")]
#[ORM\Entity]
class CategoriesProductAttributes
{
    #[ORM\Column(name: "id", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    private $id;

    #[ORM\Column(name: "category_id", type: "string", length: 36, nullable: true, options: ["fixed" => true])]
    private $categoryId;

    #[ORM\Column(name: "product_attribute_id", type: "string", length: 36, nullable: true, options: ["fixed" => true])]
    private $productAttributeId;
}
