<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: "nc_fragments")]
#[ORM\Entity]
class Fragments
{
    #[ORM\Column(name: "id", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    private $id;

    #[ORM\Column(name: "type", type: "string", length: 36, nullable: false)]
    private $type;

    #[ORM\Column(name: "data", type: "text", length: 65535, nullable: false)]
    private $data;

    #[ORM\Column(name: "created_at", type: "datetime", nullable: false)]
    private $createdAt;

    #[ORM\Column(name: "modified_at", type: "datetime", nullable: false)]
    private $modifiedAt;

    #[ORM\Column(name: "account_id_author", type: "string", length: 36, nullable: true, options: ["fixed" => true])]
    private $accountIdAuthor;
}
