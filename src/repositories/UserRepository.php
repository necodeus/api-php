<?php

namespace Repositories;

class UserRepository extends BaseRepository
{
    public function getProfileByAccountId(string $accountId): array
    {
        $query = "SELECT up.*
            FROM u_profiles up
            WHERE up.account_id = :accountId
        ";

        return $this->db->fetch($query, [
            'accountId' => $accountId,
        ]);
    }
}
