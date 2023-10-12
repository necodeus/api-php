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
}