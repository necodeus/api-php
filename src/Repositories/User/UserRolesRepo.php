<?php 

namespace Repositories\User;

use Repositories\BaseRepository;

class UserRolesRepo extends BaseRepository
{
    public function getRoles(): array
    {
        $query = "SELECT *
            FROM u_roles
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }
}