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

    public function countFragments(): int
    {
        $query = "SELECT
                COUNT(*) as count
            FROM c_fragments
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}