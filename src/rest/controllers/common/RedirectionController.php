<?php

namespace Controllers\CommonApi;

use Enums\ControllerResponseType;
use Repositories\CommonRepository;

class RedirectionController
{
    private CommonRepository $common;

    public function __construct()
    {
        $this->common = new CommonRepository();
    }

    public function single(string $id): string
    {
        performance()::measure();
        $redirection = $this->common->getRedirectionById($id);
        performance()::measure();

        return response(ControllerResponseType::JSON)
            ->status(200)
            ->data([
                'status' => 'ok',
                'time' => performance()::result(),
                'redirection' => $redirection,
            ]);
    }
}