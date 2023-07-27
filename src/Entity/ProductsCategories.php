<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: "nc_products_categories")]
#[ORM\Entity]
class ProductsCategories
{
    #[ORM\Column(name: "id", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    private $id;

    #[ORM\Column(name: "product_id", type: "string", length: 36, nullable: true, options: ["fixed" => true])]
    private $productId;

    #[ORM\Column(name: "category_id", type: "string", length: 36, nullable: true, options: ["fixed" => true])]
    private $categoryId;
}
