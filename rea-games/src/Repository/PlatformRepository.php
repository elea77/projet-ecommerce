<?php

namespace App\Repository;

use App\Entity\Platform;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Platform|null find($id, $lockMode = null, $lockVersion = null)
 * @method Platform|null findOneBy(array $criteria, array $orderBy = null)
 * @method Platform[]    findAll()
 * @method Platform[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlatformRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Platform::class);
    }
    
    public function platformGame($game)
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.games', 'g')
            ->where('g.id = :game')
            ->setParameter('game', $game)
            ->getQuery()
            ->getResult()
        ;
    }

    public function platformName($name)
    {
        $builder = $this -> createQueryBuilder('r');
        return $builder
            ->where('r.name LIKE :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Platform[] Returns an array of Platform objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Platform
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
