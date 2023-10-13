<?php 

namespace Repositories\Shop;

use Repositories\BaseRepository;

class ShopProductCategoriesRepo extends BaseRepository
{
    public function getProductCategories(): array
    {
        $query = "SELECT *
            FROM s_product_categories
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }

    public function countProductCategories(): int
    {
        $query = "SELECT
                COUNT(*) as count
            FROM s_product_categories
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}