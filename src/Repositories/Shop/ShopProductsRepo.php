<?php 

namespace Repositories\Shop;

use Repositories\BaseRepository;

class ShopProductsRepo extends BaseRepository
{
    public function getProducts(): array
    {
        $query = "SELECT *
            FROM s_products
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }
}