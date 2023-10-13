<?php 

namespace Repositories\Shop;

use Repositories\BaseRepository;

class ShopComplaintsRepo extends BaseRepository
{
    public function getComplaints(): array
    {
        $query = "SELECT *
            FROM s_complaints
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }

    public function countComplaints(): int
    {
        $query = "SELECT
                COUNT(*) as count
            FROM s_complaints
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}