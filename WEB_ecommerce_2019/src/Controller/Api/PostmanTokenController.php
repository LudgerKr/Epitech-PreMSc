<?php


namespace App\Controller\Api;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PostmanTokenController extends AbstractController
{
    /**
     * @Rest\Post("/api/login_check")
     * @return JsonResponse
     */
    protected function login()
    {
        $user = $this->getUser();

        return $this->json([
            'username' => $user->getEmail(),
        ]);
    }
}