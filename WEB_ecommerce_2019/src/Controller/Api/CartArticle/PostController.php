<?php

namespace App\Controller\Api\CartArticle;

use App\Entity\CartArticle;
use App\Entity\Cart;
use App\Form\CartArticleType;
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
 * @package App\Controller\Api\CartArticle
 * @Route("/api",name="api_")
 *
 */
class PostController extends AbstractFOSRestController
{
    /**
     * @Rest\Post("/cart/{id}/cartArticle", requirements={"id" = "\d+"})
     * @RequestParam(name="quantity", description="Le quantité des articles dans le panier", nullable=false)
     * @RequestParam(name="article", description="L'article dans le panier", nullable=false)
    *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return FormInterface|Response
     * @throws Exception
     * @Groups("cartArticle")
     */
    public function postCartArticleAction(Request $request, EntityManagerInterface $em)
    {
        $cartArticle = new CartArticle();
        $cart = $em->getRepository(Cart::class)->find($request->get('id'));

        if(empty($cart)) {
            return $this->handleView($this->view(['status'=>'Cart not found'],Response::HTTP_NOT_FOUND));
        }

        $form = $this->createForm(CartArticleType::class, $cartArticle)->submit($request->request->all(), true);

        if($form->isValid() && $form->isSubmitted()) {
            $cartArticle->setCart($cart);
            $em->persist($cartArticle);
            $em->flush();

            return $this->json($cartArticle, 201, [], ['groups' => ['cartArticle']]);
        } else
            return $this->handleView($this->view($form->getErrors()));
    }
}
