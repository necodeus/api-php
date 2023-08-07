<?php 

namespace App\Controller\Paper\v1;

use App\Repository\CommentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    private $entityManager;

    public function __construct(private CommentsRepository $comments)
    {
    }

    #[Route('/api/v1/comments', name: 'comments', host: '{paper-api.localhost|paper-api.necodeo.com}')]
    public function index(): JsonResponse
    {
        $comments = $this->comments->findAll();

        return $this->json($comments);
    }
}
