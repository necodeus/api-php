<?php

namespace Repositories\Blog;

use Repositories\BaseRepositoryInterface;
use Repositories\BaseRepository;

use loophp\collection\Collection;

class BlogTagsRepo extends BaseRepository implements BaseRepositoryInterface
{
    public function getAll(int $page = 1, int $limit = 10): Collection
    {
        $offset = ($page - 1) * $limit;

        $query = "SELECT *
            FROM b_tags
            LIMIT $limit OFFSET $offset
        ";

        $result = $this->db->fetchAll($query);

        return Collection::fromIterable($result);
    }

    public function getTagById(string $id): array
    {
        $query = "SELECT
                *
            FROM b_tags
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
            FROM b_tags
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}