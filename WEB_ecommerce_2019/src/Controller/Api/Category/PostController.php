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
 * Class PostController
 * @package App\Controller\Api\Category
 * @Route("/api",name="api_")
 *
 */
class PostController extends AbstractFOSRestController
{
    /**
     * @Rest\Post("/category")
     * @RequestParam(name="title", description="Le nom d'une catégorie", nullable=false)
     * @RequestParam(name="description", description="La description d'une catégorie", nullable=true)
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return FormInterface|Response
     */
    public function postCategoryAction(Request $request, EntityManagerInterface $em)
    {
        $category   = new Category();
        $form       = $this->createForm(CategoryType::class, $category)->submit($request->request->all(), true);

        if($form->isValid() && $form->isSubmitted()) {
            $em->persist($category);
            $em->flush();

            return $this->handleView($this->view($category,Response::HTTP_CREATED));
        } else
            return $this->handleView($this->view($form->getErrors()));
    }
}
