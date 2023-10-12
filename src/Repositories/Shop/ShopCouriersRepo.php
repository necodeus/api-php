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
}