<?php

namespace Repositories\Shop;

use Repositories\BaseRepository;

use loophp\collection\Collection;

class ShopParcelLockersRepo extends BaseRepository
{
    public function getAll(int $page = 1, int $limit = 10): Collection
    {
        $offset = ($page - 1) * $limit;

        $query = "SELECT *
            FROM s_parcel_lockers
            LIMIT $limit OFFSET $offset
        ";

        $result = $this->db->fetchAll($query);

        return Collection::fromIterable($result);
    }

    public function count(): int
    {
        $query = "SELECT
                COUNT(*) as count
            FROM s_parcel_lockers
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}