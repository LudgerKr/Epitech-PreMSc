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
 * Class PostController
 * @package App\Controller\Api\ArticleType
 * @Route("/api",name="api_")
 *
 */
class PostController extends AbstractFOSRestController
{
    /**
     * @Rest\Post("/articleType", requirements={"id" = "\d+"})
     * @RequestParam(name="name", description="Le nom d'un type d'article", nullable=false)
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return FormInterface|Response
     * @throws Exception
     * @Groups("articleType")
     */
    public function postArticleTypeAction(Request $request, EntityManagerInterface $em)
    {
        $articleType    = new ArticleType();
        $form           = $this->createForm(ArticleVarietyType::class, $articleType)->submit($request->request->all(), true);

        if($form->isValid() && $form->isSubmitted()) {
            $em->persist($articleType);
            $em->flush();

            return $this->json($articleType, 201, [], ['groups' => ['articleType']]);
        } else
            return $this->handleView($this->view($form->getErrors()));
    }
}
