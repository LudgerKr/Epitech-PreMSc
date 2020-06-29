<?php

namespace App\Controller\Api\ArticleType;

use App\Entity\ArticleType;
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
 * @package App\Controller\Api\ArticleType
 * @Route("/api",name="api_")
 *
 */
class GetController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/articleTypes")
     * @Groups("articleType")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function getArticleTypesAction(EntityManagerInterface $em)
    {
        $articleTypes = $em->getRepository(ArticleType::class)->findAll();

        return $this->json($articleTypes, 200, [], ['groups' => ['articleType']]);
    }

    /**
     * @Rest\Get("/articleType/{id}", requirements={"id" = "\d+"})
     * @Groups("articleType")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     * @throws Exception
     */
    public function getArticleTypeAction(Request $request, EntityManagerInterface $em)
    {
        $articleType = $em->getRepository(ArticleType::class)->find($request->get('id'));

        if(empty($articleType)) {
            return $this->handleView(
                $this->view(['status'=>'ArticleType not found'],Response::HTTP_NOT_FOUND));
        }

        return $this->json($articleType, 200, [], ['groups' => ['articleType']]);
    }
}