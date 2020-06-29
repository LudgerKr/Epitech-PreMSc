<?php


namespace App\Controller\Api;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class ApiAbstractController extends AbstractController
{
    private $_container;

    /**
     * ApiAbstractController constructor.
     * @param ContainerInterface $container
     */
    protected function __construct(ContainerInterface $container)
    {
        $this->_container = $container;
    }

    /**
     * @Rest\Get("/token")
     * @return JsonResponse
     */
    protected function getTokenAction()
    {
        $token = $this->_container->get('lexik_jwt_authentication.encoder')
            ->encode([
                'username' => 'admin@admin.com',
                'exp' => time() + 360000000 // 1 hour expiration
            ]);
        return new Response($token);
    }
}
