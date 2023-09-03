<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

use App\Entity\AccountProfiles;

class AccountProfilesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AccountProfiles::class);
    }

    public function findOneBy(array $criteria, array $orderBy = null): ?AccountProfiles
    {
        /** @var AccountProfiles $result */
        $result = parent::findOneBy($criteria, $orderBy);

        if ($result) {
            $result->avatarUrl = $result->getAvatarUrl();
        }

        return $result;
    }
}
