<?php 
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiLoginController extends AbstractController
{
    #[Route('/api/login', name: 'api_login', methods: ['POST'])]
    public function login(): JsonResponse
    {
        // O LexikJWTAuthBundle intercepta essa rota automaticamente,
        // então esse método nunca é executado.
        // Ele só existe para o Symfony registrar a rota.

        return new JsonResponse([
            'message' => 'Esse ponto nunca será alcançado. Verifique o JWT handler.'
        ], 401);
    }
}
