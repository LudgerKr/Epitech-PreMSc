<?php

namespace App\Controller\Api\Brand;

use App\Entity\Brand;
use App\Entity\Category;
use App\Form\BrandType;
use App\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PutController
 * @package App\Controller\Api\Brand
 * @Route("/api",name="api_")
 *
 */
class PutController extends AbstractFOSRestController
{
    /**
     * @Rest\Put("/brand/{id}", requirements={"id" = "\d+"})
     * @RequestParam(name="name", description="Le nom d'une marque", nullable=false)
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return FormInterface|Response
     */
    public function putBrandAction(Request $request, EntityManagerInterface $em)
    {
        $brand = $em->getRepository(Brand::class)->find($request->get('id'));

        if(empty($brand)) {
            return $this->handleView($this->view(['status'=>'Brand not found'],Response::HTTP_NOT_FOUND));
        }

        $form = $this->createForm(BrandType::class, $brand)->submit($request->request->all(), false);
        if($form->isValid() && $form->isSubmitted()) {
            $em->flush();
            $em->refresh($brand);

            return $this->handleView($this->view($brand,Response::HTTP_ACCEPTED));
        } else
            return $this->handleView($this->view($form->getErrors()));
    }
}