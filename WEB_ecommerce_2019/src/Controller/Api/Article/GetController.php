<?php

namespace App\Controller\Api\Article;

use App\Entity\Article;
use App\Entity\Comment;
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
 * @package App\Controller\Api\Article
 * @Route("/api",name="api_")
 *
 */
class GetController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/articles")
     * @Groups("article")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function getArticlesAction(EntityManagerInterface $em)
    {
        $articles = $em->getRepository(Article::class)->findAll();

        return $this->json($articles, 200, [], ['groups' => ['article']]);
    }

    /**
     * @Rest\Get("/article/{id}", requirements={"id" = "\d+"})
     * @Groups("article")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     * @throws Exception
     */
    public function getArticleAction(Request $request, EntityManagerInterface $em)
    {
        $article = $em->getRepository(Article::class)->find($request->get('id'));

        if(empty($article)) {
            return $this->handleView(
                $this->view(['status'=>'article not found'],Response::HTTP_NOT_FOUND));
        }

        return $this->json($article, 200, [], ['groups' => ['article']]);
    }


    /**
     * @Rest\Get("/article/{id}/comments", requirements={"id" = "\d+"})
     * @Groups("comment")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     * @throws Exception
     */
    public function getArticleCommentsAction(Request $request, EntityManagerInterface $em)
    {
        $article = $em->getRepository(Comment::class)->findBy(['article' => $request->get('id')]);

        if(empty($article)) {
            return $this->handleView(
                $this->view(['status'=>'article have no comments'],Response::HTTP_NOT_FOUND));
        }

        return $this->json($article, 200, [], ['groups' => ['comment']]);
    }
}
