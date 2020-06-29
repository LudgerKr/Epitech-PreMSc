<?php

namespace App\Controller;

use App\Controller\Api\ApiAbstractController;
use App\Entity\Article;
use App\Entity\User;
use App\Form\RegistrationType;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Worksheet;
use Swift_Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class SecurityController extends ApiAbstractController
{

    private $mailer;
    private $_headers;

    public function __construct(ContainerInterface $container, Swift_Mailer $mailer)
    {
        parent::__construct($container);
        $this->_headers = [
            'Authorization' => 'Bearer ' . $this->getTokenAction()->getContent(),
            'Accept'        => 'application/json',
        ];
        $this->mailer = $mailer;
    }

    /**
     * @Route("/inscription", name="security_registration")
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param UserPasswordEncoderInterface $encoder
     * @return RedirectResponse|Response
     */
    public function registration(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $hash = $encoder->encodePassword($user, $user->getPassword());

            $user->setPassword($hash);

            $manager->persist($user);

            $manager->flush();

            return $this->redirectToRoute('security_login');
        }

        return $this->render('security/registration.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/profilEditWithPassword/{id}", name="profil_edit_with_password")
     * @param User $user
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param UserPasswordEncoderInterface $encoder
     * @return RedirectResponse|Response
     */
    public function editWithPassword(User $user, Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        $form = $this->createForm(RegistrationType::class, $user)->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);

            $manager->flush();
            $manager->refresh($user);

            return $this->redirectToRoute('profil');
        }

        return $this->render('user/edit_password.html.twig', [
            'form' => $form->createView(),
            'edit' => $user->getId()
        ]);
    }

    /**
     * @Route("/profilEditWithoutPassword/{id}", name="profil_edit_without_password")
     * @param User $user
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param UserPasswordEncoderInterface $encoder
     * @return RedirectResponse|Response
     */
    public function editWithoutPassword(User $user, Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        $form = $this->createForm(UserType::class, $user)->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $manager->flush();
            $manager->refresh($user);

            return $this->redirectToRoute('profil');
        }

        return $this->render('user/edit.html.twig', [
            'form' => $form->createView(),
            'edit' => $user->getId()
        ]);
    }

    /**
     * @Route("/delete/{id}", name="user_delete")
     * @param User $user
     * @param EntityManagerInterface $em
     * @return RedirectResponse
     * @throws \Exception
     */
    public function delete(User $user, EntityManagerInterface $em)
    {
        if(empty($user)) {
            throw new \Exception('Aucun utilisateur trouvé');
        }

        $em->remove($user);
        $em->flush();

        $session = new Session();
        $session->invalidate();

        $this->addFlash(
                'warning',
                "Votre compte a bien été supprimé !");

        return $this->redirectToRoute('article_index');
    }

    /**
     * @Route("/profil", name="profil")
     */
    public function profil()
    {
        return $this->render('user/profil.html.twig');
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        // only needed if we need to check a password - we'll do that later!
        return true;
    }

    public function getCredentials(Request $request)
    {
        $credentials = [
            'email' => $request->request->get('email'),
            'password' => $request->request->get('password'),
        ];

        $request->getSession()->set(
            Security::LAST_USERNAME,
            $credentials['email']
        );

        return $credentials;
    }

    /**
     * @Route("/checkConnexion", name="security_login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        return $this->render('security/login.html.twig', [
            'error'         => $error,
        ]);
    }

    /**
     * @Route("/deconnexion", name="security_logout")
     */
    public function logout() { }

    /**
     * @return mixed|string
     */
    private function newPassword()
    {
        $alphabet    = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $password    = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $password[] = $alphabet[$n];
        }
        return implode($password);
    }

    /**
     * @Route("/forgotten_password", name="app_forgotten_password")
     * @param Request $request
     * @return Response
     */
    public function forgottenPassword(Request $request)
    {
        if ($request->isMethod('POST')) {
            $email          = $request->request->get('email');
            $entityManager  = $this->getDoctrine()->getManager();
            $user           = $entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

            if ($user === null) {
                $this->addFlash('danger', 'Email Inconnu');

                return $this->redirectToRoute('security_registration');
            }

            $reset_password = $this->newPassword();

            try {
                $user->setResetPassword($reset_password);
                $entityManager->flush();
            } catch (\Exception $e) {
                $this->addFlash('warning', $e->getMessage());
            }

            $message = (new \Swift_Message('Forgotten Password'))
                ->setFrom('ecommerce@dev-web.com')
                ->setTo($user->getEmail())
                ->setBody(
                    "Here is your new temporary password, have a nice navigation! : " . $reset_password,
                    'text/html'
                );

            $this->mailer->send($message);
            $this->addFlash('success', 'Mail send');

            return $this->redirectToRoute('app_reset_password');
        }
        return $this->render('security/forgotten_password.html.twig');
    }

    /**
     * @Route("/reset_password", name="app_reset_password")
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    public function resetPassword(Request $request, UserPasswordEncoderInterface $encoder, EntityManagerInterface $em)
    {
        if ($request->isMethod('POST')) {

            $email             = $request->request->get('email');
            $reset_password    = $request->request->get('reset_password');
            $new_password      = $request->request->get('new_password');
            $confirm_password  = $request->request->get('confirm_password');

            $user = $em->getRepository(User::class)->findOneBy([
                'email'          => $email,
                'reset_password' => $reset_password,
            ]);

            if ($user === null) {
                $this->addFlash('danger', 'User Unknown');
                return $this->redirectToRoute('app_reset_password');
            }

            if($new_password === $confirm_password) {
                $user->setResetPassword(null);
                $user->setPassword($encoder->encodePassword($user, $new_password));

                $em->persist($user);
                $em->flush();

                $this->addFlash('success', 'Mot de passe mis à jour');

                return $this->redirectToRoute('security_login');
            }
        }
        return $this->render('security/reset_password.html.twig');
    }

    /**
     * @Route("/excel/article", name ="excel_article")
     * @return Response
     * @throws Exception
     * @throws TransportExceptionInterface
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @isGranted("ROLE_ADMIN")
     */
    public function createArticleExcel()
    {
        $client   = HttpClient::create();
        $response = $client->request("GET", "http://127.0.0.1:8000/api/articles",[
            'headers' => $this->_headers
        ]);

        $articles = $response->toArray();

        $spreadsheet = new Spreadsheet();

        /* @var $sheet Worksheet */
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'id');
        $sheet->setCellValue('B1', 'title');
        $sheet->setCellValue('C1', 'content');
        $sheet->setCellValue('D1', 'weight');
        $sheet->setCellValue('E1', 'height');
        $sheet->setCellValue('F1', 'width');
        $sheet->setCellValue('G1', 'length');
        $sheet->setCellValue('H1', 'stock');
        $sheet->setCellValue('I1', 'price');
        $sheet->setCellValue('J1', 'imageMain');
        $sheet->setCellValue('K1', 'image1');
        $sheet->setCellValue('L1', 'image2');
        $sheet->setCellValue('M1', 'image2');
        $sheet->setCellValue('N1', 'category');
        $sheet->setCellValue('O1', 'compatibility');
        $sheet->setCellValue('P1', 'type');
        $sheet->setCellValue('Q1', 'purpose');
        $sheet->setCellValue('R1', 'brand');
        $sheet->setCellValue('S1', 'created_at');
        $sheet->setCellValue('T1', 'updated_at');

        for($i = 0; $i < count($articles); $i++) {
            $sheet->setCellValue('A' . ($i+2), $articles[$i]['id']);
            $sheet->setCellValue('B' . ($i+2), $articles[$i]['title']);
            $sheet->setCellValue('C' . ($i+2), $articles[$i]['content']);
            $sheet->setCellValue('D' . ($i+2), $articles[$i]['weight']);
            $sheet->setCellValue('E' . ($i+2), $articles[$i]['height']);
            $sheet->setCellValue('F' . ($i+2), $articles[$i]['width']);
            $sheet->setCellValue('G' . ($i+2), $articles[$i]['length']);
            $sheet->setCellValue('H' . ($i+2), $articles[$i]['stock']);
            $sheet->setCellValue('I' . ($i+2), $articles[$i]['price']);
            $sheet->setCellValue('J' . ($i+2), $articles[$i]['imageMain']);
            $sheet->setCellValue('K' . ($i+2), $articles[$i]['image1']);
            $sheet->setCellValue('L' . ($i+2), $articles[$i]['image2']);
            $sheet->setCellValue('M' . ($i+2), $articles[$i]['image3']);
            $sheet->setCellValue('N' . ($i+2), $articles[$i]['category']['name']);
            $sheet->setCellValue('O' . ($i+2), $articles[$i]['compatibility']['id']);
            $sheet->setCellValue('P' . ($i+2), $articles[$i]['articleType']['name']);
            $sheet->setCellValue('Q' . ($i+2), $articles[$i]['articlePurpose']['name']);
            $sheet->setCellValue('R' . ($i+2), $articles[$i]['brand']['name']);
            $sheet->setCellValue('S' . ($i+2), $articles[$i]['createdAt']);
            $sheet->setCellValue('T' . ($i+2), $articles[$i]['updatedAt']);
        }

        $sheet->setTitle("Articles");

        $writer    = new Xlsx($spreadsheet);
        $fileName  = 'Articles.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($temp_file);

        return $this->file($temp_file, $fileName, ResponseHeaderBag::DISPOSITION_INLINE);
    }

    /**
     * @Route("/excel/user", name ="excel_user")
     * @return Response
     * @throws Exception
     * @throws TransportExceptionInterface
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @isGranted("ROLE_ADMIN")
     */
    public function createUserExcel()
    {
        $client   = HttpClient::create();
        $response = $client->request("GET", "http://127.0.0.1:8000/api/users",[
            'headers' => $this->_headers
        ]);

        $users       = $response->toArray();
        $spreadsheet = new Spreadsheet();

        /* @var $sheet Worksheet */
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'id');
        $sheet->setCellValue('B1', 'email');
        $sheet->setCellValue('C1', 'username');
        $sheet->setCellValue('D1', 'password');
        $sheet->setCellValue('E1', 'birhdate');
        $sheet->setCellValue('F1', 'createdAt');
        $sheet->setCellValue('G1', 'updatedAt');

        for($i = 0; $i < count($users); $i++) {
            $sheet->setCellValue('A' . ($i+2), $users[$i]['id']);
            $sheet->setCellValue('B' . ($i+2), $users[$i]['email']);
            $sheet->setCellValue('C' . ($i+2), $users[$i]['username']);
            $sheet->setCellValue('D' . ($i+2), $users[$i]['password']);
            $sheet->setCellValue('E' . ($i+2), $users[$i]['birthdate']);
            $sheet->setCellValue('F' . ($i+2), $users[$i]['createdAt']);
            $sheet->setCellValue('G' . ($i+2), $users[$i]['updatedAt']);
        }

        $sheet->setTitle("Users");

        $writer    = new Xlsx($spreadsheet);
        $fileName  = 'Users.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($temp_file);

        return $this->file($temp_file, $fileName, ResponseHeaderBag::DISPOSITION_INLINE);
    }

    /**
     * @Route("/excel/profile", name ="excel_profile")
     * @return Response
     * @throws Exception
     * @throws TransportExceptionInterface
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function createProfileExcel()
    {
        /** @var User $user */
        $user = $this->getUser();
        $client   = HttpClient::create();

        $spreadsheet = new Spreadsheet();

        /* @var $sheet Worksheet */
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'id');
        $sheet->setCellValue('B1', 'email');
        $sheet->setCellValue('C1', 'username');
        $sheet->setCellValue('D1', 'password');
        $sheet->setCellValue('E1', 'birhdate');
        $sheet->setCellValue('F1', 'createdAt');
        $sheet->setCellValue('G1', 'updatedAt');

        $sheet->setCellValue('A2', $user->getId());
        $sheet->setCellValue('B2', $user->getEmail());
        $sheet->setCellValue('C2', $user->getUsername());
        $sheet->setCellValue('D2', $user->getPassword());
        $sheet->setCellValue('E2', $user->getBirthdate());
        $sheet->setCellValue('F2', $user->getCreatedAt());
        $sheet->setCellValue('G2', $user->getUpdatedAt());

        $sheet->setTitle("Profile");

        $writer    = new Xlsx($spreadsheet);
        $fileName  = 'Profile.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($temp_file);

        return $this->file($temp_file, $fileName, ResponseHeaderBag::DISPOSITION_INLINE);
    }
}
