<?php

namespace Commands;

use Libraries\Color;
use Predis\Client as RedisClient;
use Repositories\Blog\BlogPostRatingsRepo;
use Repositories\Blog\BlogPostRatingsSummaryRepo;

class RatingsSyncCommand extends \BaseCommand
{
    protected $name = 'sync';
    protected $description = 'Synchronizes ratings from Redis to MySQL';

    protected RedisClient $redis;

    protected BlogPostRatingsRepo $ratings;

    protected BlogPostRatingsSummaryRepo $ratingsSummary;

    public function __construct()
    {
        $this->redis = new RedisClient([
            'scheme' => $_ENV['REDIS_SCHEME'], // tcp
            'host' =>  $_ENV['REDIS_HOST'], // use "redis" if developing with Docker
            'port' => $_ENV['REDIS_PORT'] // 6379
        ]);
        $this->ratings = new BlogPostRatingsRepo();
        $this->ratingsSummary = new BlogPostRatingsSummaryRepo();
    }

    public function handle($arguments)
    {
        Color::print("Syncing ratings...\n", 'lightgreen');

        $allRatingKeys = $this->redis->keys('rating:*');

        foreach ($allRatingKeys as $ratingKey) {
            list(, $userHash, $postId) = explode(':', $ratingKey);
            $userRating = $this->redis->get($ratingKey);

            Color::print("Syncing rating for post $postId by user $userHash...\n", 'lightgreen');

            $this->ratings->upsert([
                'user_hash' => $userHash,
                'post_id' => $postId,
                'rating' => $userRating,
            ]);

            $this->redis->del($ratingKey);
        }

        $allRatings = $this->redis->hgetall('blog_post_ratings');

        foreach ($allRatings as $postId => $ratingData) {
            $rating = json_decode($ratingData, true);

            Color::print("Syncing rating summary for post $postId...\n", 'lightgreen');

            $this->ratingsSummary->upsert([
                'post_id' => $postId,
                'average' => $rating['average'],
                'count' => $rating['count'],
            ]);
        }

        Color::print("Done!\n", 'lightgreen');
    }
}