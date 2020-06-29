<?php

namespace App\Controller\Api\Discount;

use App\Entity\Article;
use App\Entity\Discount;
use App\Entity\User;
use App\Form\DiscountType;
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
use Symfony\Component\Validator\Constraints\Date;

/**
 * Class PostController
 * @package App\Controller\Api\Discount
 * @Route("/api",name="api_")
 *
 */
class PostController extends AbstractFOSRestController
{
    /**
     * @Rest\Post("/discount")
     * @RequestParam(name="value", description="Le pourcentage d'une reduction", nullable=false)
     * @RequestParam(name="user_id", description="L'user bénificiant de la reduction", nullable=false)
     * @RequestParam(name="article_id", description="L'article faisant l'objet de la reduction", nullable=false)
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return FormInterface|Response
     * @Groups("discount")
     * @throws Exception
     */
    public function postDiscountAction(Request $request, EntityManagerInterface $em)
    {
        $discount   = new Discount();
        $beginAt    = new \DateTime();
        $endAt      = date_add($beginAt, date_interval_create_from_date_string('10 days'));

        $form    = $this->createForm(DiscountType::class, $discount)->submit($request->request->all(), true);

        if($form->isValid() && $form->isSubmitted()) {
            $discount->setBeginAt($beginAt);
            $discount->setEndAt($endAt);
            $em->persist($discount);
            $em->flush();

            return $this->json($discount, 200, [], ['groups' => ['discount']]);
        } else
            return $this->handleView($this->view($form->getErrors()));
    }
}
