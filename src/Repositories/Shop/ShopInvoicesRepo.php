<?php 

namespace Repositories\Shop;

use Repositories\BaseRepository;

class ShopInvoicesRepo extends BaseRepository
{
    public function getInvoices(): array
    {
        $query = "SELECT *
            FROM s_invoices
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }

    public function countInvoices(): int
    {
        $query = "SELECT
                COUNT(*) as count
            FROM s_invoices
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}