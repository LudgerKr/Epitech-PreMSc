<?php

namespace App\Controller;

use App\Controller\Api\ApiAbstractController;
use App\Entity\Comment;
use App\Form\Api\ArticleType;
use App\Form\Api\CommentType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Class ArticleController
 * @package App\Controller
 * @Route("/article")
 */
class ArticleController extends ApiAbstractController
{

    private $_headers;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $this->_headers = [
            'Authorization' => 'Bearer ' . $this->getTokenAction()->getContent(),
            'Accept'        => 'application/json',
        ];
    }

    /**
     * @Route("/", name="article_index")
     * @param PaginatorInterface $paginator
     * @return Response
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $client = HttpClient::create();
	dd($this->getTokenAction()->getContent());
        $response = $client->request("GET", "http://127.0.0.1:8000/api/articles",[
            'headers' => $this->_headers
        ]);
        $datas = $response->toArray();
        $articles = $paginator->paginate(
            $datas, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            12 // Nombre de résultats par page
        );

        return $this->render('article/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/show/{id}", name ="article_show")
     * @param $id
     * @param Request $request
     * @return Response
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function show($id, Request $request) {
        $user = $this->getUser();
        $client = HttpClient::create();

        $articleResponse = $client->request("GET", "http://127.0.0.1:8000/api/article/" . $id, [
            'headers' => $this->_headers
        ]);
        $article = $articleResponse->toArray();

        $commentsResponse = $client->request("GET", "http://127.0.0.1:8000/api/article/" . $id . "/comments", [
            'headers' => $this->_headers
        ]);
        $comments = [];
        if ($commentsResponse->getStatusCode() === 200) {
            $comments = $commentsResponse->toArray();
        }

        $form = $this->createForm(CommentType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $formFields = [
                'author' => $user->getUsername(),
                'content' => $form->get('content')->getData(),
                'mark' => $form->get('mark')->getData(),
            ];

            $client->request("POST", "http://127.0.0.1:8000/api/article/" . $id . "/comment", [
                'body' => $formFields,
                'headers' => $this->_headers
            ]);


            return $this->redirectToRoute('article_show', ['id' => $id]);
        }


        return $this->render('article/show.html.twig', [
            'article' => $article,
            'comments'=> $comments,
            'commentForm' => $form->createView(),
        ]);
    }

    /**
     * @param int $id | null
     * @param Request $request
     * @return Response
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @Route("/new", name="article_create")
     * @Route("/edit/{id}", name="article_edit")
     * @isGranted("ROLE_ADMIN")
     */
    public function create($id = null, Request $request) {
        $client = HttpClient::create();
        $article = null;
        $method = "POST";
        $url = "http://127.0.0.1:8000/api/article";

        if ($id) {
            $method = "PUT";
            $url = "http://127.0.0.1:8000/api/article/" . $id;
            $articleResponse = $client->request("GET", "http://127.0.0.1:8000/api/article/" . $id, [
                'headers' => $this->_headers
            ]);
            $article = $articleResponse->toArray();
        }

        $categoriesResponse = $client->request("GET", "http://127.0.0.1:8000/api/categories", [
            'headers' => $this->_headers
        ]);
        $compatibilitiesResponse = $client->request("GET", "http://127.0.0.1:8000/api/compatibilities", [
            'headers' => $this->_headers
        ]);
        $articleTypesResponse = $client->request("GET", "http://127.0.0.1:8000/api/articleTypes", [
            'headers' => $this->_headers
        ]);

        $articlePurposesResponse = $client->request("GET", "http://127.0.0.1:8000/api/articlePurposes", [
            'headers' => $this->_headers
        ]);
        $brandsResponse = $client->request("GET", "http://127.0.0.1:8000/api/brands", [
            'headers' => $this->_headers
        ]);

        $option = [
            'categories' => $categoriesResponse->toArray(),
            'compatibilities' => $compatibilitiesResponse->toArray(),
            'articleTypes' => $articleTypesResponse->toArray(),
            'articlePurposes' => $articlePurposesResponse->toArray(),
            'brands' => $brandsResponse->toArray(),
            'article' => $article,
        ];

        $form = $this->createForm(ArticleType::class, $option);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $date = new \DateTime();

            $formFields = [
                'title' => $form->get('title')->getData(),
                'category' => $form->get('category')->getData(),
                'content' => $form->get('content')->getData(),
                'weight' => $form->get('weight')->getData(),
                'height' => $form->get('height')->getData(),
                'width' => $form->get('width')->getData(),
                'length' => $form->get('length')->getData(),
                'stock' => $form->get('stock')->getData(),
                'price' => $form->get('price')->getData(),
                'imageMain' => $form->get('imageMain')->getData(),
                'image1' => $form->get('image1')->getData(),
                'image2' => $form->get('image3')->getData(),
                'image3' => $form->get('image2')->getData(),
                'compatibility' => $form->get('compatibility')->getData(),
                'articleType' => $form->get('articleType')->getData(),
                'articlePurpose' => $form->get('articlePurpose')->getData(),
                'brand' => $form->get('brand')->getData()
            ];

            $articleResponse = $client->request($method, $url, [
                'body' => $formFields,
                'headers' => $this->_headers
            ]);

            var_dump($formFields);

            if ($articleResponse->getStatusCode() === 201) {
                $article = $articleResponse->toArray();
                return $this->redirectToRoute('article_show', ['id' => $article['id']]);
            }
            $this->addFlash(
                'danger',
                "Une erreur est survenue !"
            );
        }

        return $this->render('article/create.html.twig', [
            'formArticle' => $form->createView(),
            'editMode' => $id
        ]);
    }

    /**
     * @Route("/delete/{id}", name="article_delete")
     * @param $id
     * @return RedirectResponse
     * @throws TransportExceptionInterface
     * @isGranted("ROLE_ADMIN")
     */
    public function delete($id) {
        $client = HttpClient::create();

        $response = $client->request("DELETE", "http://127.0.0.1:8000/api/article/" . $id , [
            'headers' => $this->_headers
        ]);

        if ($response->getStatusCode() === 202) {

            $this->addFlash(
                'warning',
                "l'article $id a bien été supprimé !"
            );
            return $this->redirectToRoute('article_index');
        }
        $this->addFlash(
            'danger',
            "Une erreur est survenue !"
        );
        return $this->redirectToRoute("article_show", ['id' => $id]);
    }

    /**
     * @Route("/delete/comment/{id}", name="article_comment_delete")
     * @IsGranted("ROLE_USER")
     */
    public function deleteComment(Request $request, $id) {
        $client = HttpClient::create();
        $user = $this->getUser();

        $responseMessage = $client->request("GET", "http://127.0.0.1:8000/api/comment/" . $id, [
            'headers' => $this->_headers
        ]);

        if ($responseMessage->getStatusCode() !== 200) {
            $this->addFlash('danger', "aucun commentaire trouver !");

            return $this->redirectToRoute('article_show', [
                'id' => $request->get('articleId')
            ]);
        }
        $comment = $responseMessage->toArray();

        if ($this->isGranted("ROLE_ADMIN") or $comment['author'] === $user->getUsername()) {
            $responseMessageDelete = $client->request("DELETE", "http://127.0.0.1:8000/api/comment/" . $id, [
                'headers' => $this->_headers
            ]);

            if ($responseMessageDelete->getStatusCode() !== 202) {
                $this->addFlash("danger", "Une érreur est survenue");
            } else {
                $this->addFlash("success", "Le commentaire a été suprimer !");
            }
        } else {
            $this->addFlash('danger', "Vous n'avez pas les droit de suprimer ce commentaire !");
        }

        return $this->redirectToRoute('article_show', [
            'id' => $request->get('articleId')
        ]);
    }
}
