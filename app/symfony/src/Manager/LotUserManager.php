<?php

namespace App\Manager;

use App\Entity\User;
use App\Repository\LotsRepository;
use App\Repository\LotUserRepository;
use App\Repository\TicketCaisseRepository;
use Doctrine\ORM\EntityManagerInterface;

class LotUserManager
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var LotUserRepository
     */
    protected $lotUserRepository;

    /**
     * LotsManager constructor.
     * @param EntityManagerInterface $entityManager
     * @param LotUserRepository $lotUserRepository
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        LotUserRepository $lotUserRepository
    ) {
        $this->em = $entityManager;
        $this->lotUserRepository = $lotUserRepository;
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function collect(User $user)
    {
        return $this->lotUserRepository->findByUser($user);
    }
}
