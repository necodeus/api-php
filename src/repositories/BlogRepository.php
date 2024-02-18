<?php

namespace Repositories;

class BlogRepository extends BaseRepository
{
    public function getCategories(): array
    {
        return [];
    }

    public function getCategoryById(string $postId): array
    {
        return [];
    }

    public function getCategoriesCount(): int
    {
        return 0;
    }

    public function getTags(): array
    {
        return [];
    }

    public function getTagById(string $id): array
    {
        return [];
    }

    public function getTagsCount(): int
    {
        return 0;
    }

    public function addComment(array $data): int
    {
        return $this->db->upsert('b_comments', $data);
    }

    public function upsertCommentAction(array $data): int
    {
        return $this->db->upsert('b_comment_actions', $data);
    }

    public function recalculateCommentVotes(string $postId, string $commentId): int
    {
        $query = "UPDATE b_comments
            SET
                upvotes = (SELECT COUNT(*) FROM b_comment_actions WHERE `post_id` = \"$postId\" AND `comment_id` = \"$commentId\" AND `type` = 'UPVOTE'),
                downvotes = (SELECT COUNT(*) FROM b_comment_actions WHERE `post_id` = \"$postId\" AND `comment_id` = \"$commentId\" AND `type` = 'DOWNVOTE')
            WHERE
                post_id = \"$postId\"
                AND id = \"$commentId\"
        ";

        return $this->db->executeRawQuery($query);
    }

    public function getCommentActionId(array $data): ?string
    {
        $query = "SELECT
                id
            FROM b_comment_actions
            WHERE
                session_id = :session_id
                AND `post_id` = :post_id
                AND `comment_id` = :comment_id
        ";

        $result = $this->db->fetch($query, $data);

        return $result['id'] ?? null;
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

    public function getPublicPosts(int $page = 1, int $limit = 10): array
    {
        $offset = ($page - 1) * $limit;

        $query = "SELECT
                bp.*,
                p.*,
                `up`.display_name AS author_name,
                CONCAT('https://images.necodeo.com/', image_id_avatar) AS author_avatar_url,
                CONCAT('https://images.necodeo.com/', main_image_id) AS main_image_url
            FROM b_posts bp
            INNER JOIN c_pages p ON p.content_id = bp.id
            LEFT JOIN u_profiles up ON bp.publisher_account_id = up.account_id
            LIMIT {$limit} OFFSET {$offset}
        ";

        return $this->db->fetchAll($query);
    }

    public function getPostById(string $id): array
    {
        $query = "SELECT
                *,
                CONCAT(:prefix, main_image_id) AS main_image_url
            FROM b_posts
            WHERE
                id = :id
        ";

        $result = $this->db->fetch($query, [
            'prefix' => 'https://images.necodeo.com/',
            'id' => $id,
        ]);

        return $result;
    }

    public function updatePost(string $postId, array $data): int
    {
        $affected = $this->db->update('b_posts', $data, ['id' => $postId]);

        return $affected;
    }

    public function getPostRatings(): array
    {
        return [];
    }

    public function getPostRating(string $userHash, string $id): array
    {
        return [];
    }

    public function getRatingAverageAndCount(string $postId): array
    {
        $query = "SELECT
                AVG(value) AS rating_average,
                COUNT(*) AS rating_count
            FROM b_post_ratings
            WHERE
                post_id = :post_id
        ";

        $result = $this->db->fetch($query, ['post_id' => $postId]);

        return $result;
    }

    public function upsertPostRating(array $data): int
    {
        $affected = $this->db->upsert('b_post_ratings', $data);

        return $affected;
    }

    public function getPostRatingsSummary(): array
    {
        return [];
    }

    public function getPostRatingsSummaryById(string $postId): array
    {
        return [];
    }

    public function upsertPostRatingsSummary(array $data): int
    {
        return 0;
    }
}
