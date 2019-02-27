<?php

namespace App\Controller\Middle;

use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatistiqueController extends AbstractController
{
    /**
     * @Route("/user/statistic", name="middle_statistic", methods={"GET", "POST"})
     * @Security("is_granted(constant('\\App\\Security\\Voter\\StatistiqueVoter::STATISTIQUE_VIEW'))")
     * @return Response
     */
    public function view(): Response
    {
        $user = $this->getUser();

        return $this->render('middle/user/statistic.html.twig', ['users' => $user]);
    }
}