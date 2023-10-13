<?php

namespace Controllers\CommonApi;

use Repositories\Common\CommonRedirectionsRepo;

class RedirectionController
{
    private CommonRedirectionsRepo $repo;

    public function __construct()
    {
        $this->repo = new CommonRedirectionsRepo();
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