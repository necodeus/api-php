<?php 

namespace Repositories\Forum;

use Repositories\BaseRepository;

class ForumThreadsRepo extends BaseRepository
{
    public function getThreads(): array
    {
        $query = "SELECT *
            FROM f_threads
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }
}