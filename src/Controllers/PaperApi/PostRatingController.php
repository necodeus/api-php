<?php

namespace Controllers\PaperApi;

use Controllers\BaseController;
use Repositories\Blog\BlogPostRatingsRepo;

class PostRatingController extends BaseController
{
    protected $filePath = 'rating.json';

    protected BlogPostRatingsRepo $repo;

    public function __construct()
    {
        $this->createJsonIfNotExists($this->filePath);
        $this->repo = new BlogPostRatingsRepo();
    }

    protected function createJsonIfNotExists(string $filePath): void
    {
        if (!file_exists($filePath)) {
            file_put_contents($filePath, json_encode([]));
        }
    }

    protected function calculateNewAverage(float $averageRating, int $ratings, int $userRating): float
    {
        return ($averageRating * $ratings + $userRating) / ($ratings + 1);
    }

    protected function getPostRatingsFromFile(): array
    {
        return json_decode(file_get_contents($this->filePath), true);
    }

    protected function savePostRatingsToFile(array $ratings, int $postId, float $newAverage, int $numberOfRatings): array
    {
        $ratings[$postId] = [
            'average' => $newAverage,
            'count' => ($numberOfRatings + 1) ?? 1,
        ];

        file_put_contents($this->filePath, json_encode($ratings));

        return $ratings[$postId];
    }

    /**
     * Ocena wpisu
     */
    public function rate(int $id)
    {
        $userRating = $_GET['userRating'] ?? null;

        if (!$id || !$userRating) {
            return response([
                'status' => 'error',
                'message' => 'Missing required parameters',
            ])->status(400);
        }

        $ratings = $this->getPostRatingsFromFile();

        $rating = $ratings[$id] ?? null;

        $newAverage = $this->calculateNewAverage($rating['average'] ?? 0, $rating['count'] ?? 0, $userRating);

        $rating = $this->savePostRatingsToFile($ratings, $id, $newAverage, $rating['count'] ?? 0);

        $this->repo->upsert([
            'post_id' => $id,
            'average_rating' => $rating['average'],
            'number_of_ratings' => $rating['count'],
        ]);

        return response([
            'status' => 'ok',
            'message' => 'Post rated successfully',
            'rating' => $rating,
        ])->status(200);
    }

    /**
     * Aktualizacja ocen wpisów w bazie danych. Uruchamiana przez CRON
     */
    public function sync(): void
    {
        foreach ($this->getPostRatingsFromFile() as $postId => $localRating) {
            $this->repo->upsert([
                'post_id' => $postId,
                'average_rating' => $localRating['average'],
                'number_of_ratings' => $localRating['count'],
            ]);
        }
    }
}
