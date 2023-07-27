<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: "nc_contents")]
#[ORM\Entity]
class Contents
{
    #[ORM\Column(name: "id", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    private $id;

    #[ORM\Column(name: "cached_fragments", type: "text", length: 65535, nullable: true)]
    private $cachedFragments;

    #[ORM\Column(name: "account_id_editor", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    private $accountIdEditor;

    #[ORM\Column(name: "created_at", type: "datetime", nullable: false)]
    private $createdAt;

    #[ORM\Column(name: "modified_at", type: "datetime", nullable: false)]
    private $modifiedAt;

    #[ORM\Column(name: "account_id_publisher", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    private $accountIdPublisher;

    #[ORM\Column(name: "published_at", type: "datetime", nullable: false)]
    private $publishedAt;
}
