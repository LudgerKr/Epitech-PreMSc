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

class BrandController extends ApiAbstractController
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
     * @Route("/brand", name="brand_index")
     * @return Response
     * @throws TransportExceptionInterface
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function index(PaginatorInterface $paginator, Request $request)
    {
        $client = HttpClient::create();

        $response = $client->request("GET", "http://127.0.0.1:8000/api/brands", [
            'headers' => $this->_headers
        ]);
        $brandsArray = $response->toArray();

        $brands = $paginator->paginate(
            $brandsArray, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            12 // Nombre de résultats par page
        );

        return $this->render('brand/index.html.twig', [
            'brands' => $brands
        ]);
    }

    /**
     * @Route("/brand/show/{id}", name="brand_show")
     * @param $id
     * @return Response
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function show($id) {
        $client = HttpClient::create();

        $response = $client->request("GET", "http://127.0.0.1:8000/api/brand/" . $id, [
            'headers' => $this->_headers
        ]);
        $brand = $response->toArray();

        return $this->render("brand/show.html.twig", [
            'brand' => $brand,
        ]);


    }
}
