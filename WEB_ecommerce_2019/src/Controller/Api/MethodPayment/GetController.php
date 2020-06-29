<?php

namespace App\Controller\Api\MethodPayment;

use App\Entity\MethodPayment;
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
 * @package App\Controller\Api\MethodPayment
 * @Route("/api",name="api_")
 *
 */
class GetController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/methodPayments")
     * @Groups("methodPayment")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function getMethodPaymentsAction(EntityManagerInterface $em)
    {
        $methodPayments = $em->getRepository(MethodPayment::class)->findAll();

        return $this->json($methodPayments, 200, [], ['groups' => ['methodPayment']]);
    }

    /**
     * @Rest\Get("/methodPayment/{id}", requirements={"id" = "\d+"})
     * @Groups("methodPayment")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     * @throws Exception
     */
    public function getMethodPaymentAction(Request $request, EntityManagerInterface $em)
    {
        $methodPayment = $em->getRepository(MethodPayment::class)->find($request->get('id'));

        if(empty($methodPayment)) {
            return $this->handleView(
                $this->view(['status'=>'MethodPayment not found'],Response::HTTP_NOT_FOUND));
        }

        return $this->json($methodPayment, 200, [], ['groups' => ['methodPayment']]);
    }
}