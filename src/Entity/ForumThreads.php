<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: "nc_forum_threads")]
#[ORM\Entity]
class ForumThreads
{
    #[ORM\Column(name: "id", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    private $id;

    #[ORM\Column(name: "lp", type: "integer", nullable: true)]
    private $lp;

    #[ORM\Column(name: "rp", type: "integer", nullable: true)]
    private $rp;

    #[ORM\Column(name: "name", type: "string", length: 255, nullable: true)]
    private $name;
}
