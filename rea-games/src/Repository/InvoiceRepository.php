<?php

namespace App\Repository;

use App\Entity\Invoice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Invoice|null find($id, $lockMode = null, $lockVersion = null)
 * @method Invoice|null findOneBy(array $criteria, array $orderBy = null)
 * @method Invoice[]    findAll()
 * @method Invoice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InvoiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Invoice::class);
    }   

    public function nbRevenus7days()
    {
        $date = new \DateTime();
        $date->modify('-7 day');

        $builder = $this -> createQueryBuilder('p');
        return $builder
            ->select('SUM(p.cost) as revenu7')
            ->where('p.date > :date')
            ->setParameter('date', $date)
            ->getQuery()
            ->getResult()
        ;
    }

    public function nbVentes7days()
    {
        $date = new \DateTime();
        $date->modify('-7 day');

        $builder = $this -> createQueryBuilder('v');
        return $builder
            ->select('COUNT(v.id) as vente7')
            ->where('v.date > :date')
            ->setParameter('date', $date)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Invoice[] Returns an array of Invoice objects
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
    public function findOneBySomeField($value): ?Invoice
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
