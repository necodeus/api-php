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
    private $id;

    #[ORM\Column(name: "type", type: "string", length: 36, nullable: false)]
    private $type;

    #[ORM\Column(name: "local_path", type: "string", length: 255, nullable: false)]
    private $localPath;

    #[ORM\Column(name: "remote_path", type: "string", length: 255, nullable: false)]
    private $remotePath;

    #[ORM\Column(name: "resolution_x", type: "integer", nullable: true)]
    private $resolutionX;

    #[ORM\Column(name: "resolution_y", type: "integer", nullable: true)]
    private $resolutionY;

    #[ORM\Column(name: "size", type: "bigint", nullable: true)]
    private $size;

    #[ORM\Column(name: "mime_type", type: "string", length: 255, nullable: true)]
    private $mimeType;
}
