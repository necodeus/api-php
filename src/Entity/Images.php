<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: "nc_images")]
#[ORM\Entity]
class Images
{
    #[ORM\Column(name: "id", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    public $id;

    #[ORM\Column(name: "type", type: "string", length: 36, nullable: false)]
    public $type;

    #[ORM\Column(name: "local_path", type: "string", length: 255, nullable: false)]
    public $localPath;

    #[ORM\Column(name: "remote_path", type: "string", length: 255, nullable: false)]
    public $remotePath;

    #[ORM\Column(name: "resolution_x", type: "integer", nullable: true)]
    public $resolutionX;

    #[ORM\Column(name: "resolution_y", type: "integer", nullable: true)]
    public $resolutionY;

    #[ORM\Column(name: "size", type: "bigint", nullable: true)]
    public $size;

    #[ORM\Column(name: "mime_type", type: "string", length: 255, nullable: true)]
    public $mimeType;
}
