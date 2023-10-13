<?php 

namespace Repositories\Blog;

use Repositories\BaseRepository;

use loophp\collection\Collection;

class BlogCommentsRepo extends BaseRepository
{
    public function getComments(): Collection
    {
        $query = "SELECT
                *
            FROM b_comments
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

    public function countComments(): int
    {
        $query = "SELECT
                COUNT(*) as count
            FROM b_comments
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}