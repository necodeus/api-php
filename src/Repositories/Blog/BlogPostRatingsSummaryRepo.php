<?php

namespace Repositories\Blog;

use Repositories\BaseRepositoryInterface;
use Repositories\BaseRepository;

use loophp\collection\Collection;

class BlogPostRatingsSummaryRepo extends BaseRepository implements BaseRepositoryInterface
{
    #[Override]
    public function getAll(int $page = 1, int $limit = 10): Collection
    {
        $offset = ($page - 1) * $limit;

        $query = "SELECT *
            FROM b_post_ratings_summary
            LIMIT $limit OFFSET $offset
        ";

        $result = $this->db->fetchAll($query);

        return Collection::fromIterable($result);
    }

    #[Override]
    public function count(): int
    {
        $query = "SELECT COUNT(*) AS count
            FROM b_post_ratings_summary
        ";

        $result = $this->db->fetch($query);

        return $result['count'] ?? 0;
    }

    public function upsert(array $data): int
    {
        return $this->db->upsert('b_post_ratings_summary', $data);
    }
}