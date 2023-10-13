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

    public function countPayments(): int
    {
        $query = "SELECT
                COUNT(*) as count
            FROM s_payments
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}