<?php

namespace App\Controller\Api\Category;

use App\Entity\Category;
use App\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PutController
 * @package App\Controller\Api\Category
 * @Route("/api",name="api_")
 *
 */
class PutController extends AbstractFOSRestController
{
    /**
     * @Rest\Put("/category/{id}", requirements={"id" = "\d+"})
     * @RequestParam(name="title", description="Le nom d'une catégorie", nullable=false)
     * @RequestParam(name="description", description="La description d'une catégorie", nullable=true)
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return FormInterface|Response
     */
    public function putCategoryAction(Request $request, EntityManagerInterface $em)
    {
        $category = $em->getRepository(Category::class)->find($request->get('id'));

        if(empty($category)) {
            return $this->handleView($this->view(['status'=>'Category not found'],Response::HTTP_NOT_FOUND));
        }

        $form = $this->createForm(CategoryType::class, $category)->submit($request->request->all(), false);
        if($form->isValid() && $form->isSubmitted()) {
            $em->flush();
            $em->refresh($category);

            return $this->handleView($this->view($category,Response::HTTP_ACCEPTED));
        } else
            return $this->handleView($this->view($form->getErrors()));
    }
}
