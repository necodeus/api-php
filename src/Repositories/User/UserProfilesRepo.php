<?php 

namespace Repositories\User;

use Repositories\BaseRepository;

class UserProfilesRepo extends BaseRepository
{
    public function getProfiles(): array
    {
        $query = "SELECT *
            FROM u_profiles
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }
}