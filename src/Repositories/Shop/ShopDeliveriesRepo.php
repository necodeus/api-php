<?php 

namespace Repositories\Shop;

use Repositories\BaseRepository;

class ShopDeliveriesRepo extends BaseRepository
{
    public function getDeliveries(): array
    {
        $query = "SELECT *
            FROM s_deliveries
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }

    public function countDeliveries(): int
    {
        $query = "SELECT
                COUNT(*) as count
            FROM s_deliveries
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}