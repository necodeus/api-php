<?php

namespace Commands;

use Libraries\Color;
use Predis\Client as RedisClient;
use Repositories\Blog\BlogPostRatingsRepo;
use Repositories\Blog\BlogPostRatingsSummaryRepo;

class RatingsSyncBackCommand extends \BaseCommand
{
    protected $name = 'sync-back';
    protected $description = 'Synchronizes ratings from MySQL to Redis';

    protected RedisClient $redis;

    protected BlogPostRatingsRepo $ratings;

    protected BlogPostRatingsSummaryRepo $ratingsSummary;

    public function __construct()
    {
        $this->redis = new RedisClient([
            'scheme' => 'tcp',
            'host' => 'redis',
            'port' => 6379,
        ]);
        $this->ratings = new BlogPostRatingsRepo();
        $this->ratingsSummary = new BlogPostRatingsSummaryRepo();
    }

    public function handle($arguments)
    {
        Color::print("Syncing ratings...\n", 'lightgreen');

        $allRatings = $this->ratings->getAll(1, 999_999_999);

        foreach ($allRatings as $rating) {
            $userHash = $rating['user_hash'];
            $postId = $rating['post_id'];

            Color::print("Syncing rating for post $postId by user $userHash...\n", 'lightgreen');

            $this->redis->set("rating:$userHash:$postId", $rating['rating']);
        }

        $allRatingsSummary = $this->ratingsSummary->getAll(1, 999_999_999);

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