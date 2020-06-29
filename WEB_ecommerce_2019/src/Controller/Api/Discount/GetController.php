<?php

namespace App\Controller\Api\Discount;

use App\Entity\Discount;
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
 * @package App\Controller\Api\Discount
 * @Route("/api",name="api_")
 *
 */
class GetController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/discounts")
     * @Groups("discount")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function getDiscountsAction(EntityManagerInterface $em)
    {
        $discounts = $em->getRepository(Discount::class)->findAll();

        return $this->json($discounts, 200, [], ['groups' => ['discount']]);
    }

    /**
     * @Rest\Get("/discount/{id}", requirements={"id" = "\d+"})
     * @Groups("discount")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     * @throws Exception
     */
    public function getDiscountAction(Request $request, EntityManagerInterface $em)
    {
        $discount = $em->getRepository(Discount::class)->find($request->get('id'));

        if(empty($discount)) {
            return $this->handleView(
                $this->view(['status'=>'Discount not found'],Response::HTTP_NOT_FOUND));
        }

        return $this->json($discount, 200, [], ['groups' => ['discount']]);
    }
}
