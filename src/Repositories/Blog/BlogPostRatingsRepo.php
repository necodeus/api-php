<?php

namespace Repositories\Blog;

use Repositories\BaseRepositoryInterface;
use Repositories\BaseRepository;

use loophp\collection\Collection;

class BlogPostRatingsRepo extends BaseRepository implements BaseRepositoryInterface
{
    #[Override]
    public function getAll(int $page = 1, int $limit = 10): Collection
    {
        $offset = ($page - 1) * $limit;

        $query = "SELECT *
            FROM b_post_ratings
            LIMIT $limit OFFSET $offset
        ";

        $result = $this->db->fetchAll($query);

        return Collection::fromIterable($result);
    }

    public function findRating(string $userHash, string $postId): ?int
    {
        $query = "SELECT rating
            FROM b_post_ratings
            WHERE
                user_hash = :user_hash
                AND post_id = :post_id
        ";

        $result = $this->db->fetch($query, [
            'user_hash' => $userHash,
            'post_id' => $postId,
        ]);

        return $result ? $result['rating'] : null;
    }

    #[Override]
    public function count(): int
    {
        $query = "SELECT COUNT(*) AS count
            FROM b_post_ratings
        ";

        $result = $this->db->fetch($query);

        return $result['count'] ?? 0;
    }

    public function upsert(array $data): int
    {
        return $this->db->upsert('b_post_ratings', $data);
    }
}