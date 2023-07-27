<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: "doctrine_migration_versions")]
#[ORM\Entity]
class DoctrineMigrationVersions
{
    #[ORM\Column(name: "version", type: "string", length: 191, nullable: false)]
    private $version;

    #[ORM\Column(name: "executed_at", type: "datetime", nullable: true)]
    private $executedAt;

    #[ORM\Column(name: "execution_time", type: "integer", nullable: true)]
    private $executionTime;
}
