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
 * Class PutController
 * @package App\Controller\Api\ArticlePurpose
 * @Route("/api",name="api_")
 *
 */
class PutController extends AbstractFOSRestController
{
    /**
     * @Rest\Put("/articlePurpose/{id}", requirements={"id" = "\d+"})
     * @RequestParam(name="name", description="Le nom d'un but d'utilisation d'un article", nullable=false)

     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return FormInterface|Response
     * @throws Exception
     * @Groups("articlePurpose")
     */
    public function putArticlePurposeAction(Request $request, EntityManagerInterface $em)
    {
        $articlePurpose = $em->getRepository(articlePurpose::class)->find($request->get('id'));

        if(empty($articlePurpose)) {
            return $this->handleView($this->view(['status'=>'ArticlePurpose not found'],Response::HTTP_NOT_FOUND));
        }

        $form = $this->createForm(ArticlePurposeType::class, $articlePurpose)->submit($request->request->all(), false);
        if($form->isValid() && $form->isSubmitted()) {
            $em->flush();
            $em->refresh($articlePurpose);

            return $this->json($articlePurpose, 201, [], ['groups' => ['articlePurpose']]);
        } else
            return $this->handleView($this->view($form->getErrors()));
    }
}
