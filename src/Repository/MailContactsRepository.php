<?php

namespace App\Repository;

use App\Entity\MailContacts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MailContacts>
 *
 * @method MailContacts|null find($id, $lockMode = null, $lockVersion = null)
 * @method MailContacts|null findOneBy(array $criteria, array $orderBy = null)
 * @method MailContacts[]    findAll()
 * @method MailContacts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MailContactsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MailContacts::class);
    }

//    /**
//     * @return MailContacts[] Returns an array of MailContacts objects
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

//    public function findOneBySomeField($value): ?MailContacts
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
