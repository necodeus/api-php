<?php 

namespace Repositories\Shop;

use Repositories\BaseRepository;

class ShopStreetsRepo extends BaseRepository
{
    public function getStreets(): array
    {
        $query = "SELECT *
            FROM s_streets
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }

    public function countStreets(): int
    {
        $query = "SELECT
                COUNT(*) as count
            FROM s_streets
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}