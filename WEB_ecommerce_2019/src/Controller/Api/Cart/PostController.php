<?php

namespace App\Controller\Api\Cart;

use App\Entity\Article;
use App\Entity\CartArticle;
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
 * Class PostController
 * @package App\Controller\Api\Cart
 * @Route("/api",name="api_")
 *
 */
class PostController extends AbstractFOSRestController
{
    /**
     * @Rest\Post("/user/{id}/cart", requirements={"id" = "\d+"})
     * @RequestParam(name="state", description="Le statut du panier", nullable=false)
    *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return FormInterface|Response
     * @throws Exception
     * @Groups("cart")
     */
    public function postCartAction(Request $request, EntityManagerInterface $em)
    {
        $cart = new Cart();
        $user = $em->getRepository(User::class)->find($request->get('id'));

        if(empty($user)) {
            return $this->handleView($this->view(['status'=>'User not found'],Response::HTTP_NOT_FOUND));
        }

        $form = $this->createForm(CartType::class, $cart)->submit($request->request->all(), true);

        if($form->isValid() && $form->isSubmitted()) {
            $cart->setUser($user);
            $cart->setCreatedAt(new \DateTime());
            $em->persist($cart);
            $em->flush();

            return $this->json($cart, 201, [], ['groups' => ['cart']]);
        } else
            return $this->handleView($this->view($form->getErrors()));
    }

    /**
     * @Rest\Post("/user/{uid}/cart/current/article/{aid}", requirements={"uid" = "\d+", "aid" = "\d+"})
     * @RequestParam(name="state", description="Le titre d'un article", nullable=false)
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return FormInterface|Response
     * @throws Exception
     * @Groups("cart")
     */
    public function postArticleCurrentCartAction(Request $request, EntityManagerInterface $em)
    {
        $article = $em->getRepository(Article::class)->find($request->get('aid'));
        $user = $em->getRepository(User::class)->find($request->get('uid'));

        if(empty($user)) {
            return $this->handleView($this->view(['status'=>'User not found'],Response::HTTP_NOT_FOUND));
        }

        if(empty($article)) {
            return $this->handleView($this->view(['status' => "Article not foud"], Response::HTTP_NOT_FOUND));
        }

        $cart = $em->getRepository(Cart::class)->findOneBy(['user'=> $user, 'state' => "current"]);

        if (is_null($cart)) {
            $cart = new Cart();
            $cartArticle = new CartArticle();

        } else {
            $cartArticle = $em->getRepository(CartArticle::class)->findOneBy(['article' => $article, 'cart' => $cart]);

            if (is_null($cartArticle)) {
                $cartArticle = new CartArticle();
            } else {
                $cartArticle->setQuantity($cartArticle->getQuantity() + 1);
            }
        }

        $form = $this->createForm(CartType::class, $cart)->submit($request->request->all(), false);

        if($form->isValid() && $form->isSubmitted()) {

            $cart->setUser($user);
            $cart->setCreatedAt(new \DateTime());
            $cart->setState("current");
            $cartArticle->setQuantity($cartArticle->getQuantity() ?? 1);

            $cartArticle->setArticle($article);
            $cart->addCartArticle($cartArticle);

            $em->persist($cart);
            $em->flush();

            return $this->json($cart, 201, [], ['groups' => ['cart']]);
        } else
            dd("error");
            return $this->handleView($this->view($form->getErrors()));
    }
}
