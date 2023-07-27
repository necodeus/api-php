<?php 

namespace App\Controller\Admin\v1;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/api/v1/dashboard', name: 'dashboard', host: '{admin-api.localhost|admin-api.necodeo.com}')]
    public function index(): JsonResponse
    {
        return $this->json(['status' => 'ok']);
    }
}
