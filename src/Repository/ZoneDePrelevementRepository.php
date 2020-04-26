<?php

namespace App\Repository;

use App\Entity\ZoneDePrelevement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ZoneDePrelevement|null find($id, $lockMode = null, $lockVersion = null)
 * @method ZoneDePrelevement|null findOneBy(array $criteria, array $orderBy = null)
 * @method ZoneDePrelevement[]    findAll()
 * @method ZoneDePrelevement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZoneDePrelevementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ZoneDePrelevement::class);
    }

    // /**
    //  * @return ZoneDePrelevement[] Returns an array of ZoneDePrelevement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('z.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ZoneDePrelevement
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
