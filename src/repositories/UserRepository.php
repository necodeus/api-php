<?php

namespace Repositories;

class UserRepository extends BaseRepository
{
    /** ==========================================================
     * P R O F I L E S
     * ======================================================== */

    // public function getProfiles(): array
    // {
    //     return [];
    // }

    // public function getProfileById(string $id): array
    // {
    //     return [];
    // }

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

    // public function getProfilesCount(): int
    // {
    //     return 0;
    // }
}
