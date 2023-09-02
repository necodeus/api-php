<?php 

namespace App\Controller\Admin\v1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class DashboardController extends AbstractController
{
    #[Route('/api/v1/dashboard', name: 'admin-dashboard', host: '{admin-api.localhost|admin-api.necodeo.com}')]
    public function index(): JsonResponse
    {
        return $this->json([
            'status' => 'ok',
        ]);
    }
}
