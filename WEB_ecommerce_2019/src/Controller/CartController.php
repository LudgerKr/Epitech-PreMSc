<?php

namespace App\Controller;

use App\Controller\Api\ApiAbstractController;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Stripe\Charge;
use Stripe\Checkout\Session;
use Stripe\Customer;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
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

/**
 * Class CartController
 * @package App\Controller
 * @IsGranted("ROLE_USER")
 */
class CartController extends ApiAbstractController
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
     * @Route("/cart", name="cart_index")
     */
    public function index()
    {
        $user = $this->getUser();

        $client = HttpClient::create();
        $currentCartResponse = $client->request("GET", "http://127.0.0.1:8000/api/user/" . $user->getId() . "/cart/current", [
            'headers' => $this->_headers
        ]);
        $currentCart = $currentCartResponse->toArray();

        return $this->render('cart/index.html.twig', [
            'cart' => $currentCart,
        ]);
    }

    /**
     * @Route("/cart/cartArticle/{id}/quantity/change", name="cart_cartArticle_quantity_change")
     * @param int $id
     * @param Request $request
     * @return RedirectResponse
     * @throws TransportExceptionInterface
     */
    public function cartArticleQuantityChange($id, Request $request) {
        $client = HttpClient::create();
        $quantity = $request->get("quantity");

        if ($quantity <= 0 or $quantity >= 100) {
            return $this->redirectToRoute("cart_index");
        }

        $response = $client->request("PUT", "http://127.0.0.1:8000/api/cartArticle/" . $id, [
            'body' => ['quantity' => $quantity],
            'headers' => $this->_headers
        ]);

        return $this->redirectToRoute("cart_index");
    }

    /**
     * @Route("/cart/order/done", name="cart_order_done")
     * @throws TransportExceptionInterface
     */
    public function orderDone() {
        $user = $this->getUser();
        $client = HttpClient::create();

        $client->request("PUT", "http://127.0.0.1:8000/api/user/" . $user->getId() ."/cart/current", [
            'body' => [
                'state' => 'complete'
            ],
            'headers' => $this->_headers
        ]);

        return $this->redirectToRoute("cart_index");
    }

    /**
     *@Route("/cart/orders", name="cart_orders")
     */
    public function orders() {
        $client = HttpClient::create();
        $user = $this->getUser();

        $response  = $client->request("GET", "http://127.0.0.1:8000/api/user/" . $user->getId() . "/carts/complete", [
            'headers' => $this->_headers
        ]);

        $carts = $response->toArray();

        return $this->render("cart/orders.html.twig", [
            'carts' => $carts,
        ]);
    }

    /**
     * @Route("/cart/add/{id}", name="cart_add_article")
     * @param int $id
     * @param Request $request
     * @return RedirectResponse
     * @throws TransportExceptionInterface
     */
    public function addArticle($id, Request $request) {
        $lastUrl = $request->headers->get('referer');
        $user = $this->getUser();
        $client = HttpClient::create();

        $cartResponse = $client->request("POST", "http://127.0.0.1:8000/api/user/" . $user->getId() . "/cart/current/article/" . $id, [
            'headers' => $this->_headers
        ]);

        $articleResponse = $client->request("GET", "http://127.0.0.1:8000/api/article/" . $id, [
            'headers' => $this->_headers
        ]);

        $article = $articleResponse->toArray();

        if ($cartResponse->getStatusCode() === 201) {
            $this->addFlash(
                'success',
                "L'article " . $article['title'] . " à été ajouter au panier !"
            );
        } else {
            $this->addFlash(
                'danger',
                "Une érreur est survenue !"
            );
        }

        return $this->redirect($lastUrl);
    }

    /**
     * @Route("/cart/remove/{id}", name="cart_remove_article")
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function removeArticle($id, Request $request) {
        $client = HttpClient::create();

        $response = $client->request("DELETE", "http://127.0.0.1:8000/api/cartArticle/" . $id, [
            'headers' => $this->_headers
        ]);

        $articleResponse = $client->request("GET", "http://127.0.0.1:8000/api/article/" . $request->get('articleId'), [
            'headers' => $this->_headers
        ]);

        $article = $articleResponse->toArray();

        if ($response->getStatusCode() === 202) {
            $this->addFlash(
                'success',
                "l'article " . $article['title'] . " a bien été supprimé !"
            );
        } else {
            $this->addFlash(
                'danger',
                "Une érreur est survenue !"
            );
        }

        return $this->redirectToRoute("cart_index");

    }

    /**
     * @Route("/cart/payment", name="cart_payment")
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     * @throws ApiErrorException
     * @throws TransportExceptionInterface
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function payment(Request $request, EntityManagerInterface $manager) {
        /** @var User $user */
        $user = $this->getUser();

        Stripe::setApiKey($this->getParameter("stripe_secret_key"));

        if (is_null($user->getCustomerId())) {
            $customer = Customer::create(array(
                "email" => $user->getEmail(),
                "name" => $user->getUsername(),
            ));

            $user->setCustomerId($customer->id);
            $manager->flush();
        }

        $client = HttpClient::create();
        $cartResponse = $client->request("GET", "http://127.0.0.1:8000/api/user/" . $user->getId() . "/cart/current", [
            'headers' => $this->_headers
        ]);

        $currentCart = $cartResponse->toArray();

        $customLine = [];
        foreach ($currentCart['cartArticle'] as $cartItem) {
            $customLine[] = [
                'name' => $cartItem['article']['title'],
                'description' => $cartItem['article']['content'],
                'images' => [$cartItem['article']['imageMain']],
                'amount' => $cartItem['article']['price'] * 100,
                'currency' => "eur",
                'quantity' => $cartItem['quantity'],
            ];
        }

        $session = Session::create([
            'customer' => $user->getCustomerId(),
            'payment_method_types' => ['card'],
            'line_items' => $customLine,
            'success_url' => $request->getUriForPath($this->generateUrl('cart_order_done')),
            'cancel_url' => $request->getUriForPath($this->generateUrl('cart_index')),
        ]);

        return $this->render("cart/checkout.html.twig", [
            'sessionId' => $session->id,
            'stripe_public_key' => $this->getParameter("stripe_public_key"),
        ]);
    }


}
