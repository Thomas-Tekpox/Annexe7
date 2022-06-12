<?php

namespace App\Repository;

use App\Entity\CodePromo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CodePromo|null find($id, $lockMode = null, $lockVersion = null)
 * @method CodePromo|null findOneBy(array $criteria, array $orderBy = null)
 * @method CodePromo[]    findAll()
 * @method CodePromo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CodePromoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CodePromo::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(CodePromo $entity, bool $flush = true): void
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
    public function remove(CodePromo $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return CodePromo[] Returns an array of CodePromo objects
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

    public function update($id, $DLC, $montant, $typePromo, $montantMin, $FP)
    {
        return $this->createQueryBuilder('codePromo')
            ->update('codePromo')
            ->andWhere('codePromo.id = :id')
            ->setParameter('id', $id)
            ->set('codePromo.DLC', $DLC)
            ->set('codePromo.montant', $montant)
            ->set('codePromo.typePromo', $typePromo)
            ->set('codePromo.montantMinimum', $montantMin)
            ->set('codePromo.fraisDePortOfferts', $FP)
            ->getQuery();
    }
}
