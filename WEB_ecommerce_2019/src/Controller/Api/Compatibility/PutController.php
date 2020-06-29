<?php

namespace App\Controller\Api\Compatibility;

use App\Entity\Compatibility;
use App\Entity\Category;
use App\Form\CompatibilityType;
use App\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
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
 * @package App\Controller\Api\Compatibility
 * @Route("/api",name="api_")
 *
 */
class PutController extends AbstractFOSRestController
{
    /**
     * @Rest\Put("/compatibility/{id}", requirements={"id" = "\d+"})
     * @RequestParam(name="name", description="Le nom d'une compatibilité", nullable=false)
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return FormInterface|Response
     * @Groups("compatiblity")
     */
    public function putCompatibilityAction(Request $request, EntityManagerInterface $em)
    {
        $compatibility = $em->getRepository(Compatibility::class)->find($request->get('id'));

        if(empty($compatibility)) {
            return $this->handleView($this->view(['status'=>'Compatibility not found'],Response::HTTP_NOT_FOUND));
        }

        $form = $this->createForm(CompatibilityType::class, $compatibility)->submit($request->request->all(), false);
        if($form->isValid() && $form->isSubmitted()) {
            $em->flush();
            $em->refresh($compatibility);

            return $this->json($compatibility, 201, [], ['groups' => ['compatibility']]);
        } else
            return $this->handleView($this->view($form->getErrors()));
    }
}