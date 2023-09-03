<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\CustomIdGenerator;

#[ORM\Table(name: "nc_account_profiles")]
#[ORM\Entity]
class AccountProfiles
{
    #[ORM\Id]
    #[ORM\Column(type: "string", unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[CustomIdGenerator(class: \App\Generator\UUIDv4Generator::class)]
    public string $id;


    #[ORM\Column(name: "account_id", type: "string", length: 36, nullable: false, options: ["fixed" => true])]
    public $accountId;

    #[ORM\Column(name: "display_name", type: "string", length: 64, nullable: true)]
    public $displayName;

    #[ORM\Column(name: "bio", type: "string", length: 256, nullable: true)]
    public $bio;

    #[ORM\Column(name: "birthdate", type: "string", nullable: true)]
    public $birthdate;

    #[ORM\Column(name: "image_id_avatar", type: "string", length: 36, nullable: true, options: ["fixed" => true])]
    public $imageIdAvatar;

    #[ORM\Column(name: "image_id_background", type: "string", length: 36, nullable: true, options: ["fixed" => true])]
    public $imageIdBackground;

    #[ORM\Column(name: "link_id", type: "string", length: 36, nullable: true, options: ["fixed" => true])]
    public $linkId;

    public $avatarUrl = null;

    public function getAvatarUrl(): string
    {
        $protocol = @$_SERVER['HTTPS'] ? 'https' : 'http';

        $domain = $_SERVER['HTTP_HOST'];
        if (strpos($domain, 'localhost') !== false) {
            $domain = 'localhost';
        } else {
            $domain = 'necodeo.com';
        }

        return "{$protocol}://images.{$domain}/" . $this->imageIdAvatar;
    }
}
