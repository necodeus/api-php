<?php 

namespace Repositories\Forum;

use Repositories\BaseRepository;

class ForumCategoriesRepo extends BaseRepository
{
    public function getCategories(): array
    {
        $query = "SELECT *
            FROM f_categories
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }
}