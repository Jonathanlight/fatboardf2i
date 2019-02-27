<?php

namespace App\Manager;

use App\Entity\Lots;
use App\Entity\LotUser;
use App\Repository\UserRepository;
use App\Services\TokenService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class GainsManager
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var TokenService
     */
    protected $tokenService;

    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * GainsManager constructor.
     * @param EntityManagerInterface $entityManager
     * @param TokenService $tokenService
     * @param UserRepository $userRepository
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        TokenService $tokenService,
        UserRepository $userRepository,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->em = $entityManager;
        $this->tokenService = $tokenService;
        $this->eventDispatcher = $eventDispatcher;
        $this->userRepository = $userRepository;
    }

    /**
     * @param array $data
     * @param Lots $lots
     */
    public function create(array $data, Lots $lots): void
    {
        $lotUser = new LotUser();
        $lotUser->setReference($data['reference']);
        $lotUser->setCode($data['code']);
        $lotUser->setLots($lots);
        $lotUser->setUser($this->userRepository->find($data['user']));
        $lotUser->setStatus(LotUser::STATE_LOT_REGISTER);
        $lotUser->setCreated(new \DateTime());
        $lotUser->setUpdated(new \DateTime());
        $this->em->persist($lotUser);
        $this->em->flush();
    }
}
