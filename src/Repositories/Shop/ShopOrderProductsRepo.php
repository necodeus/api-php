<?php 

namespace Repositories\Shop;

use Repositories\BaseRepository;

class ShopOrderProductsRepo extends BaseRepository
{
    public function getOrderProducts(): array
    {
        $query = "SELECT *
            FROM s_order_products
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }

    public function countOrderProducts(): int
    {
        $query = "SELECT
                COUNT(*) as count
            FROM s_order_products
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}