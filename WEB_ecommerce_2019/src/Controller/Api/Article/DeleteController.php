<?php

namespace App\Controller\Api\Article;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * Class DeleteController
 * @package App\Controller\Api\Article
 * @Route("/api",name="api_")
 *
 */
class DeleteController extends AbstractFOSRestController
{
    /**
     * @Rest\Delete("/article/{id}", requirements={"id" = "\d+"})
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return FormInterface|Response
     * @Groups("article")
     */
    public function deleteArticleAction(Request $request, EntityManagerInterface $em)
    {
        $article = $em->getRepository(Article::class)->find($request->get('id'));

        if(empty($article)) {
            return $this->handleView($this->view(['status'=>'Article not found'],Response::HTTP_NOT_FOUND));
        }

        $em->remove($article);
        $em->flush();

        return $this->handleView($this->view('Article deleted', Response::HTTP_ACCEPTED));
    }
}
