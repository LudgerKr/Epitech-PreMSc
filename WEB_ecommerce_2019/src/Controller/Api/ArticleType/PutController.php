<?php

namespace App\Controller\Api\ArticleType;

use App\Entity\ArticleType;
use App\Form\ArticleVarietyType;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class PutController
 * @package App\Controller\Api\ArticleType
 * @Route("/api",name="api_")
 *
 */
class PutController extends AbstractFOSRestController
{
    /**
     * @Rest\Put("/articleType/{id}", requirements={"id" = "\d+"})
     * @RequestParam(name="name", description="Le nom d'un type d'article", nullable=false)

     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return FormInterface|Response
     * @throws Exception
     * @Groups("articleType")
     */
    public function putArticleTypeAction(Request $request, EntityManagerInterface $em)
    {
        $articleType = $em->getRepository(ArticleType::class)->find($request->get('id'));

        if(empty($articleType)) {
            return $this->handleView($this->view(['status'=>'ArticleType not found'],Response::HTTP_NOT_FOUND));
        }

        $form = $this->createForm(ArticleVarietyType::class, $articleType)->submit($request->request->all(), false);
        if($form->isValid() && $form->isSubmitted()) {
            $em->flush();
            $em->refresh($articleType);

            return $this->json($articleType, 201, [], ['groups' => ['articleType']]);
        } else
            return $this->handleView($this->view($form->getErrors()));
    }
}
