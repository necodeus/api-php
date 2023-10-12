<?php 

namespace Repositories\Shop;

use Repositories\BaseRepository;

class ShopPaymentsRepo extends BaseRepository
{
    public function getPayments(): array
    {
        $query = "SELECT *
            FROM s_payments
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }
}