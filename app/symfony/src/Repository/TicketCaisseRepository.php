<?php

namespace App\Repository;

use App\Entity\TicketCaisse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TicketCaisse|null find($id, $lockMode = null, $lockVersion = null)
 * @method TicketCaisse|null findOneBy(array $criteria, array $orderBy = null)
 * @method TicketCaisse[]    findAll()
 * @method TicketCaisse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TicketCaisseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TicketCaisse::class);
    }

    /**
     * @param string $reference
     * @param string $code
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function ticket(string $reference, string $code)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.reference = :reference')
            ->andWhere('t.code = :code')
            ->setParameter('reference', $reference)
            ->setParameter('code', $code)
            ->getQuery()
            ->getResult()
        ;
    }
}
