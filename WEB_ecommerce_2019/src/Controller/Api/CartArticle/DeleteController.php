<?php

namespace App\Controller\Api\CartArticle;

use App\Entity\CartArticle;
use App\Entity\Cart;
use App\Entity\User;
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
 * @package App\Controller\Api\CartArticle
 * @Route("/api",name="api_")
 *
 */
class DeleteController extends AbstractFOSRestController
{
    /**
     * @Rest\Delete("/cartArticle/{caid}", requirements={"caid" = "\d+"})
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return FormInterface|Response
     */
    public function deleteCartArticleAction(Request $request, EntityManagerInterface $em)
    {
        $cartArticle = $em->getRepository(CartArticle::class)->find($request->get('caid'));

        if(empty($cartArticle)) {
            return $this->handleView($this->view(['status'=>'CartArticle not found'],Response::HTTP_NOT_FOUND));
        }

        $em->remove($cartArticle);
        $em->flush();

        return $this->handleView($this->view('CartArticle deleted', Response::HTTP_ACCEPTED));
    }
}