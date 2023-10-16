<?php

namespace Repositories\Common;

use Repositories\BaseRepositoryInterface;
use Repositories\BaseRepository;

use loophp\collection\Collection;

class CommonRedirectionsRepo extends BaseRepository implements BaseRepositoryInterface
{
    public function getAll(int $page = 1, int $limit = 10): Collection
    {
        $offset = ($page - 1) * $limit;

        $query = "SELECT *
            FROM c_redirections
            LIMIT $limit OFFSET $offset
        ";

        $result = $this->db->fetchAll($query);

        return Collection::fromIterable($result);
    }

    public function getRedirectionById(string $id): array
    {
        $query = "SELECT *
            FROM c_redirections
            WHERE
                id = :id
        ";

        $result = $this->db->fetch($query, ['id' => $id]);

        return $result;
    }

    public function count(): int
    {
        $query = "SELECT
                COUNT(*) as count
            FROM c_redirections
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}