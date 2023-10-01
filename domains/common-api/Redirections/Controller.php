<?php 

namespace CommonApi\Redirections;

class Controller
{
    private Repository $repo;

    public function __construct()
    {
        $this->repo = new Repository();
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