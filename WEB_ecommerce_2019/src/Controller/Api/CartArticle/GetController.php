<?php

namespace App\Controller\Api\CartArticle;

use App\Entity\CartArticle;
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
 * @package App\Controller\Api\CartArticle
 * @Route("/api",name="api_")
 *
 */
class GetController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/cartArticles")
     * @Groups("cartArticle")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function getCartArticlesAction(EntityManagerInterface $em)
    {
        $cartArticles = $em->getRepository(CartArticle::class)->findAll();

        return $this->json($cartArticles, 200, [], ['groups' => ['cartArticle']]);
    }

    /**
     * @Rest\Get("/cartArticle/{id}", requirements={"id" = "\d+"})
     * @Groups("cartArticle")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     * @throws Exception
     */
    public function getCartArticleAction(Request $request, EntityManagerInterface $em)
    {
        $cartArticle = $em->getRepository(CartArticle::class)->find($request->get('id'));

        if(empty($cartArticle)) {
            return $this->handleView(
                $this->view(['status'=>'CartArticle not found'],Response::HTTP_NOT_FOUND));
        }

        return $this->json($cartArticle, 200, [], ['groups' => ['cartArticle']]);
    }

    /**
     * @Rest\Get("/cart/{id}/cartArticles", requirements={"id" = "\d+"})
     * @Groups("cartArticle")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     * @throws Exception
     */
    public function getCartCartArticlesAction(Request $request, EntityManagerInterface $em)
    {
        $cartArticle = $em->getRepository(CartArticle::class)->findBy(['cart' => $request->get('id')]);

        if(empty($cartArticle)) {
            return $this->handleView(
                $this->view(['status'=>'CartArticle not found'],Response::HTTP_NOT_FOUND));
        }

        return $this->json($cartArticle, 200, [], ['groups' => ['cartArticle']]);
    }
}