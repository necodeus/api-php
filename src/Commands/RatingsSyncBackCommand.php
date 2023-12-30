<?php

namespace Commands;

use Libraries\Color;
use Predis\Client as RedisClient;
use Repositories\BlogRepository;

class RatingsSyncBackCommand extends \BaseCommand
{
    protected $name = 'sync-back';
    protected $description = 'Synchronizes ratings from MySQL to Redis';

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

        $allRatings = $this->blog->getPostRatings(1, 999_999_999);

        foreach ($allRatings as $rating) {
            $userHash = $rating['user_hash'];
            $postId = $rating['post_id'];

            Color::print("Syncing rating for post $postId by user $userHash...\n", 'lightgreen');

            $this->redis->set("rating:$userHash:$postId", $rating['rating']);
        }

        $allRatingsSummary = $this->blog->getPostRatingsSummary(1, 999_999_999);

        foreach ($allRatingsSummary as $ratingSummary) {
            $postId = $ratingSummary['post_id'];

            Color::print("Syncing rating summary for post $postId...\n", 'lightgreen');

            $this->redis->hset('blog_post_ratings', $postId, json_encode([
                'average' =>$ratingSummary['average'],
                'count' =>  $ratingSummary['count'],
            ]));
        }

        Color::print("Done!\n", 'lightgreen');
    }
}