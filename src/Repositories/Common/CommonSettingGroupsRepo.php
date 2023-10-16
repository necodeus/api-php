<?php

namespace Repositories\Common;

use Repositories\BaseRepositoryInterface;
use Repositories\BaseRepository;

use loophp\collection\Collection;

class CommonSettingGroupsRepo extends BaseRepository implements BaseRepositoryInterface
{
    public function getAll(int $page = 1, int $limit = 10): Collection
    {
        $query = "SELECT *
            FROM c_setting_groups
        ";

        $result = $this->db->fetchAll($query);

        return Collection::fromIterable($result);
    }

    public function count(): int
    {
        $query = "SELECT
                COUNT(*) as count
            FROM c_setting_groups
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}