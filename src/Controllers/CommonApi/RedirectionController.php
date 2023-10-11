<?php 

namespace Controllers\CommonApi;

use Repositories\RedirectionRepository;

class RedirectionController
{
    private RedirectionRepository $repo;

    public function __construct()
    {
        $this->repo = new RedirectionRepository();
    }

    public function single(string $id): void
    {
        $start = microtime(true);
        $redirection = $this->repo->getRedirectionById($id);
        $end = microtime(true);

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'time' => $end - $start,
            'redirection' => $redirection,
        ]);
    }
}