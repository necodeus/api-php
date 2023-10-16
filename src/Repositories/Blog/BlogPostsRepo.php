<?php

namespace Repositories\Blog;

use Repositories\BaseRepositoryInterface;
use Repositories\BaseRepository;

use loophp\collection\Collection;

class BlogPostsRepo extends BaseRepository implements BaseRepositoryInterface
{
    public function getAll(int $page = 1, int $limit = 10): Collection
    {
        $offset = ($page - 1) * $limit;

        $query = "SELECT *,
                CONCAT('http://images.localhost/', main_image_id) AS main_image_url
            FROM b_posts
            LIMIT $limit OFFSET $offset
        ";

        $result = $this->db->fetchAll($query);

        return Collection::fromIterable($result);
    }

    public function getPostById(string $id): array
    {
        $prefix = 'http://images.localhost/';

        $query = "SELECT
                *,
                CONCAT(:prefix, main_image_id) AS main_image_url
            FROM b_posts
            WHERE
                id = :id
        ";

        $result = $this->db->fetch($query, ['prefix' => $prefix, 'id' => $id]);

        return $result;
    }

    public function count(): int
    {
        $query = "SELECT
                COUNT(*) as count
            FROM b_posts
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}