<?php

namespace App\Controller\Api\ArticlePurpose;

use App\Entity\ArticlePurpose;
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
 * @package App\Controller\Api\ArticlePurpose
 * @Route("/api",name="api_")
 *
 */
class DeleteController extends AbstractFOSRestController
{
    /**
     * @Rest\Delete("/articlePurpose/{id}", requirements={"id" = "\d+"})
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return FormInterface|Response
     */
    public function deleteArticlePurposeAction(Request $request, EntityManagerInterface $em)
    {
        $articlePurpose = $em->getRepository(ArticlePurpose::class)->find($request->get('id'));

        if(empty($articlePurpose)) {
            return $this->handleView($this->view(['status'=>'ArticlePurpose not found'],Response::HTTP_NOT_FOUND));
        }

        $em->remove($articlePurpose);
        $em->flush();

        return $this->handleView($this->view('ArticlePurpose deleted', Response::HTTP_ACCEPTED));
    }
}