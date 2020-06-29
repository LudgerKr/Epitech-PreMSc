<?php

namespace App\Controller\Api\Article;

use App\Entity\Article;
use App\Form\ArticleType;
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
 * @package App\Controller\Api\Article
 * @Route("/api",name="api_")
 *
 */
class PostController extends AbstractFOSRestController
{
    /**
     * @Rest\Post("/article")
     * @RequestParam(name="title", description="Le titre d'un article", nullable=false)
     * @RequestParam(name="content", description="Le contenu d'un article", nullable=false)
     * @RequestParam(name="weight", description="Le poids d'un article", nullable=false)
     * @RequestParam(name="height", description="Le hauteur d'un article", nullable=false)
     * @RequestParam(name="width", description="La largeur d'un article", nullable=false)
     * @RequestParam(name="length", description="La longueur d'un article", nullable=false)
     * @RequestParam(name="stock", description="Le stock d'un article", nullable=false)
     * @RequestParam(name="price", description="Le prix d'un article", nullable=false)
     * @RequestParam(name="imageMain", description="L'image de présentation d'un article", nullable=false)
     * @RequestParam(name="image1", description="L'image 1 d'un article", nullable=true)
     * @RequestParam(name="image2", description="L'image 2 d'un article", nullable=true)
     * @RequestParam(name="image3", description="L'image 3 d'un article", nullable=true)
     * @RequestParam(name="category", description="La catégorie d'un article", nullable=false)
     * @RequestParam(name="compatibility", description="La compatibilité d'un article", nullable=false)
     * @RequestParam(name="articleType", description="Le type d'un article", nullable=false)
     * @RequestParam(name="articlePurpose", description="Le but d'utilisation d'un article", nullable=false)
     * @RequestParam(name="brand", description="La marque d'un article", nullable=false)
     * @RequestParam(name="discounts", description="La remise d'un article", nullable=true)
     * @RequestParam(name="comments", description="Les commentaires d'un article", nullable=false)
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return FormInterface|Response
     * @throws Exception
     * @Groups("article")
     */
    public function postArticleAction(Request $request, EntityManagerInterface $em)
    {
        $article = new Article();
        $form    = $this->createForm(ArticleType::class, $article)->submit($request->request->all(), true);
        if($form->isValid() && $form->isSubmitted()) {
            $article->setCreatedAt(new \DateTime());
            $em->persist($article);
            $em->flush();

            return $this->json($article, 201, [], ['groups' => ['article']]);
        } else
            return $this->handleView($this->view($form->getErrors()));
    }
}
