<?php

namespace App\Controller\Api\UserAddress;

use App\Entity\UserAddress;
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
 * @package App\Controller\Api\UserAddress
 * @Route("/api",name="api_")
 *
 */
class GetController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/addresss")
     * @Groups("userAddress")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function getUserAddresssAction(EntityManagerInterface $em)
    {
        $addresss = $em->getRepository(UserAddress::class)->findAll();

        return $this->json($addresss, 200, [], ['groups' => ['userAddress']]);
    }

    /**
     * @Rest\Get("/address/{id}", requirements={"id" = "\d+"})
     * @Groups("userAddress")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     * @throws Exception
     */
    public function getUserAddressAction(Request $request, EntityManagerInterface $em)
    {
        $address = $em->getRepository(UserAddress::class)->find($request->get('id'));

        if(empty($address)) {
            return $this->handleView(
                $this->view(['status'=>'UserAddress not found'],Response::HTTP_NOT_FOUND));
        }

        return $this->json($address, 200, [], ['groups' => ['userAddress']]);
    }
}