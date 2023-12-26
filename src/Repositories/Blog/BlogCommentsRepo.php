<?php

namespace Repositories\Blog;

use Repositories\BaseRepository;

class BlogCommentsRepo extends BaseRepository
{
    /**
     * TODO: Raczej nie chcemy pobierać wszystkich kolumn!
     */
    public function getComments(int $page = 1, int $limit = 10): array
    {
        $offset = ($page - 1) * $limit;

        $query = "SELECT *
            FROM b_comments
            WHERE
                parent_id IS NULL
            LIMIT $limit OFFSET $offset
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }

    public function getCommentsByPostId(string $postId): array
    {
        $query = "SELECT
                id,
                parent_id,
                content,
                post_id,
                author_name,
                created_at,
                IFNULL(upvotes, 0) AS upvotes,
                IFNULL(downvotes, 0) AS downvotes
            FROM b_comments
            WHERE
                post_id = :post_id
            ORDER BY created_at ASC
        ";

        $result = $this->db->fetchAll($query, ['post_id' => $postId]);

        $replies = [];
        $topLevelComments = [];

        foreach ($result as $comment) {
            $comment['replies'] = [];

            if ($comment['parent_id']) {
                $replies[$comment['parent_id']][] = $comment;
            } else {
                $topLevelComments[$comment['id']] = $comment;
            }
        }

        foreach ($replies as $parentId => $replyList) {
            if (isset($topLevelComments[$parentId])) {
                $topLevelComments[$parentId]['replies'] = $replyList;
            }
        }

        return array_values($topLevelComments);
    }

    public function getCommentsCount(): int
    {
        $query = "SELECT
                COUNT(*) as count
            FROM b_comments
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}