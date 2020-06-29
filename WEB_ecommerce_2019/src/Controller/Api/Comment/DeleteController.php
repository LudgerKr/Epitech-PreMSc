<?php

namespace App\Controller\Api\Comment;

use App\Entity\Article;
use App\Entity\Comment;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DeleteController
 * @package App\Controller\Api\Comment
 * @Route("/api",name="api_")
 *
 */
class DeleteController extends AbstractFOSRestController
{
    /**
     * @Rest\Delete("/comment/{cid}", requirements={"cid" = "\d+"})
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return FormInterface|Response
     */
    public function deleteCommentAction(Request $request, EntityManagerInterface $em)
    {
        $comment = $em->getRepository(Comment::class)->find($request->get('cid'));

        if(empty($comment)) {
            return $this->handleView($this->view(['status'=>'Comment not found'],Response::HTTP_NOT_FOUND));
        }

        $em->remove($comment);
        $em->flush();

        return $this->handleView($this->view('Comment deleted', Response::HTTP_ACCEPTED));
    }
}