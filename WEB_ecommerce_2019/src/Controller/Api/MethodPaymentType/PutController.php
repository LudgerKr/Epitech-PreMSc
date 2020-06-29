<?php

namespace App\Controller\Api\MethodPaymentType;

use App\Entity\MethodPaymentType;
use App\Form\MethodPaymentVarietyType;
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
 * Class PutController
 * @package App\Controller\Api\MethodPaymentType
 * @Route("/api",name="api_")
 *
 */
class PutController extends AbstractFOSRestController
{
    /**
     * @Rest\Put("/methodPaymentType/{id}", requirements={"id" = "\d+"})
     * @RequestParam(name="name", description="Le nom concernant le type de méthode de payement", nullable=false)
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return FormInterface|Response
     * @throws Exception
     * @Groups("methodPaymentType")
     */
    public function putUserAddressAction(Request $request, EntityManagerInterface $em)
    {
        $methodPaymentType = $em->getRepository(MethodPaymentType::class)->find($request->get('id'));

        if(empty($methodPaymentType)) {
            return $this->handleView($this->view(['status'=>'MethodPaymentType not found'],Response::HTTP_NOT_FOUND));
        }

        $form = $this->createForm(MethodPaymentVarietyType::class, $methodPaymentType)->submit($request->request->all(), false);
        if($form->isValid() && $form->isSubmitted()) {
            $em->flush();
            $em->refresh($methodPaymentType);

            return $this->json($methodPaymentType, 201, [], ['groups' => ['methodPaymentType']]);
        } else
            return $this->handleView($this->view($form->getErrors()));
    }
}
