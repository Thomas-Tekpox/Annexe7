<?php

namespace App\Repository;

use App\Entity\ProduitCodePromo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProduitCodePromo|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProduitCodePromo|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProduitCodePromo[]    findAll()
 * @method ProduitCodePromo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitCodePromoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProduitCodePromo::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(ProduitCodePromo $entity, bool $flush = true): void
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
    public function remove(ProduitCodePromo $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return ProduitCodePromo[] Returns an array of ProduitCodePromo objects
    //  */
    // public function findByCodePromoID($codePromoID)
    // {
    //     return $this->createQueryBuilder('pCodePromo')
    //         ->andWhere('pCodePromo. = :val')
    //         ->setParameter('val', $codePromoID)
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }

    /*
    public function findOneBySomeField($value): ?ProduitCodePromo
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
