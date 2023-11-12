<?php

namespace Controllers\PaperApi;

use Controllers\BaseController;
use Libraries\RedisQueue;

class TestController extends BaseController
{
    protected RedisQueue $queue;

    public function __construct()
    {
        $this->queue = new RedisQueue();
    }

    public function add(): void
    {
        $this->queue->addToQueue("INSERT INTO c_contents_fragments (title, content) VALUES ('Test', 'Test')");

        response([
            'status' => 'ok',
            'message' => 'Added to queue successfully',
        ])->status(200);
    }

    public function process(): void
    {
        $this->queue->processQueue();

        response([
            'status' => 'ok',
            'message' => 'Processed queue successfully',
        ])->status(200);
    }
}