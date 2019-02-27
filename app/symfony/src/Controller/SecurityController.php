<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Security\LoginType;
use App\Form\Security\RegisterType;
use App\Form\Security\RequestType;
use App\Manager\UserManager;
use App\Services\MessageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/admin/login", name="admin_login", methods={"GET","POST"})
     * @param AuthenticationUtils $authUtils
     * @return Response
     */
    public function admin(AuthenticationUtils $authUtils): Response
    {
        $form = $this->createForm(LoginType::class, [
            '_username' => $authUtils->getLastUsername(),
        ]);

        return $this->render('middle/admin/security/login.html.twig', [
            'error' => $authUtils->getLastAuthenticationError(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user/login", name="user_login", methods={"GET","POST"})
     * @param AuthenticationUtils $authUtils
     * @return Response
     */
    public function user(AuthenticationUtils $authUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('dashboard');
        }

        $form = $this->createForm(LoginType::class, [
            '_username' => $authUtils->getLastUsername(),
        ]);

        return $this->render('public/user/security/login.html.twig', [
            'error' => $authUtils->getLastAuthenticationError(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user/password/request", name="user_request", methods={"GET","POST"})
     * @param AuthenticationUtils $authUtils
     * @param Request $request
     * @param MessageService $messageService
     * @param UserManager $userManager
     * @return Response
     * @throws \Exception
     */
    public function request(
        AuthenticationUtils $authUtils,
        Request $request,
        MessageService $messageService,
        UserManager $userManager
    ): Response {
        $form = $this->createForm(RequestType::class, [
            '_username' => $authUtils->getLastUsername(),
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $userManager->loadByUsername($form->getData()['_username']);

            if ($user instanceof User) {
                $messageService->addSuccess('message.flash.resetpasswordsave');
            } else {
                $messageService->addError('message.flash.resetpasswordnosave');
            }
        }

        return $this->render('public/user/security/request.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/inscription/register", name="register")
     * @param Request $request
     * @param UserManager $userManager
     * @return Response
     */
    public function register_user(
        Request $request,
        UserManager $userManager
    ) {

        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $userManager->create($user);

            return $this->redirectToRoute('register');
        }

        return $this->render('public/user/security/register.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/logout", name="admin_logout", methods={"GET"})
     * @Route("/user/logout", name="user_logout", methods={"GET"})
     */
    public function logout()
    {
    }
}
