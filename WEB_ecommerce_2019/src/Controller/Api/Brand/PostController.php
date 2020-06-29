<?php

namespace App\Controller\Api\Brand;

use App\Entity\Brand;
use App\Form\BrandType;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PostController
 * @package App\Controller\Api\Brand
 * @Route("/api",name="api_")
 *
 */
class PostController extends AbstractFOSRestController
{
    /**
     * @Rest\Post("/brand")
     * @RequestParam(name="name", description="Le nom d'une marque", nullable=false)
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return FormInterface|Response
     */
    public function postBrandAction(Request $request, EntityManagerInterface $em)
    {
        $brand   = new Brand();
        $form    = $this->createForm(BrandType::class, $brand)->submit($request->request->all(), true);

        if($form->isValid() && $form->isSubmitted()) {
            $em->persist($brand);
            $em->flush();

            return $this->handleView($this->view($brand,Response::HTTP_CREATED));
        } else
            return $this->handleView($this->view($form->getErrors()));
    }
}
