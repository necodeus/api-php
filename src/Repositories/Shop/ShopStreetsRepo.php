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
}