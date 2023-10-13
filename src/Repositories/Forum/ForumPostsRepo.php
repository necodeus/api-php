<?php 

namespace Repositories\Forum;

use Repositories\BaseRepository;

class ForumPostsRepo extends BaseRepository
{
    public function getPosts(): array
    {
        $query = "SELECT *
            FROM f_posts
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }

    public function countPosts(): int
    {
        $query = "SELECT
                COUNT(*) as count
            FROM f_posts
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}