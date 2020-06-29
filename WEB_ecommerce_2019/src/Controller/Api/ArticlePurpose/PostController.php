<?php

namespace App\Controller\Api\ArticlePurpose;

use App\Entity\ArticlePurpose;
use App\Form\ArticlePurposeType;
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
 * @package App\Controller\Api\ArticlePurpose
 * @Route("/api",name="api_")
 *
 */
class PostController extends AbstractFOSRestController
{
    /**
     * @Rest\Post("/articlePurpose", requirements={"id" = "\d+"})
     * @RequestParam(name="name", description="Le nom d'un but d'utilisation d'un article", nullable=false)
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return FormInterface|Response
     * @throws Exception
     * @Groups("articlePurpose")
     */
    public function postArticlePurposeAction(Request $request, EntityManagerInterface $em)
    {
        $articlePurpose = new articlePurpose();
        $form           = $this->createForm(ArticlePurposeType::class, $articlePurpose)->submit($request->request->all(), true);

        if($form->isValid() && $form->isSubmitted()) {
            $em->persist($articlePurpose);
            $em->flush();

            return $this->json($articlePurpose, 201, [], ['groups' => ['articlePurpose']]);
        } else
            return $this->handleView($this->view($form->getErrors()));
    }
}
