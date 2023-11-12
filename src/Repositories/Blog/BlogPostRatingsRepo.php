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
        return Collection::fromIterable([]);
    }

    #[Override]
    public function count(): int
    {
        return 0;
    }

    public function upsert(array $data): int
    {
        return $this->db->upsert('b_post_ratings', $data);
    }
}