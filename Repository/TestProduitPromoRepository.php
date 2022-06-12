<?php

namespace App\Repository;

use App\Entity\TestProduitPromo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TestProduitPromo>
 *
 * @method TestProduitPromo|null find($id, $lockMode = null, $lockVersion = null)
 * @method TestProduitPromo|null findOneBy(array $criteria, array $orderBy = null)
 * @method TestProduitPromo[]    findAll()
 * @method TestProduitPromo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestProduitPromoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TestProduitPromo::class);
    }

    public function add(TestProduitPromo $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TestProduitPromo $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return TestProduitPromo[] Returns an array of TestProduitPromo objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TestProduitPromo
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
