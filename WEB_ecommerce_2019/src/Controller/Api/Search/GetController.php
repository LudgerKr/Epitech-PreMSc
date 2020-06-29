<?php


namespace App\Controller\Api\Search;


use Algolia\AlgoliaSearch\Exceptions\AlgoliaException;
use Algolia\SearchBundle\SearchService;
use App\Entity\Article;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class GetController
 * @package App\Controller\Api\Search
 * @Rest\Route("/api", name="_api")
 */
class GetController extends AbstractFOSRestController
{
    protected $searchService;

    public function __construct(SearchService  $searchService)
    {
        $this->searchService = $searchService;
    }

    /**
     * @Rest\Get("/search/{query}", requirements={"query"})
     * @Groups("Searchable")
     * @param $query
     * @return JsonResponse
     * @throws AlgoliaException
     */
    public function getSearch($query) {
        $em = $this->getDoctrine()->getManagerForClass(Article::class);

        $articles = $this->searchService->search($em, Article::class, $query);

        return $this->json($articles, 200, [], ['groups' => ['article']]);

    }
}