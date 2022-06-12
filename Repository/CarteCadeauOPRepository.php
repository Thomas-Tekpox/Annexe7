<?php

namespace App\Repository;

use App\Entity\CarteCadeauOP;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CarteCadeauOP|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarteCadeauOP|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarteCadeauOP[]    findAll()
 * @method CarteCadeauOP[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarteCadeauOPRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarteCadeauOP::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(CarteCadeauOP $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(CarteCadeauOP $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return CarteCadeauOP[] Returns an array of CarteCadeauOP objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CarteCadeauOP
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
