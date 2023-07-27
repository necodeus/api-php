<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: "nc_product_reviews")]
#[ORM\Entity]
class ProductReviews
{
    #[ORM\Column(name: "id", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    private $id;

    #[ORM\Column(name: "product_id", type: "string", length: 36, nullable: true, options: ["fixed" => true])]
    private $productId;

    #[ORM\Column(name: "account_id_reviewer", type: "string", length: 36, nullable: true, options: ["fixed" => true])]
    private $accountIdReviewer;

    #[ORM\Column(name: "rating", type: "boolean", nullable: true)]
    private $rating;

    #[ORM\Column(name: "comment", type: "string", length: 255, nullable: true)]
    private $comment;
}
