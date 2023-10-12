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
}