<?php 

namespace Repositories\Shop;

use Repositories\BaseRepository;

class ShopCouriersRepo extends BaseRepository
{
    public function getCouriers(): array
    {
        $query = "SELECT *
            FROM s_couriers
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }

    public function countCouriers(): int
    {
        $query = "SELECT
                COUNT(*) as count
            FROM s_couriers
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}