<?php 

namespace Repositories\Shop;

use Repositories\BaseRepository;

class ShopDiscountTypesRepo extends BaseRepository
{
    public function getDiscountTypes(): array
    {
        $query = "SELECT *
            FROM s_discount_types
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }
}