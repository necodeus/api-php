<?php 

namespace Repositories\Shop;

use Repositories\BaseRepository;

class ShopParcelLockersRepo extends BaseRepository
{
    public function getParcelLockers(): array
    {
        $query = "SELECT *
            FROM s_parcel_lockers
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }

    public function countParcelLockers(): int
    {
        $query = "SELECT
                COUNT(*) as count
            FROM s_parcel_lockers
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}