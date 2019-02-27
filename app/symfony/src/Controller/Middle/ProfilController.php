<?php

namespace App\Controller\Middle;

use App\Entity\User;
use App\Form\Middle\UserType;
use App\Manager\UserManager;
use App\Repository\UserRepository;
use App\Services\RandomService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    /**
     * @Route("/user", name="dashboard", methods={"GET", "POST"})
     * @Security("is_granted(constant('\\App\\Security\\Voter\\UserVoter::USER_VIEW'))")
     * @param RandomService $randomService
     * @return Response
     */
    public function view(RandomService $randomService): Response
    {
        $user = $this->getUser();

        return $this->render('middle/user/index.html.twig', ['users' => $user]);
    }

    /**
     * @Route("/user/edit", name="middle_profil_edit", methods={"GET", "POST"})
     * @Security("is_granted(constant('\\App\\Security\\Voter\\UserVoter::USER_EDIT'))")
     * @param Request $request
     * @param UserManager $userManager
     * @return Response
     */
    public function edit(Request $request, UserManager $userManager): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userManager->update($user);

            return $this->redirectToRoute('middle_profil_edit');
        }

        return $this->render('middle/user/profil.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
