<?php

namespace App\Repository;

use App\Entity\LotUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LotUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method LotUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method LotUser[]    findAll()
 * @method LotUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LotUserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LotUser::class);
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
            ->getOneOrNullResult()
            ;
    }
}
