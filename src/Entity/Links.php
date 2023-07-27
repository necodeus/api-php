<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: "nc_links")]
#[ORM\Entity]
class Links
{
    #[ORM\Column(name: "id", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    private $id;

    #[ORM\Column(name: "http_req_method", type: "string", length: 36, nullable: false)]
    private $httpReqMethod;

    #[ORM\Column(name: "http_req_uri", type: "string", length: 2048, nullable: false)]
    private $httpReqUri;

    #[ORM\Column(name: "http_res_status_code", type: "integer", nullable: false)]
    private $httpResStatusCode;

    #[ORM\Column(name: "content_type", type: "string", length: 36, nullable: false)]
    private $contentType;

    #[ORM\Column(name: "content_id", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    private $contentId;

    #[ORM\Column(name: "created_at", type: "datetime", nullable: false)]
    private $createdAt;
}
