<?php 

namespace Repositories\Shop;

use Repositories\BaseRepository;

class ShopReturnsRepo extends BaseRepository
{
    public function getReturns(): array
    {
        $query = "SELECT *
            FROM s_returns
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }
}