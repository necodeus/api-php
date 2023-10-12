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
}