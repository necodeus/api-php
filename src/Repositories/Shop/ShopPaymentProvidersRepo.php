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

    public function countPaymentProviders(): int
    {
        $query = "SELECT
                COUNT(*) as count
            FROM s_payment_providers
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}