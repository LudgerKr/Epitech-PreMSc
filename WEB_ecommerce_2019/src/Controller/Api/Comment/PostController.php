<?php

namespace App\Controller\Api\Comment;

use App\Entity\Article;
use App\Entity\Comment;
use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * Class PostController
 * @package App\Controller\Api\Comment
 * @Route("/api",name="api_")
 *
 */
class PostController extends AbstractFOSRestController
{
    /**
     * @Rest\Post("/article/{aid}/comment", requirements={"aid" = "\d+"})
     * @RequestParam(name="author", description="L'auteur d'un commentaire", nullable=false)
     * @RequestParam(name="content", description="Le contenu d'un commentaire", nullable=false)
     * @RequestParam(name="mark", description="La note d'un commentaire", nullable=false)
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return FormInterface|Response
     * @throws Exception
     * @Groups("comment")
     */
    public function postCommentAction(Request $request, EntityManagerInterface $em)
    {
        $comment   = new Comment();
        $articleId = $em->getRepository(Article::class)->find($request->get('aid'));

        if(empty($articleId)) {
            return $this->handleView(
                $this->view(['status'=>'Article not found'],Response::HTTP_NOT_FOUND));
        }

        $form      = $this->createForm(CommentType::class, $comment)->submit($request->request->all(), true);

        if($form->isValid() && $form->isSubmitted()) {
            $comment->setCreatedAt(new \DateTime());
            $comment->setArticle($articleId);
            $em->persist($comment);
            $em->flush();

            return $this->json($comment, 201, [], ['groups' => ['comment']]);
        } else
            return $this->handleView($this->view($form->getErrors()));
    }
}
