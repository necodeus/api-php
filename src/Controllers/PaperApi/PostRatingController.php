<?php

namespace Controllers\PaperApi;

use Controllers\BaseController;
use Repositories\Blog\BlogPostRatingsRepo;
use Repositories\Blog\BlogPostRatingsSummaryRepo;
use Predis\Client as RedisClient;

class PostRatingController extends BaseController
{
    protected RedisClient $redis;

    protected BlogPostRatingsRepo $ratings;

    protected BlogPostRatingsSummaryRepo $ratingsSummary;

    public function __construct()
    {
        $this->redis = new RedisClient([
            'scheme' => 'tcp',
            'host' => 'redis',
            'port' => 6379
        ]);
        $this->ratings = new BlogPostRatingsRepo();
        $this->ratingsSummary = new BlogPostRatingsSummaryRepo();
    }

    protected function calculateNewAverage(float $averageRating, int $ratingsCount, int $userRating): float
    {
        return ($averageRating * $ratingsCount + $userRating) / ($ratingsCount + 1);
    }

    public function rate(string $id)
    {
        // pobranie danych
        $current = $_GET['userRating'] ?? null;
        $userIP = $_SERVER['REMOTE_ADDR'];
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $userHash = md5($userIP . $userAgent);

        // walidacja
        if (!is_numeric($current) || $current < 1 || $current > 5) {
            return response([
                'status' => 'error',
                'message' => 'Invalid rating value',
            ])->status(400);
        }

        // pobranei poprzedniej oceny
        $previous = $this->redis_getRating($userHash, $id) ?? $this->ratings->findRating($userHash, $id);

        // zapisanie nowej oceny
        $this->redis->set("rating:$userHash:$id", $current);

        // aktualizacja podsumowania
        $updatedRating = $this->redis_updateSummary($id, $previous, $current);

        return response([
            'status' => 'ok',
            'message' => 'Post rated successfully',
            'rating' => $updatedRating,
        ])->status(200);
    }

    protected function redis_getRating(string $userHash, string $postId): ?float
    {
        return $this->redis->get("rating:$userHash:$postId");
    }

    public function single(int $id)
    {
        $rating = $this->redis->hget('blog_post_ratings', $id);

        if ($rating) {
            $rating = json_decode($rating);
        }

        return response([
            'status' => 'ok',
            'message' => 'Rating found',
            'rating' => $rating,
        ])->status(200);
    }

    protected function redis_updateSummary(string $postId, int $previous = null, int $current): array
    {
        $summary = $this->redis->hget('blog_post_ratings', $postId);

        // jeżeli istnieje podsumowanie, to aktualizujemy je
        if ($summary) {
            $summary = json_decode($summary, true);

            if ($previous !== null) {
                $total = ($summary['average'] * $summary['count']) + $current - $previous;
                $count = $summary['count'];
            } else {
                $total = ($summary['average'] * $summary['count']) + $current;
                $count = $summary['count'] + 1;
            }

            $summary = [
                'average' => $total / $count,
                'count' => $count,
            ];
        } else {
            $summary = [
                'average' => $current,
                'count' => 1,
            ];
        }

        $this->redis->hset('blog_post_ratings', $postId, json_encode($summary));

        return $summary;
    }

    public function clear(): void
    {
        $allRatingKeys = $this->redis->keys('rating:*');

        foreach ($allRatingKeys as $key) {
            $this->redis->del($key);
        }

        $allSummaryKeys = $this->redis->keys('blog_post_ratings');

        foreach ($allSummaryKeys as $key) {
            $this->redis->del($key);
        }

        response([
            'status' => 'ok',
            'message' => 'Cache reset successfully',
        ])->status(200);
    }
}