<?php

namespace App\Controller\Api\MethodPaymentType;

use App\Entity\MethodPaymentType;
use App\Form\MethodPaymentVarietyType;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use phpDocumentor\Reflection\DocBlock\Tags\Method;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * Class PostController
 * @package App\Controller\Api\MethodPaymentType
 * @Route("/api",name="api_")
 *
 */
class PostController extends AbstractFOSRestController
{
    /**
     * @Rest\Post("/methodPaymentType")
     * @RequestParam(name="name", description="Le nom concernant le type de méthode de payement", nullable=false)
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return FormInterface|Response
     * @throws Exception
     * @Groups("methodPaymentType")
     */
    public function postMethodPaymentTypeAction(Request $request, EntityManagerInterface $em)
    {
        $methodPaymentType  = new MethodPaymentType();

        $form = $this->createForm(MethodPaymentVarietyType::class, $methodPaymentType)->submit($request->request->all(), true);

        if($form->isValid() && $form->isSubmitted()) {
            $em->persist($methodPaymentType);
            $em->flush();

            return $this->json($methodPaymentType, 201, [], ['groups' => ['methodPaymentType']]);
        } else
            return $this->handleView($this->view($form->getErrors()));
    }
}
