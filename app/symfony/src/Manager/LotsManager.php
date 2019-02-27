<?php

namespace App\Manager;

use App\Repository\LotsRepository;
use App\Repository\LotUserRepository;
use App\Repository\TicketCaisseRepository;
use Doctrine\ORM\EntityManagerInterface;

class LotsManager
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var LotsRepository
     */
    protected $lotsRepository;

    /**
     * @var LotUserRepository
     */
    protected $lotUserRepository;

    /**
     * LotsManager constructor.
     * @param EntityManagerInterface $entityManager
     * @param LotsRepository $lotsRepository
     * @param LotUserRepository $lotUserRepository
     * @param TicketCaisseRepository $ticketCaisseRepository
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        LotsRepository $lotsRepository,
        LotUserRepository $lotUserRepository,
        TicketCaisseRepository $ticketCaisseRepository
    ) {
        $this->em = $entityManager;
        $this->lotsRepository = $lotsRepository;
        $this->lotUserRepository = $lotUserRepository;
        $this->ticketCaisseRepository = $ticketCaisseRepository;
    }

    /**
     * @return \App\Entity\Lots[]
     */
    public function collect()
    {
        return $this->lotsRepository->findAll();
    }

    /**
     * @param string $reference
     * @param string $code
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function checkTicket(string $reference, string $code)
    {
        return $this->ticketCaisseRepository->ticket($reference, $code);
    }

    /**
     * @param string $reference
     * @param string $code
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function checkLotUser(string $reference, string $code)
    {
        return $this->lotUserRepository->ticket($reference, $code);
    }
}
