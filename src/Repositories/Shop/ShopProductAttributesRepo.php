<?php 

namespace Repositories\Shop;

use Repositories\BaseRepository;

class ShopProductAttributesRepo extends BaseRepository
{
    public function getProductAttributes(): array
    {
        $query = "SELECT *
            FROM s_product_attributes
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }

    public function countProductAttributes(): int
    {
        $query = "SELECT
                COUNT(*) as count
            FROM s_product_attributes
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}