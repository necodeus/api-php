<?php 

namespace Repositories\User;

use Repositories\BaseRepository;

class UserSessionsRepo extends BaseRepository
{
    public function getSessions(): array
    {
        $query = "SELECT *
            FROM u_sessions
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }

    public function countSessions(): int
    {
        $query = "SELECT
                COUNT(*) as count
            FROM u_sessions
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}