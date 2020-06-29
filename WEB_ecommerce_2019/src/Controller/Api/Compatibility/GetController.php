<?php

namespace App\Controller\Api\Compatibility;

use App\Entity\Compatibility;
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
 * @package App\Controller\Api\Compatibility
 * @Route("/api",name="api_")
 *
 */
class GetController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/compatibilities")
     * @Groups("compatibility")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function getCompatibilitiesAction(EntityManagerInterface $em)
    {
        $compatibilities = $em->getRepository(Compatibility::class)->findAll();

        return $this->json($compatibilities, 200, [], ['groups' => ['compatibility']]);
    }

    /**
     * @Rest\Get("/compatibility/{id}", requirements={"id" = "\d+"})
     * @Groups("compatibility")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     * @throws Exception
     */
    public function getCompatibilityAction(Request $request, EntityManagerInterface $em)
    {
        $compatibility = $em->getRepository(Compatibility::class)->find($request->get('id'));

        if(empty($compatibility)) {
            return $this->handleView(
                $this->view(['status'=>'Compatibility not found'],Response::HTTP_NOT_FOUND));
        }

        return $this->json($compatibility, 200, [], ['groups' => ['compatibility']]);
    }
}
