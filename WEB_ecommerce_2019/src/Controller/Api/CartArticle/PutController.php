<?php

namespace App\Controller\Api\CartArticle;

use App\Entity\CartArticle;
use App\Entity\Cart;
use App\Form\CartArticleType;
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
 * @package App\Controller\Api\CartArticle
 * @Route("/api",name="api_")
 *
 */
class PutController extends AbstractFOSRestController
{
    /**
     * @Rest\Put("/cartArticle/{caid}", requirements={"caid" = "\d+"})
     * @RequestParam(name="quantity", description="Le quantité des articles dans le panier", nullable=false)
     * @RequestParam(name="article", description="L'article dans le panier", nullable=false)
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return FormInterface|Response
     * @throws Exception
     * @Groups("cartArticle")
     */
    public function putCartArticleAction(Request $request, EntityManagerInterface $em)
    {
        $cartArticle = $em->getRepository(CartArticle::class)->find($request->get('caid'));

        if(empty($cartArticle)) {
            return $this->handleView($this->view(['status'=>'CartArticle not found'],Response::HTTP_NOT_FOUND));
        }

        $form = $this->createForm(CartArticleType::class, $cartArticle)->submit($request->request->all(), false);
        if($form->isValid() && $form->isSubmitted()) {
            $em->flush();
            $em->refresh($cartArticle);

            return $this->json($cartArticle, 201, [], ['groups' => ['cartArticle']]);
        } else
            return $this->handleView($this->view($form->getErrors()));
    }
}
