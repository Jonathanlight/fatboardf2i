<?php

namespace App\Manager;

use App\Services\TokenService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class TokenManager
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
     * @param EntityManagerInterface $entityManager
     * @param TokenService $tokenService
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        TokenService $tokenService,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->em = $entityManager;
        $this->tokenService = $tokenService;
        $this->eventDispatcher = $eventDispatcher;
    }
}
