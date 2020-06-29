<?php

namespace App\Controller\Api\Cart;

use App\Entity\User;
use App\Entity\Cart;
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
 * @package App\Controller\Api\Cart
 * @Route("/api",name="api_")
 *
 */
class DeleteController extends AbstractFOSRestController
{
    /**
     * @Rest\Delete("/user/{uid}/cart/{cid}", requirements={"uid" = "\d+", "cid" = "\d+"})
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return FormInterface|Response
     */
    public function deleteCartAction(Request $request, EntityManagerInterface $em)
    {
        $cart = $em->getRepository(Cart::class)->find($request->get('cid'));
        $user = $em->getRepository(User::class)->find($request->get('uid'));

        if(empty($cart)) {
            return $this->handleView($this->view(['status'=>'Cart not found'],Response::HTTP_NOT_FOUND));
        }

        if(empty($user)) {
            return $this->handleView($this->view(['status'=>'User not found'],Response::HTTP_NOT_FOUND));
        }

        $em->remove($cart);
        $em->flush();

        return $this->handleView($this->view('Cart deleted', Response::HTTP_ACCEPTED));
    }
}