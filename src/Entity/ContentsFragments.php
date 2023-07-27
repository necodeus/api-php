<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: "nc_contents_fragments")]
#[ORM\Entity]
class ContentsFragments
{
    #[ORM\Column(name: "id", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    private $id;

    #[ORM\Column(name: "content_id", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    private $contentId;

    #[ORM\Column(name: "fragment_id", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    private $fragmentId;

    #[ORM\Column(name: "order", type: "integer", nullable: false)]
    private $order;
}
