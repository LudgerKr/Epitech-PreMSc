<?php

namespace App\Controller\Api\ArticlePurpose;

use App\Entity\ArticlePurpose;
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
 * @package App\Controller\Api\ArticlePurpose
 * @Route("/api",name="api_")
 *
 */
class GetController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/articlePurposes")
     * @Groups("articlePurpose")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function getArticlePurposesAction(EntityManagerInterface $em)
    {
        $articlePurposes = $em->getRepository(ArticlePurpose::class)->findAll();

        return $this->json($articlePurposes, 200, [], ['groups' => ['articlePurpose']]);
    }

    /**
     * @Rest\Get("/articlePurpose/{id}", requirements={"id" = "\d+"})
     * @Groups("articlePurpose")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     * @throws Exception
     */
    public function getArticlePurposeAction(Request $request, EntityManagerInterface $em)
    {
        $articlePurpose = $em->getRepository(ArticlePurpose::class)->find($request->get('id'));

        if(empty($articlePurpose)) {
            return $this->handleView(
                $this->view(['status'=>'ArticlePurpose not found'],Response::HTTP_NOT_FOUND));
        }

        return $this->json($articlePurpose, 200, [], ['groups' => ['articlePurpose']]);
    }
}