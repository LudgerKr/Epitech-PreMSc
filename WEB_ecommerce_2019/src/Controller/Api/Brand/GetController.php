<?php

namespace App\Controller\Api\Brand;

use App\Entity\Brand;
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
 * @package App\Controller\Api\Brand
 * @Route("/api",name="api_")
 *
 */
class GetController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/brands")
     * @Groups("brand")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function getBrandsAction(EntityManagerInterface $em)
    {
        $brands = $em->getRepository(Brand::class)->findAll();

        return $this->json($brands, 200, [], ['groups' => ['brand']]);
    }

    /**
     * @Rest\Get("/brand/{id}", requirements={"id" = "\d+"})
     * @Groups("brand")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     * @throws Exception
     */
    public function getBrandAction(Request $request, EntityManagerInterface $em)
    {
        $brand = $em->getRepository(Brand::class)->find($request->get('id'));

        if(empty($brand)) {
            return $this->handleView(
                $this->view(['status'=>'Brand not found'],Response::HTTP_NOT_FOUND));
        }

        return $this->json($brand, 200, [], ['groups' => ['brand']]);
    }
}
