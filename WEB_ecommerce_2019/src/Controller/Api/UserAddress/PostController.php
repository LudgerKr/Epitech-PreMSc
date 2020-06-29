<?php

namespace App\Controller\Api\UserAddress;

use App\Entity\User;
use App\Entity\UserAddress;
use App\Form\UserAddressType;
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
 * @package App\Controller\Api\UserAddress
 * @Route("/api",name="api_")
 *
 */
class PostController extends AbstractFOSRestController
{
    /**
     * @Rest\Post("/user/{id}/address", requirements={"id" = "\d+"})
     * @RequestParam(name="address1", description="L'adresse de facturation", nullable=false)
     * @RequestParam(name="address1", description="L'adresse de livraison", nullable=false)
    *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return FormInterface|Response
     * @throws Exception
     * @Groups("userAddress")
     */
    public function postUserAddressAction(Request $request, EntityManagerInterface $em)
    {
        $address = new UserAddress();
        $user    = $em->getRepository(User::class)->find($request->get('id'));

        if(empty($user)) {
            return $this->handleView($this->view(['status'=>'User not found'],Response::HTTP_NOT_FOUND));
        }

        $form = $this->createForm(UserAddressType::class, $address)->submit($request->request->all(), true);

        if($form->isValid() && $form->isSubmitted()) {
            $address->setUser($user);
            $em->persist($address);
            $em->flush();

            return $this->json($address, 201, [], ['groups' => ['userAddress']]);
        } else
            return $this->handleView($this->view($form->getErrors()));
    }
}
