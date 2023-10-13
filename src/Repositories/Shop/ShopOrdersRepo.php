<?php 

namespace Repositories\Shop;

use Repositories\BaseRepository;

class ShopOrdersRepo extends BaseRepository
{
    public function getOrders(): array
    {
        $query = "SELECT *
            FROM s_orders
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }

    public function countOrders(): int
    {
        $query = "SELECT
                COUNT(*) as count
            FROM s_orders
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}