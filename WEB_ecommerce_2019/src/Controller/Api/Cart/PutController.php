<?php

namespace App\Controller\Api\Cart;

use App\Entity\User;
use App\Entity\Cart;
use App\Form\CartType;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class PutController
 * @package App\Controller\Api\Cart
 * @Route("/api",name="api_")
 *
 */
class PutController extends AbstractFOSRestController
{
    /**
     * @Rest\Put("/user/{uid}/cart/{cid}", requirements={"uid" = "\d+", "cid" = "\d+"})
     * @RequestParam(name="state", description="Le statut du panier", nullable=false)
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return FormInterface|Response
     * @throws Exception
     * @Groups("cart")
     */
    public function putCartAction(Request $request, EntityManagerInterface $em)
    {
        $cart = $em->getRepository(Cart::class)->find($request->get('cid'));
        $user = $em->getRepository(User::class)->find($request->get('uid'));

        if(empty($cart)) {
            return $this->handleView($this->view(['status'=>'Cart not found'],Response::HTTP_NOT_FOUND));
        }

        if(empty($user)) {
            return $this->handleView($this->view(['status'=>'User not found'],Response::HTTP_NOT_FOUND));
        }

        $form = $this->createForm(CartType::class, $cart)->submit($request->request->all(), false);
        if($form->isValid() && $form->isSubmitted()) {
            $em->flush();
            $em->refresh($cart);

            return $this->json($cart, 201, [], ['groups' => ['cart']]);
        } else
            return $this->handleView($this->view($form->getErrors()));
    }

    /**
     * @Rest\Put("/user/{uid}/cart/current", requirements={"uid" = "\d+"})
     * @RequestParam(name="state", description="Le statut du panier", nullable=false)
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return FormInterface|Response
     * @throws Exception
     * @Groups("cart")
     */
    public function putCartCurrentAction(Request $request, EntityManagerInterface $em)
    {
        $cart = $em->getRepository(Cart::class)->findOneBy(['user' => $request->get('uid'), 'state' => 'current']);

        if(empty($cart)) {
            return $this->handleView($this->view(['status'=>'Cart not found'],Response::HTTP_NOT_FOUND));
        }

        $form = $this->createForm(CartType::class, $cart)->submit($request->request->all(), false);
        if($form->isValid() && $form->isSubmitted()) {
            $em->flush();
            $em->refresh($cart);

            return $this->json($cart, 201, [], ['groups' => ['cart']]);
        } else
            return $this->handleView($this->view($form->getErrors()));
    }
}
