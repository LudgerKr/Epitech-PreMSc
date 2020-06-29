<?php

namespace App\Controller\Api\MethodPaymentType;

use App\Entity\MethodPaymentType;
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
 * @package App\Controller\Api\MethodPayment
 * @Route("/api",name="api_")
 *
 */
class DeleteController extends AbstractFOSRestController
{
    /**
     * @Rest\Delete("/methodPaymentType/{id}", requirements={"id" = "\d+"})
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return FormInterface|Response
     */
    public function deleteMethodPaymentTypeAction(Request $request, EntityManagerInterface $em)
    {
        $methodPaymentType = $em->getRepository(MethodPaymentType::class)->find($request->get('id'));

        if(empty($methodPaymentType)) {
            return $this->handleView($this->view(['status'=>'MethodPaymentType not found'],Response::HTTP_NOT_FOUND));
        }

        $em->remove($methodPaymentType);
        $em->flush();

        return $this->handleView($this->view('MethodPaymentType deleted', Response::HTTP_ACCEPTED));
    }
}