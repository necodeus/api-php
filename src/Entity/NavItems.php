<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: "nc_nav_items")]
#[ORM\Entity]
class NavItems
{
    #[ORM\Column(name: "id", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    private $id;

    #[ORM\Column(name: "nav_group_id", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    private $navGroupId;

    #[ORM\Column(name: "parent_id", type: "string", length: 36, nullable: true, options: ["fixed" => true])]
    private $parentId;

    #[ORM\Column(name: "name", type: "string", length: 255, nullable: true)]
    private $name;

    #[ORM\Column(name: "link_id", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    private $linkId;

    #[ORM\Column(name: "order", type: "integer", nullable: true)]
    private $order;
}
