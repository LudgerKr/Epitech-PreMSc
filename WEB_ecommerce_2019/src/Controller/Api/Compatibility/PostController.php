<?php

namespace App\Controller\Api\Compatibility;

use App\Entity\Compatibility;
use App\Form\CompatibilityType;
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
 * Class PostController
 * @package App\Controller\Api\Compatibility
 * @Route("/api",name="api_")
 *
 */
class PostController extends AbstractFOSRestController
{
    /**
     * @Rest\Post("/compatibility")
     * @RequestParam(name="name", description="Le nom d'une compatibilité", nullable=false)
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return FormInterface|Response
     * @Groups("compatibility")
     */
    public function postCompatibilityAction(Request $request, EntityManagerInterface $em)
    {
        $compatibility   = new Compatibility();
        $form    = $this->createForm(CompatibilityType::class, $compatibility)->submit($request->request->all(), true);

        if($form->isValid() && $form->isSubmitted()) {
            $em->persist($compatibility);
            $em->flush();

            return $this->json($compatibility, 201, [], ['groups' => ['compatibility']]);
        } else
            return $this->handleView($this->view($form->getErrors()));
    }
}
