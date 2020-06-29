<?php

namespace App\Controller\Api\Cart;

use App\Entity\Cart;
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
 * @package App\Controller\Api\Cart
 * @Route("/api",name="api_")
 *
 */
class GetController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/carts")
     * @Groups("cart")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function getCartsAction(EntityManagerInterface $em)
    {
        $carts = $em->getRepository(Cart::class)->findAll();

        return $this->json($carts, 200, [], ['groups' => ['cart']]);
    }

    /**
     * @Rest\Get("/user/{id}/carts")
     * @Groups("cart")
     * @param EntityManagerInterface $em
     * @param User $user
     * @return Response
     */
    public function getUserCartsAction(EntityManagerInterface $em, User $user)
    {
        $carts = $em->getRepository(Cart::class)->findBy(['user' => $user->getId()]);

        return $this->json($carts, 200, [], ['groups' => ['cart']]);
    }

    /**
     * @Rest\Get("/user/{id}/carts/complete", requirements={"id" = "\d+"})
     * @Groups("cart")
     * @param EntityManagerInterface $em
     * @param User $user
     * @return Response
     */
    public function getUserCompleteCartsAction(EntityManagerInterface $em, User $user)
    {
        if (empty($user)) {
            $this->view(['status'=>'user not found'],Response::HTTP_NOT_FOUND);
        }

        $carts = $em->getRepository(Cart::class)->findBy(['user' => $user->getId(), "state"=> "complete"]);

        return $this->json($carts, 200, [], ['groups' => ['cart']]);
    }

    /**
     * @Rest\Get("/user/{id}/cart/current")
     * @Groups("cart")
     * @param EntityManagerInterface $em
     * @param User $user
     * @return Response
     */
    public function getUserCartCurrentAction(EntityManagerInterface $em, User $user)
    {
        $cart = $em->getRepository(Cart::class)->findOneBy(['user' => $user->getId(), 'state' => "current"]);

        if (is_null($cart)) {
            return $this->json([], 200, [], ['groups' => ['cart']]);
        }

        return $this->json($cart, 200, [], ['groups' => ['cart']]);
    }

    /**
     * @Rest\Get("/cart/{id}", requirements={"id" = "\d+"})
     * @Groups("cart")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     * @throws Exception
     */
    public function getCartAction(Request $request, EntityManagerInterface $em)
    {
        $cart = $em->getRepository(Cart::class)->find($request->get('id'));

        if(empty($cart)) {
            return $this->handleView(
                $this->view(['status'=>'Cart not found'],Response::HTTP_NOT_FOUND));
        }

        return $this->json($cart, 200, [], ['groups' => ['cart']]);
    }

    /**
     * @Rest\Get("/user/{id}/cart/current/total")
     * @Groups("cart")
     * @param EntityManagerInterface $em
     * @param User $user
     * @return Response
     */
    public function getUserCartCurrentTotalAction(EntityManagerInterface $em, User $user)
    {
        $cart = $em->getRepository(Cart::class)->findOneBy(['user' => $user->getId(), 'state' => "current"]);

        if (is_null($cart)) {
            return $this->json([], 200, [], ['groups' => ['cart']]);
        }
        $prix = 0;

        foreach ($cart->getCartArticle() as $cartArticle) {
            $prix += $cartArticle->getArticle()->getPrice() * $cartArticle->getQuantity();
        }

        return $this->json($prix, 200, [], ['groups' => ['cart']]);
    }
}