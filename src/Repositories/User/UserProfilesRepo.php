<?php

namespace Repositories\User;

use Repositories\BaseRepositoryInterface;
use Repositories\BaseRepository;

use loophp\collection\Collection;

class UserProfilesRepo extends BaseRepository implements BaseRepositoryInterface
{
    public function getAll(int $page = 1, int $limit = 10): Collection
    {
        $offset = ($page - 1) * $limit;

        $query = "SELECT *
            FROM u_profiles
            LIMIT $limit OFFSET $offset
        ";

        $result = $this->db->fetchAll($query);

        return Collection::fromIterable($result);
    }

    public function getPostAuthor(string $postId): array
    {
        $query = "SELECT up.*
            FROM u_profiles up
            JOIN b_posts bp ON bp.publisher_account_id = up.account_id
            WHERE bp.id = :postId
        ";

        $result = $this->db->fetch($query, [
            'postId' => $postId,
        ]);

        return $result;
    }

    public function count(): int
    {
        $query = "SELECT
                COUNT(*) as count
            FROM u_profiles
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}