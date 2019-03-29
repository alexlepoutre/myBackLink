<?php

namespace App\Repository;

use App\Entity\BackLink;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BackLink|null find($id, $lockMode = null, $lockVersion = null)
 * @method BackLink|null findOneBy(array $criteria, array $orderBy = null)
 * @method BackLink[]    findAll()
 * @method BackLink[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BackLinkRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BackLink::class);
    }

    // /**
    //  * @return BackLink[] Returns an array of BackLink objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BackLink
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
