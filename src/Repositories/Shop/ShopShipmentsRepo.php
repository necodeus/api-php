<?php 

namespace Repositories\Shop;

use Repositories\BaseRepository;

class ShopShipmentsRepo extends BaseRepository
{
    public function getShipments(): array
    {
        $query = "SELECT *
            FROM s_shipments
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }

    public function countShipments(): int
    {
        $query = "SELECT
                COUNT(*) as count
            FROM s_shipments
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}