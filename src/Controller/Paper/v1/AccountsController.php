<?php

namespace App\Controller\Paper\v1;

use App\Validator\AccountCreationValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Enum\AccountCreationStatus;
use App\Repository\AccountsRepository;

class AccountsController extends AbstractController
{
    public function __construct(private AccountsRepository $accounts)
    {
    }

    #[Route('/api/v1/accounts', host: '{paper-api.localhost|paper-api.necodeo.com}', methods: ['POST'])]
    public function createAccount(Request $request): JsonResponse
    {
        $email = $request->get('email') ?? '';
        $name = $request->get('name') ?? '';
        $phone = $request->get('phone') ?? '';

        $validation = new AccountCreationValidator($email, $name, $phone);

        if (!$validation->isValid()) {
            return $this->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validation->getErrorMessages(),
            ]);
        }

        $account = $this->accounts->createAccount(compact('email', 'name', 'phone'));

        $error = match ($account['status']) {
            AccountCreationStatus::ALREADY_EXISTS => [
                'status' => 'error',
                'message' => $account['message'],
            ],
            AccountCreationStatus::FAILED => [
                'status' => 'error',
                'message' => $account['message'],
            ],
            AccountCreationStatus::AUTHKEY_ALREADY_EXISTS => [
                'status' => 'error',
            ],
            default => null,
        } ?? null;

        if ($error !== null) {
            return $this->json($error);
        }

        return $this->json($account['data']);
    }
}