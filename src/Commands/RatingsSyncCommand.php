<?php

namespace Commands;

use Predis\Client as RedisClient;
use Libraries\Color;
use Repositories\BlogRepository;

class RatingsSyncCommand extends \BaseCommand
{
    protected $name = 'sync';
    protected $description = 'Synchronizes ratings from Redis to MySQL';

    protected RedisClient $redis;

    protected BlogRepository $blog;

    public function __construct()
    {
        $this->blog = new BlogRepository();

        $this->redis = new RedisClient([
            'scheme' => $_ENV['REDIS_SCHEME'], // tcp
            'host' =>  $_ENV['REDIS_HOST'], // use "redis" if developing with Docker
            'port' => $_ENV['REDIS_PORT'] // 6379
        ]);
    }

    public function handle($arguments)
    {
        Color::print("Syncing ratings...\n", 'lightgreen');

        $allRatingKeys = $this->redis->keys('rating:*');

        foreach ($allRatingKeys as $ratingKey) {
            list(, $userHash, $postId) = explode(':', $ratingKey);
            $userRating = $this->redis->get($ratingKey);

            Color::print("Syncing rating for post $postId by user $userHash...\n", 'lightgreen');

            $this->blog->upsertPostRating([
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

            $this->blog->upsertPostRatingsSummary([
                'post_id' => $postId,
                'average' => $rating['average'],
                'count' => $rating['count'],
            ]);
        }

        Color::print("Done!\n", 'lightgreen');
    }
}