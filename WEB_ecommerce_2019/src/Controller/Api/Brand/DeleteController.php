<?php

namespace App\Controller\Api\Brand;

use App\Entity\Brand;
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
 * @package App\Controller\Api\Brand
 * @Route("/api",name="api_")
 *
 */
class DeleteController extends AbstractFOSRestController
{
    /**
     * @Rest\Delete("/brand/{id}", requirements={"id" = "\d+"})
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return FormInterface|Response
     */
    public function deleteBrandAction(Request $request, EntityManagerInterface $em)
    {
        $brand = $em->getRepository(Brand::class)->find($request->get('id'));

        if(empty($brand)) {
            return $this->handleView($this->view(['status'=>'Brand not found'],Response::HTTP_NOT_FOUND));
        }

        $em->remove($brand);
        $em->flush();

        return $this->handleView($this->view('Brand deleted', Response::HTTP_ACCEPTED));
    }
}
