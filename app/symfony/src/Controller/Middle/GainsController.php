<?php

namespace App\Controller\Middle;

use App\Entity\LotUser;
use App\Form\Middle\LotUserType;
use App\Manager\GainsManager;
use App\Manager\LotUserManager;
use App\Repository\LotsRepository;
use App\Services\RandomService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GainsController extends AbstractController
{
    /**
     * @Route("/user/gains", name="middle_gains", methods={"GET", "POST"})
     * @Security("is_granted(constant('\\App\\Security\\Voter\\GainsVoter::GAINS_VIEW'))")
     * @param Request $request
     * @param GainsManager $gainsManager
     * @param RandomService $randomService
     * @param LotsRepository $lotsRepository
     * @return Response
     */
    public function gains(
        Request $request,
        GainsManager $gainsManager,
        RandomService $randomService,
        LotsRepository $lotsRepository,
        LotUserManager $lotUserManager
    ): Response
    {
        $user = $this->getUser();
        $lotUser = new LotUser();
        $form = $this->createForm(LotUserType::class, $lotUser);

        return $this->render('middle/user/gains.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
            'lotUsers' => $lotUserManager->collect($user)
        ]);
    }
}
