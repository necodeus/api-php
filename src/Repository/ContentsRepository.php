<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

use App\Entity\Contents;

class ContentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contents::class);
    }

    public function findOneBy(array $criteria, array $orderBy = null): ?Contents
    {
        /** @var Contents $result */
        $result = parent::findOneBy($criteria, $orderBy);

        if ($result) {
            $result->mainImageUrl = $result->getMainImageUrl();
        }

        return $result;
    }

    public function findAll(): array
    {
        /** @var Contents[] $result */
        $result = parent::findAll();

        foreach ($result as $item) {
            $item->mainImageUrl = $item->getMainImageUrl();
            $item->link = $item->getLink($this->getEntityManager());
        }

        return $result;
    }
}
