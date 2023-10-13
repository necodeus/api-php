<?php 

namespace Repositories\User;

use Repositories\BaseRepository;

class UserVerificationsRepo extends BaseRepository
{
    public function getVerifications(): array
    {
        $query = "SELECT *
            FROM u_verifications
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }

    public function countVerifications(): int
    {
        $query = "SELECT
                COUNT(*) as count
            FROM u_verifications
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}