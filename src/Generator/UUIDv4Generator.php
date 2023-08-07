<?php

namespace App\Generator;

use Doctrine\ORM\Id\AbstractIdGenerator;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Uid\Factory\UuidFactory;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Uid\UuidV4;

class UUIDv4Generator extends AbstractIdGenerator
{
    public function generateId($em, $entity)
    {
        $factory = new UuidFactory(UuidV4::class);

        return $factory->create();
    }
}