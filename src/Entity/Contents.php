<?php

namespace App\Entity;

use Doctrine\ORM\EntityManagerInterface;
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

    #[ORM\Column(name: "title", type: "string", length: 64, nullable: true)]
    public $title;

    #[ORM\Column(name: "teaser", type: "string", length: 256, nullable: true)]
    public $teaser;

    #[ORM\Column(name: "image_id_main", type: "string", length: 36, nullable: true)]
    public $imageIdMain;

    public $mainImageUrl = null;

    public function getMainImageUrl(): string
    {
        $protocol = @$_SERVER['HTTPS'] ? 'https' : 'http';

        if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
            return "{$protocol}://images.localhost/{$this->imageIdMain}";
        }

        return "{$protocol}://images.necodeo.com/{$this->imageIdMain}";
    }

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

    public ?Links $link = null;

    public function getLink(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Links::class);

        $links = $repository->findOneBy([
            'contentId' => $this->id,
        ]);

        return $links;
    }
}
