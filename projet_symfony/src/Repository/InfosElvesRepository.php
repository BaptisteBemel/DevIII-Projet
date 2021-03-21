<?php

namespace App\Repository;

use App\Entity\InfosElves;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InfosElves|null find($id, $lockMode = null, $lockVersion = null)
 * @method InfosElves|null findOneBy(array $criteria, array $orderBy = null)
 * @method InfosElves[]    findAll()
 * @method InfosElves[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfosElvesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InfosElves::class);
    }

    // /**
    //  * @return InfosElves[] Returns an array of InfosElves objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InfosElves
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
