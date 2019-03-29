<?php

namespace App\Repository;

use App\Entity\BackLinkLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BackLinkLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method BackLinkLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method BackLinkLog[]    findAll()
 * @method BackLinkLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BackLinkLogRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BackLinkLog::class);
    }

    // /**
    //  * @return BackLinkLog[] Returns an array of BackLinkLog objects
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
    public function findOneBySomeField($value): ?BackLinkLog
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
