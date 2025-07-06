<?php

namespace App\Controller;

use App\Service\UserRegistrationService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{
    #[Route('/api/register', name: 'app_register', methods: ['POST'])]
    public function register(Request $request, UserRegistrationService $registrationService, LoggerInterface $logger): JsonResponse
    {
        $logger->info('Entrou no método register');

        $data = json_decode($request->getContent(), true);
        $logger->info('Dados recebidos', $data);

        if (empty($data['email']) || empty($data['password']) || empty($data['user_type'])) {
            $logger->warning('Campos obrigatórios faltando');
            return new JsonResponse(['error' => 'Missing fields'], 400);
        }

        try {
            $user = $registrationService->register(
                $data['email'],
                $data['password'],
                $data['user_type'] // já deve vir como 'client' ou 'professional'
            );
            $logger->info('Usuário registrado com sucesso', ['id' => $user->getId()]);

            return new JsonResponse(['message' => 'User registered successfully'], 201);
        } catch (\RuntimeException $e) {
            $logger->error('Erro ao registrar usuário: ' . $e->getMessage());
            return new JsonResponse(['error' => $e->getMessage()], 409);
        } catch (\InvalidArgumentException $e) {
            $logger->error('Argumento inválido: ' . $e->getMessage());
            return new JsonResponse(['error' => $e->getMessage()], 400);
        } catch (\Throwable $e) {
            $logger->error('Erro inesperado: ' . $e->getMessage());
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }
}
