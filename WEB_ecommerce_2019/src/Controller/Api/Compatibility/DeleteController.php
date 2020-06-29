<?php

namespace App\Controller\Api\Compatibility;

use App\Entity\Compatibility;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DeleteController
 * @package App\Controller\Api\Compatibility
 * @Route("/api",name="api_")
 *
 */
class DeleteController extends AbstractFOSRestController
{
    /**
     * @Rest\Delete("/compatibility/{id}", requirements={"id" = "\d+"})
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return FormInterface|Response
     */
    public function deleteCompatibilityAction(Request $request, EntityManagerInterface $em)
    {
        $compatibility = $em->getRepository(Compatibility::class)->find($request->get('id'));

        if(empty($compatibility)) {
            return $this->handleView($this->view(['status'=>'Compatibility not found'],Response::HTTP_NOT_FOUND));
        }

        $em->remove($compatibility);
        $em->flush();

        return $this->handleView($this->view('Compatibility deleted', Response::HTTP_ACCEPTED));
    }
}
