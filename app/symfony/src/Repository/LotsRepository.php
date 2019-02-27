<?php

namespace App\Repository;

use App\Entity\Lots;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Lots|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lots|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lots[]    findAll()
 * @method Lots[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LotsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Lots::class);
    }
}
