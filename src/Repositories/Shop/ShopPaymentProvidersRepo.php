<?php 

namespace Repositories\Shop;

use Repositories\BaseRepository;

class ShopPaymentProvidersRepo extends BaseRepository
{
    public function getPaymentProviders(): array
    {
        $query = "SELECT *
            FROM s_payment_providers
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }
}