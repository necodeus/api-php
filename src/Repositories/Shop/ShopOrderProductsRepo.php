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
}