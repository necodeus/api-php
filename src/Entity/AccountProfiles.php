<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AccountProfiles
 *
 * @ORM\Table(name="nc_account_profiles")
 * @ORM\Entity
 */
class AccountProfiles
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=36, nullable=false, options={"fixed"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="account_id", type="string", length=36, nullable=false, options={"fixed"=true})
     */
    private $accountId;

    /**
     * @var string
     *
     * @ORM\Column(name="display_name", type="string", length=255, nullable=false)
     */
    private $displayName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="bio", type="string", length=255, nullable=true)
     */
    private $bio;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="birthdate", type="date", nullable=true)
     */
    private $birthdate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image_id_avatar", type="string", length=36, nullable=true, options={"fixed"=true})
     */
    private $imageIdAvatar;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image_id_background", type="string", length=36, nullable=true, options={"fixed"=true})
     */
    private $imageIdBackground;

    /**
     * @var string|null
     *
     * @ORM\Column(name="link_id", type="string", length=36, nullable=true, options={"fixed"=true})
     */
    private $linkId;


}
