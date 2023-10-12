<?php 

namespace Repositories\Common;

use Repositories\BaseRepository;

class CommonContentsRepo extends BaseRepository
{
    public function getContents(): array
    {
        $query = "SELECT *
            FROM c_contents
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }
}