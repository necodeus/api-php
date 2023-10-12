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
}