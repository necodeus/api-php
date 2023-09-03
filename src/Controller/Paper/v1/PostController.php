<?php 

namespace App\Controller\Paper\v1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Repository\ContentsRepository;
use App\Repository\AccountProfilesRepository;
use App\Repository\ImagesRepository;

#[Route(
    path: "/api/v1/posts",
    name: 'paper-v1-posts-',
    host: 'paper-api.{domain}',
    defaults: ['domain' => 'necodeo.com'],
    requirements: ['domain' => 'localhost|necodeo.com'],
)]
class PostController extends AbstractController
{
    public function __construct(
        private ContentsRepository $contents,
        private AccountProfilesRepository $accountProfiles,
        private ImagesRepository $images,
    )
    {
    }

    #[Route(path: "/", name: 'index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $posts = $this->contents->findAll();

        return $this->json([
            'status' => 'ok',
            'posts' => $posts,
        ]);
    }

    #[Route(path: "/{id}", name: 'show', methods: ['GET'])]
    public function show(string $id): JsonResponse
    {
        $post = $this->contents->findOneBy([
            'id' => $id,
        ]);

        $postPublisher = $this->accountProfiles->findOneBy([
            'accountId' => $post->accountIdPublisher,
        ]);

        return $this->json([
            'status' => 'ok',
            'post' => $post,
            'postPublisher' => $postPublisher,
        ]);
    }
}
