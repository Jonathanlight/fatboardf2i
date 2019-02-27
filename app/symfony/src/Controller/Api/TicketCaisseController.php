<?php

namespace App\Controller\Api;

use App\Manager\GainsManager;
use App\Manager\LotsManager;
use App\Repository\LotsRepository;
use App\Services\RandomService;
use App\Services\SerializerService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TicketCaisseController extends AbstractController
{
    /**
     * @Route("/api/gains", name="api_gains", methods={"GET", "POST"})
     * @param Request $request
     * @param GainsManager $gainsManager
     * @param LotsManager $lotsManager
     * @param LotsRepository $lotsRepository
     * @param RandomService $randomService
     * @return JsonResponse
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function loadTicket(
        Request $request,
        GainsManager $gainsManager,
        LotsManager $lotsManager,
        LotsRepository $lotsRepository,
        RandomService $randomService
    ): JsonResponse
    {
        $data = $request->request->all();
        $response = $lotsManager->checkTicket($data['reference'], $data['code']);

        $ticketUser = $lotsManager->checkLotUser($data['reference'], $data['code']);

        if(empty($response)) {
            return new JsonResponse("Error de réference ou code", JsonResponse::HTTP_OK);
        }

        if(!empty($ticketUser)) {
            return new JsonResponse("Réference ou code déjà utilisé", JsonResponse::HTTP_OK);
        }

        $gainsManager->create($data, $lotsRepository->find($randomService->pourcentage()));

        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }
}