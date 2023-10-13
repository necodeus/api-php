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

    public function countReturns(): int
    {
        $query = "SELECT
                COUNT(*) as count
            FROM s_returns
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}