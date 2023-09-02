<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\CustomIdGenerator;

#[ORM\Table(name: "nc_links")]
#[ORM\Entity]
class Links
{
    #[ORM\Id]
    #[ORM\Column(type: "string", unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[CustomIdGenerator(class: \App\Generator\UUIDv4Generator::class)]
    public string $id;

    #[ORM\Column(name: "http_req_method", type: "string", length: 36, nullable: false)]
    public string $httpReqMethod;

    #[ORM\Column(name: "http_req_uri", type: "string", length: 2048, nullable: false)]
    public string $httpReqUri;

    #[ORM\Column(name: "http_res_status_code", type: "integer", nullable: false)]
    public int $httpResStatusCode;

    #[ORM\Column(name: "content_type", type: "string", length: 36, nullable: false)]
    public string $contentType;

    #[ORM\Column(name: "content_id", type: "string", length: 36, nullable: true, options: ["fixed" => true])]
    public string $contentId;

    #[ORM\Column(name: "created_at", type: "string", nullable: false)]
    public $createdAt;

    #[ORM\Column(name: "extra_data", type: "text", length: 65535, nullable: true)]
    public $extraData;
}
