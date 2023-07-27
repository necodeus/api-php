<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: "nc_comments")]
#[ORM\Entity]
class Comments
{
    #[ORM\Column(name: "id", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    private $id;

    #[ORM\Column(name: "data", type: "text", length: 65535, nullable: false)]
    private $data;

    #[ORM\Column(name: "content_id", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    private $contentId;

    #[ORM\Column(name: "account_id_author", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    private $accountIdAuthor;

    #[ORM\Column(name: "created_at", type: "datetime", nullable: false)]
    private $createdAt;
}
