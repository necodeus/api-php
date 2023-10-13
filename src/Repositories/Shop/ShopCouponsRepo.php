<?php 

namespace Repositories\Shop;

use Repositories\BaseRepository;

class ShopCouponsRepo extends BaseRepository
{
    public function getCoupons(): array
    {
        $query = "SELECT *
            FROM s_coupons
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }

    public function countCoupons(): int
    {
        $query = "SELECT
                COUNT(*) as count
            FROM s_coupons
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}