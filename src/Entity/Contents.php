<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\CustomIdGenerator;

use App\Generator\UUIDv4Generator;

#[ORM\Table(name: "nc_contents")]
#[ORM\Entity]
class Contents
{
    #[ORM\Id]
    #[ORM\Column(type: "string", unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[CustomIdGenerator(class: UUIDv4Generator::class)]
    public string $id;

    #[ORM\Column(name: "cached_fragments", type: "text", length: 65535, nullable: true)]
    public $cachedFragments;

    #[ORM\Column(name: "account_id_editor", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    public $accountIdEditor;

    #[ORM\Column(name: "created_at", type: "string", nullable: false)]
    public $createdAt;

    #[ORM\Column(name: "modified_at", type: "string", nullable: false)]
    public $modifiedAt;

    #[ORM\Column(name: "account_id_publisher", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    public $accountIdPublisher;

    #[ORM\Column(name: "published_at", type: "string", nullable: false)]
    public $publishedAt;
}
