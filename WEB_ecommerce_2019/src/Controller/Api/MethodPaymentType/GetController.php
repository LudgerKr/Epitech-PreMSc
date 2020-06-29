<?php

namespace App\Controller\Api\MethodPaymentType;

use App\Entity\MethodPaymentType;
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
 * @package App\Controller\Api\MethodPaymentType
 * @Route("/api",name="api_")
 *
 */
class GetController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/methodPaymentTypes")
     * @Groups("methodPaymentType")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function getMethodPaymentTypesAction(EntityManagerInterface $em)
    {
        $methodPaymentTypes = $em->getRepository(MethodPaymentType::class)->findAll();

        return $this->json($methodPaymentTypes, 200, [], ['groups' => ['methodPaymentType']]);
    }

    /**
     * @Rest\Get("/methodPaymentType/{id}", requirements={"id" = "\d+"})
     * @Groups("methodPaymentType")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     * @throws Exception
     */
    public function getMethodPaymentTypeAction(Request $request, EntityManagerInterface $em)
    {
        $methodPaymentType = $em->getRepository(MethodPaymentType::class)->find($request->get('id'));

        if(empty($methodPaymentType)) {
            return $this->handleView(
                $this->view(['status'=>'MethodPaymentType not found'],Response::HTTP_NOT_FOUND));
        }

        return $this->json($methodPaymentType, 200, [], ['groups' => ['methodPaymentType']]);
    }
}