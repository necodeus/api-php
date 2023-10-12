<?php 

namespace Repositories\Blog;

use Repositories\BaseRepository;

use loophp\collection\Collection;

class BlogCategoriesRepo extends BaseRepository
{
    public function getCategories(): Collection
    {
        $query = "SELECT
                *
            FROM b_categories
        ";

        $result = $this->db->fetchAll($query);

        return Collection::fromIterable($result);
    }

    public function getCategoryById(string $id): array
    {
        $query = "SELECT
                *
            FROM b_categories
            WHERE   
                id = :id
        ";

        $result = $this->db->fetch($query, ['id' => $id]);

        return $result;
    }
}