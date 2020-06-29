<?php

namespace App\Controller\Api\Category;

use App\Entity\Category;
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
 * @package App\Controller\Api\Category
 * @Route("/api",name="api_")
 *
 */
class GetController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/categories")
     * @Groups("category")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function getCategoriesAction(EntityManagerInterface $em)
    {
        $categories = $em->getRepository(Category::class)->findAll();

        return $this->json($categories, 200, [], ['groups' => ['category']]);
    }

    /**
     * @Rest\Get("/category/{id}", requirements={"id" = "\d+"})
     * @Groups("category")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     * @throws Exception
     */
    public function getCategoryAction(Request $request, EntityManagerInterface $em)
    {
        $category = $em->getRepository(Category::class)->find($request->get('id'));

        if(empty($category)) {
            return $this->handleView(
                $this->view(['status'=>'Category not found'],Response::HTTP_NOT_FOUND));
        }

        return $this->json($category, 200, [], ['groups' => ['category']]);
    }
}
