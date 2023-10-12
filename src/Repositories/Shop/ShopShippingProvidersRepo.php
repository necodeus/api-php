<?php 

namespace Repositories\Shop;

use Repositories\BaseRepository;

class ShopShippingProvidersRepo extends BaseRepository
{
    public function getShippingProviders(): array
    {
        $query = "SELECT *
            FROM s_shipping_providers
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }
}