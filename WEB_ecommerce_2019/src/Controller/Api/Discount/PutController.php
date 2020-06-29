<?php

namespace App\Controller\Api\Discount;

use App\Entity\Discount;
use App\Entity\Category;
use App\Form\DiscountType;
use App\Form\CategoryType;
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
 * Class PutController
 * @package App\Controller\Api\Discount
 * @Route("/api",name="api_")
 *
 */
class PutController extends AbstractFOSRestController
{
    /**
     * @Rest\Put("/discount/{id}", requirements={"id" = "\d+"})
     * @RequestParam(name="value", description="Le pourcentage d'une reduction", nullable=false)
     * @RequestParam(name="user_id", description="L'user bénificiant de la reduction", nullable=false)
     * @RequestParam(name="article_id", description="L'article faisant l'objet de la reduction", nullable=false)
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return FormInterface|Response
     * @Groups("discount")
     */
    public function putDiscountAction(Request $request, EntityManagerInterface $em)
    {
        $discount = $em->getRepository(Discount::class)->find($request->get('id'));

        if(empty($discount)) {
            return $this->handleView($this->view(['status'=>'Discount not found'],Response::HTTP_NOT_FOUND));
        }

        $form = $this->createForm(DiscountType::class, $discount)->submit($request->request->all(), false);
        if($form->isValid() && $form->isSubmitted()) {
            $em->flush();
            $em->refresh($discount);

            return $this->json($discount, 200, [], ['groups' => ['discount']]);
        } else
            return $this->handleView($this->view($form->getErrors()));
    }
}