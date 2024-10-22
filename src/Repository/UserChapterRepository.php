<?php

namespace App\Repository;

use App\Entity\UserChapter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserChapter>
 * @method UserChapter|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserChapter|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserChapter[]    findAll()
 * @method UserChapter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserChapterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserChapter::class);
    }

    //    /**
    //     * @return UserChapter[] Returns an array of UserChapter objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('u.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?UserChapter
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
