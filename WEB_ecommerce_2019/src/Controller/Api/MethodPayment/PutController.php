<?php

namespace App\Controller\Api\MethodPayment;

use App\Entity\User;
use App\Entity\MethodPayment;
use App\Form\MethodPaymentType;
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
 * @package App\Controller\Api\MethodPayment
 * @Route("/api",name="api_")
 *
 */
class PutController extends AbstractFOSRestController
{
    /**
     * @Rest\Put("/user/{uid}/methodPayment/{mid}", requirements={"uid" = "\d+", "mid" = "\d+"})
     * @RequestParam(name="information", description="Les informations concernant la méthode de payement", nullable=false)
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return FormInterface|Response
     * @throws Exception
     * @Groups("methodPayment")
     */
    public function putUserAddressAction(Request $request, EntityManagerInterface $em)
    {
        $methodPayment = $em->getRepository(MethodPayment::class)->find($request->get('mid'));
        $user          = $em->getRepository(User::class)->find($request->get('uid'));

        if(empty($methodPayment)) {
            return $this->handleView($this->view(['status'=>'MethodPayment not found'],Response::HTTP_NOT_FOUND));
        }

        if(empty($user)) {
            return $this->handleView($this->view(['status'=>'User not found'],Response::HTTP_NOT_FOUND));
        }

        $form = $this->createForm(MethodPaymentType::class, $methodPayment)->submit($request->request->all(), false);
        if($form->isValid() && $form->isSubmitted()) {
            $em->flush();
            $em->refresh($methodPayment);

            return $this->json($methodPayment, 201, [], ['groups' => ['methodPayment']]);
        } else
            return $this->handleView($this->view($form->getErrors()));
    }
}
