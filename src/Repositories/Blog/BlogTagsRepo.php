<?php 

namespace Repositories\Blog;

use Repositories\BaseRepository;

use loophp\collection\Collection;

class BlogTagsRepo extends BaseRepository
{
    public function getTags(): Collection
    {
        $query = "SELECT
                *
            FROM b_tags
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
}