<?php

namespace Repositories\Blog;

use Repositories\BaseRepository;

use loophp\collection\Collection;

class BlogPostsRepo extends BaseRepository
{
    public function getPosts(): Collection
    {
        $prefix = 'http://images.localhost/';

        $query = "SELECT
                *,
                CONCAT(:prefix, main_image_id) AS main_image_url
            FROM b_posts
        ";

        $result = $this->db->fetchAll($query, ['prefix' => $prefix]);

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

    public function countPosts(): int
    {
        $query = "SELECT
                COUNT(*) as count
            FROM b_posts
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}