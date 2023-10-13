<?php 

namespace Repositories\User;

use Repositories\BaseRepository;

class UserAuthorizationsRepo extends BaseRepository
{
    public function getAuthorizations(): array
    {
        $query = "SELECT *
            FROM u_authorizations
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }

    public function countAuthorizations(): int
    {
        $query = "SELECT
                COUNT(*) as count
            FROM u_authorizations
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}