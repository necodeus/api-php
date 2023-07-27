<?php 

namespace App\Controller\Paper\v1;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Comments;

class CommentController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/api/v1/comments', name: 'comments', host: '{paper-api.localhost|paper-api.necodeo.com}')]
    public function index(): JsonResponse
    {
        $ncAccountsRepository = $this->entityManager->getRepository(Comments::class);
        $ncAccounts = $ncAccountsRepository->findAll();

        return $this->json($ncAccounts);
    }
}
