<?php

namespace App\Repository;

use App\Enum\AccountCreationStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

use App\Entity\AccountEntity;

class AccountsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AccountEntity::class);
    }

    public function getPublicAccounts(): array
    {
        $data = $this->createQueryBuilder('a')
            ->select('a.id', 'a.name', 'a.email', 'a.phone', 'a.createdAt', 'a.isVerified', 'a.authkeyId', 'a.roleId')
            ->getQuery()
            ->getResult();

        return array_map(function (array $item) {
            $item['createdAt'] = $item['createdAt']->format('Y-m-d H:i:s');

            return $item;
        }, $data);
    }

    public function createAccount(array $data): array
    {
        $account = $this->findOneBy(['email' => $data['email']]);

        if ($account instanceof AccountEntity) {
            return [
                'status' => AccountCreationStatus::ALREADY_EXISTS,
                'message' => "Account with email {$data['email']} already exists",
            ];
        }

        $account = new AccountEntity();

        $account->setName($data['name']);
        $account->setEmail($data['email']);
        $account->setPhone($data['phone']);
        $account->setCreatedAt(new \DateTime());
        $account->setIsVerified(false);

        $em = $this->getEntityManager();
        $em->persist($account);
        $em->flush();

        if ($account instanceof AccountEntity === false) {
            return [
                'status' => AccountCreationStatus::FAILED,
                'message' => "Account with email {$data['email']} could not be created",
            ];
        }

        return [
            'status' => AccountCreationStatus::SUCCESS,
            'message' => "Account with email {$data['email']} created successfully",
            'data' => $account,
        ];
    }
}
