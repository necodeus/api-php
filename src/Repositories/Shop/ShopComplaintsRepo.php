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
}