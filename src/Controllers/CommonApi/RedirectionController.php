<?php 

namespace Controllers\CommonApi;

use Repositories\Common\RedirectionsRepo;

class RedirectionController
{
    private RedirectionsRepo $repo;

    public function __construct()
    {
        $this->repo = new RedirectionsRepo();
    }

    public function single(string $id): void
    {
        performance()::measure();
        $redirection = $this->repo->getRedirectionById($id);
        performance()::measure();

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'time' => performance()::result(),
            'redirection' => $redirection,
        ]);
    }
}