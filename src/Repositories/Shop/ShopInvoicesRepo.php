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
}