<?php

namespace Repositories\Blog;

use Repositories\BaseRepositoryInterface;
use Repositories\BaseRepository;

use loophp\collection\Collection;

class BlogCommentsRepo extends BaseRepository implements BaseRepositoryInterface
{
    public function getAll(int $page = 1, int $limit = 10): Collection
    {
        $offset = ($page - 1) * $limit;

        $query = "SELECT *
            FROM b_comments
            LIMIT $limit OFFSET $offset
        ";

        $result = $this->db->fetchAll($query);

        return Collection::fromIterable($result);
    }

    public function getCommentById(string $id): array
    {
        $query = "SELECT
                *
            FROM b_comments
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
            FROM b_comments
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}