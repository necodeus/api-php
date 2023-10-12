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
}