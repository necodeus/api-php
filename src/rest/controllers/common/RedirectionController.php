<?php

namespace Controllers\CommonApi;

use Repositories\CommonRepository;

class RedirectionController
{
    private CommonRepository $common;

    public function __construct()
    {
        $this->common = new CommonRepository();
    }

    public function single(string $id): void
    {
        performance()::measure();
        $redirection = $this->common->getRedirectionById($id);
        performance()::measure();

        response([
            'status' => 'ok',
            'time' => performance()::result(),
            'redirection' => $redirection,
        ])->status(200);
    }
}