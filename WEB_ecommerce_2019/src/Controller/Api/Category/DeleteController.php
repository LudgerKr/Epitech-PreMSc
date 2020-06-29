<?php

namespace App\Controller\Api\Category;

use App\Entity\Category;
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
 * @package App\Controller\Api\Category
 * @Route("/api",name="api_")
 *
 */
class DeleteController extends AbstractFOSRestController
{
    /**
     * @Rest\Delete("/category/{id}", requirements={"id" = "\d+"})
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return FormInterface|Response
     */
    public function deleteCategoryAction(Request $request, EntityManagerInterface $em)
    {
        $category = $em->getRepository(Category::class)->find($request->get('id'));

        if(empty($category)) {
            return $this->handleView($this->view(['status'=>'Category not found'],Response::HTTP_NOT_FOUND));
        }

        $em->remove($category);
        $em->flush();

        return $this->handleView($this->view('Category deleted', Response::HTTP_ACCEPTED));
    }
}
