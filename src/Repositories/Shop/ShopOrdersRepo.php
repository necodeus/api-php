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
}