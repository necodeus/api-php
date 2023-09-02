<?php 

namespace App\Controller\Paper\v1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Repository\ContentsRepository;

class PostController extends AbstractController
{
    public function __construct(private ContentsRepository $contents)
    {
    }

    #[Route('/api/v1/posts', name: 'posts', host: '{paper-api.localhost|paper-api.necodeo.com}')]
    public function index(): JsonResponse
    {
        $posts = $this->contents->findAll();

        return $this->json($posts);
    }
}
