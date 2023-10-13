<?php 

namespace Repositories\User;

use Repositories\BaseRepository;

class UserAccountsRepo extends BaseRepository
{
    public function getAccounts(): array
    {
        $query = "SELECT *
            FROM u_accounts
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }

    public function countAccounts(): int
    {
        $query = "SELECT
                COUNT(*) as count
            FROM u_accounts
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}