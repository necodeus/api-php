<?php 

namespace Repositories\Forum;

use Repositories\BaseRepository;

class ForumCategoryTreeRepo extends BaseRepository
{
    public function getCategoryTree(): array
    {
        $query = "SELECT *
            FROM f_category_tree
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }

    public function countCategoryTree(): int
    {
        $query = "SELECT
                COUNT(*) as count
            FROM f_category_tree
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}