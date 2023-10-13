<?php 

namespace Repositories\Common;

use Repositories\BaseRepository;

class CommonContentsFragmentsRepo extends BaseRepository
{
    public function getContentsFragments(): array
    {
        $query = "SELECT *
            FROM c_contents_fragments
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }

    public function countContentsFragments(): int
    {
        $query = "SELECT
                COUNT(*) as count
            FROM c_contents_fragments
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}