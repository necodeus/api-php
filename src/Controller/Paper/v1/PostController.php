<?php

namespace App\Controller\Paper\v1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Repository\AccountsRepository;
use App\Enum\AccountCreationResponse;

class PostController extends AbstractController
{
    public function __construct(private AccountsRepository $accounts, private AuthkeysRepository $authkeys)
    {
    }

    #[Route('/api/v1/posts', host: '{paper-api.localhost|paper-api.necodeo.com}', methods: ['GET'])]
    public function getPosts(): JsonResponse
    {
        $account = $this->accounts->createAccount([
            'email' => 'xxx@necodeo.com',
            'name' => 'Dawid',
            'phone' => '1234567890',
        ]);

        switch ($account['status']) {
            case AccountCreationResponse::ALREADY_EXISTS:
                return $this->json([
                    'status' => 'error',
                    'message' => $account['message'],
                ]);
            case AccountCreationResponse::FAILED:
                return $this->json([
                    'status' => 'error',
                    'message' => $account['message'],
                ]);
        }

        $authkey = $this->authkeys->

        return $this->json([]);
    }

    #[Route('/api/v1/posts', host: '{paper-api.localhost|paper-api.necodeo.com}', methods: ['POST'])]
    public function addPost(): JsonResponse
    {
        return $this->json([]);
    }
}