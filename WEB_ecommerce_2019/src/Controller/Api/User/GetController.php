<?php

namespace App\Controller\Api\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class GetController
 * @package App\Controller\Api\User
 * @Route("/api",name="api_")
 *
 */
class GetController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/users")
     * @Groups("user")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function getUsersAction(EntityManagerInterface $em)
    {
        $users = $em->getRepository(User::class)->findAll();

        return $this->json($users, 200, [], ['groups' => ['user']]);
    }

    /**
     * @Rest\Get("/user/{id}", requirements={"id" = "\d+"})
     * @Groups("user")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     * @throws Exception
     */
    public function getUserAction(Request $request, EntityManagerInterface $em)
    {
        $user = $em->getRepository(User::class)->find($request->get('id'));

        if(empty($user)) {
            return $this->handleView(
                $this->view(['status'=>'User not found'],Response::HTTP_NOT_FOUND));
        }

        return $this->json($user, 200, [], ['groups' => ['user']]);
    }
}