<?php

namespace App\Controller\Api\User;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * Class PostController
 * @package App\Controller\Api\User
 * @Route("/api",name="api_")
 *
 */
class PostController extends AbstractFOSRestController
{
    /**
     * @Rest\Post("/user", requirements={"id" = "\d+"})
     * @RequestParam(name="email", description="L'email d'un utilisateur", nullable=false)
     * @RequestParam(name="username", description="Le pseudo d'un utilisateur", nullable=false)
     * @RequestParam(name="password", description="Le mot de passe d'un utilisateur", nullable=false)
     * @RequestParam(name="confirm_password", description="La confirmation du mot de passe de l'utilisateur", nullable=false)
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param UserPasswordEncoderInterface $encoder
     * @return FormInterface|Response
     * @throws Exception
     * @Groups("user")
     */
    public function postUserAction(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user)->submit($request->request->all(), true);

        if($form->isValid() && $form->isSubmitted()) {
            // @TODO A supprimer en prod
            $user->setBirthdate(new \DateTime());

            $hash = $encoder->encodePassword($user, $user->getPassword());

            $user->setPassword($hash);
            $user->setCreatedAt(new \DateTime());
            $em->persist($user);
            $em->flush();

            return $this->json($user, 201, [], ['groups' => ['user']]);
        } else
            return $this->handleView($this->view($form->getErrors()));
    }
}
