<?php 

namespace Repositories\Common;

use Repositories\BaseRepository;

class CommonFragmentsRepo extends BaseRepository
{
    public function getFragments(): array
    {
        $query = "SELECT *
            FROM c_fragments
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }
}