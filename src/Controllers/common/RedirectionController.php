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

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'time' => performance()::result(),
            'redirection' => $redirection,
        ]);
    }
}