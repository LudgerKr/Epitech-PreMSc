<?php

namespace App\Controller\Api\Comment;

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
 * @package App\Controller\Api\Comment
 * @Route("/api",name="api_")
 *
 */
class GetController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/comments")
     * @Groups("comment")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function getCommentsAction(EntityManagerInterface $em)
    {
        $comments = $em->getRepository(Comment::class)->findAll();

        return $this->json($comments, 200, [], ['groups' => ['comment']]);
    }

    /**
     * @Rest\Get("/comment/{id}", requirements={"id" = "\d+"})
     * @Groups("comment")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     * @throws Exception
     */
    public function getCommentAction(Request $request, EntityManagerInterface $em)
    {
        $comment = $em->getRepository(Comment::class)->find($request->get('id'));

        if(empty($comment)) {
            return $this->handleView(
                $this->view(['status'=>'Comment not found'],Response::HTTP_NOT_FOUND));
        }

        return $this->json($comment, 200, [], ['groups' => ['comment']]);
    }
}