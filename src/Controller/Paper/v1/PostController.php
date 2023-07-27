<?php 

namespace App\Controller\Paper\v1;

use App\Repository\AccountsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Accounts;

class PostController extends AbstractController
{
    public function __construct(private AccountsRepository $accounts)
    {
        // ...
    }

    #[Route('/api/v1/posts', name: 'posts', host: '{paper-api.localhost|paper-api.necodeo.com}')]
    public function index(): JsonResponse
    {
        $accounts = $this->accounts->findAll();
        $accounts = array_map(fn ($account) => $account->getData(), $accounts);

        return $this->json($accounts);
    }
}
