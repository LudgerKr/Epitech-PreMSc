<?php

namespace App\Controller\Api\UserAddress;

use App\Entity\User;
use App\Entity\UserAddress;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DeleteController
 * @package App\Controller\Api\UserAddress
 * @Route("/api",name="api_")
 *
 */
class DeleteController extends AbstractFOSRestController
{
    /**
     * @Rest\Delete("/user/{uid}/address/{aid}", requirements={"uid" = "\d+", "aid" = "\d+"})
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return FormInterface|Response
     */
    public function deleteUserAddressAction(Request $request, EntityManagerInterface $em)
    {
        $address    = $em->getRepository(UserAddress::class)->find($request->get('aid'));
        $user       = $em->getRepository(User::class)->find($request->get('uid'));

        if(empty($address)) {
            return $this->handleView($this->view(['status'=>'UserAddress not found'],Response::HTTP_NOT_FOUND));
        }

        if(empty($user)) {
            return $this->handleView($this->view(['status'=>'User not found'],Response::HTTP_NOT_FOUND));
        }

        $em->remove($address);
        $em->flush();

        return $this->handleView($this->view('UserAddress deleted', Response::HTTP_ACCEPTED));
    }
}