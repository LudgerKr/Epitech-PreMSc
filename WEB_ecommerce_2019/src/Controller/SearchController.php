<?php

namespace App\Controller;

use App\Controller\Api\ApiAbstractController;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class SearchController extends ApiAbstractController
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
     * @Route("/search/", name="search", methods={"POST"})
     * @return Response
     * @throws TransportExceptionInterface
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $client = HttpClient::create();

        $query = $request->get('query');
        if (is_null($query)) {
            return $this->redirectToRoute('article_index');
        }

        $response = $client->request("GET", "http://127.0.0.1:8000/api/search/" . $query, [
            'headers' => $this->_headers
        ]);

        $articlesArray = $response->toArray();

        if (empty($articlesArray)) {
            return $this->render('search/index.html.twig');
        }

        $articles = $paginator->paginate(
            $articlesArray, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            6 // Nombre de résultats par page
        );

        return $this->render('article/index.html.twig', [
            'articles' => $articles,
        ]);
    }
}
