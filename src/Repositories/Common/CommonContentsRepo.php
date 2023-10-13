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

    public function countContents(): int
    {
        $query = "SELECT
                COUNT(*) as count
            FROM c_contents
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}