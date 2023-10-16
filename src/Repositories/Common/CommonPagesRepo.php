<?php

namespace Repositories\Common;

use Repositories\BaseRepositoryInterface;
use Repositories\BaseRepository;

use loophp\collection\Collection;

class CommonPagesRepo extends BaseRepository implements BaseRepositoryInterface
{
    public function getAll(int $page = 1, int $limit = 10): Collection
    {
        $offset = ($page - 1) * $limit;

        $query = "SELECT *
            FROM c_pages
            LIMIT $limit OFFSET $offset
        ";

        $result = $this->db->fetchAll($query);

        return Collection::fromIterable($result);
    }

    public function getPageBySlug(string $slug): array
    {
        $query = "SELECT *
            FROM c_pages
            WHERE
                slug = :slug
        ";

        $result = $this->db->fetch($query, ['slug' => $slug]);

        return $result;
    }

    public function count(): int
    {
        $query = "SELECT
                COUNT(*) as count
            FROM c_pages
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}