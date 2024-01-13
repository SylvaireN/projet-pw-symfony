<?php

namespace App\Repository;

use App\Entity\MailEdus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MailEdus>
 *
 * @method MailEdus|null find($id, $lockMode = null, $lockVersion = null)
 * @method MailEdus|null findOneBy(array $criteria, array $orderBy = null)
 * @method MailEdus[]    findAll()
 * @method MailEdus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MailEdusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MailEdus::class);
    }

//    /**
//     * @return MailEdus[] Returns an array of MailEdus objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MailEdus
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
