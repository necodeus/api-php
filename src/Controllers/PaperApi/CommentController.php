<?php

namespace Controllers\PaperApi;

use Controllers\BaseController;

use Repositories\Blog\BlogCommentsRepo;

class CommentController extends BaseController
{
    private $repo;

    public function __construct()
    {
        parent::__construct();

        $this->repo = new BlogCommentsRepo();
    }

    public function index($id): void
    {
        performance()::measure();
        $comments = $this->repo->getCommentsByPostId($id);
        performance()::measure();

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'time' => performance()::result(),
            'comments' => $comments,
        ]);
    }
}