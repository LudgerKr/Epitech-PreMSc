<?php

namespace App\Controller\Api\ArticleType;

use App\Entity\ArticleType;
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
 * @package App\Controller\Api\ArticleType
 * @Route("/api",name="api_")
 *
 */
class DeleteController extends AbstractFOSRestController
{
    /**
     * @Rest\Delete("/articleType/{id}", requirements={"id" = "\d+"})
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return FormInterface|Response
     */
    public function deleteArticleTypeAction(Request $request, EntityManagerInterface $em)
    {
        $articleType = $em->getRepository(ArticleType::class)->find($request->get('id'));

        if(empty($articleType)) {
            return $this->handleView($this->view(['status'=>'ArticleType not found'],Response::HTTP_NOT_FOUND));
        }

        $em->remove($articleType);
        $em->flush();

        return $this->handleView($this->view('ArticleType deleted', Response::HTTP_ACCEPTED));
    }
}