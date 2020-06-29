<?php

namespace App\Controller\Api\MethodPayment;

use App\Entity\User;
use App\Entity\MethodPayment;
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
     * @Rest\Delete("/user/{uid}/methodPayment/{mid}", requirements={"uid" = "\d+", "mid" = "\d+"})
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return FormInterface|Response
     */
    public function deleteMethodPaymentAction(Request $request, EntityManagerInterface $em)
    {
        $methodPayment = $em->getRepository(MethodPayment::class)->find($request->get('mid'));
        $user          = $em->getRepository(User::class)->find($request->get('uid'));

        if(empty($methodPayment)) {
            return $this->handleView($this->view(['status'=>'MethodPayment not found'],Response::HTTP_NOT_FOUND));
        }

        if(empty($user)) {
            return $this->handleView($this->view(['status'=>'User not found'],Response::HTTP_NOT_FOUND));
        }

        $em->remove($methodPayment);
        $em->flush();

        return $this->handleView($this->view('MethodPayment deleted', Response::HTTP_ACCEPTED));
    }
}