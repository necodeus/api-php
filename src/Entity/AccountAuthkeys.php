<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NcAccountAuthkeys
 *
 * @ORM\Table(name="nc_account_authkeys")
 * @ORM\Entity
 */
class AccountAuthkeys
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=36, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="account_id", type="string", length=36, nullable=false)
     */
    private $accountId;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=256, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="key", type="string", length=1024, nullable=false)
     */
    private $key;


}
