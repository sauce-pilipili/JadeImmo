<?php

namespace App\Repository;

use App\Entity\Annonces;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Annonces|null find($id, $lockMode = null, $lockVersion = null)
 * @method Annonces|null findOneBy(array $criteria, array $orderBy = null)
 * @method Annonces[]    findAll()
 * @method Annonces[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnoncesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Annonces::class);
    }

    public function findCoupDeCoeur()
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.coupDeCoeur = :val')
            ->setParameter('val', true)
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findLocalisation(){
        return $this->createQueryBuilder('a')
            ->select('a.localisation')
            ->distinct(true)
            ->getQuery()
            ->getResult();

    }


    public function findAllAnonces()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.id', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findajaxAnnonces($value= null)
    {
        return $this->createQueryBuilder('a')
            ->select('a')
            ->andWhere('a.title LIKE :val')
            ->setParameter('val', '%'.$value.'%')
            ->getQuery()
            ->getResult()
            ;
    }


    public function findAnnoncesByFormulaire($localisation ,$typeDeBien,$surfaceMin,
                                             $prixMax, $chambre, $piece, $surfaceBienMax, $surfaceBienMin, $surfaceTerrainMin,
                                             $surfaceTerrainMax, $piscine, $terrasse, $balcon, $jardin, $cave, $parking)
    {
        $qb = $this->createQueryBuilder('a');
        if($localisation!=null && $localisation!='' &&$localisation!='Localisation'){
                $qb->andWhere('a.localisation  =:val')
                    ->setParameter('val', $localisation);
            }
        if($typeDeBien!=null && $typeDeBien!=''){
            $qb->andWhere('a.typeDeBien = :val')
                ->setParameter('val', $typeDeBien);
        }
        if($surfaceMin!=null && $surfaceMin!=''){
            $qb->andWhere('a.surfaceHabitable <= :val')
                ->setParameter('val', $surfaceMin);
        }
        if($prixMax!=null && $prixMax!=''){
            $qb->andWhere('a.prixAvecHonoraires <= :val')
                ->setParameter('val', $prixMax);
        }
        if($chambre!=null && $chambre!=''){
            $qb->andWhere('a.nombreDeChambre = :val')
                ->setParameter('val', $chambre);
        }
        if($piece!=null && $piece!=''){
            $qb->andWhere('a.nombreDeSalleDeBain = :val')
                ->setParameter('val', $piece);
        }
        if($surfaceBienMax!=null && $surfaceBienMax!=''){
            $qb->andWhere('a.surfaceHabitable <= :val')
                ->setParameter('val', $surfaceBienMax);
        }
        if($surfaceBienMin!=null && $surfaceBienMin!=''){
            $qb->andWhere('a.surfaceHabitable > :val')
                ->setParameter('val', $surfaceBienMin);
        }
        if($surfaceTerrainMin!=null && $surfaceTerrainMin!=''){
            $qb->andWhere('a.surfaceDuTerrain > :val')
                ->setParameter('val', $surfaceTerrainMin);
        }
        if($surfaceTerrainMax!=null && $surfaceTerrainMax!=''){
            $qb->andWhere('a.surfaceDuTerrain <= :val')
                ->setParameter('val', $surfaceTerrainMax);
        }
        if($piscine!=null && $piscine!=''){
            $qb->andWhere('a.piscine = :val')
                ->setParameter('val', 1);
        }
        if($terrasse!=null && $terrasse!=''){
            $qb->andWhere('a.terrasse = :val')
                ->setParameter('val', 1);
        }
        if($balcon!=null && $balcon!=''){
            $qb->andWhere('a.balcon = :val')
                ->setParameter('val', 1);
        }
        if($jardin!=null && $jardin!=''){
            $qb->andWhere('a.jardin = :val')
                ->setParameter('val', 1);
        }
        if($cave!=null && $cave!=''){
            $qb->andWhere('a.cave = :val')
                ->setParameter('val', 1);
        }
        if($parking!=null && $parking!=''){
            $qb->andWhere('a.parking = :val')
                ->setParameter('val', 1);
        }
            $qb->orderBy('a.id', 'ASC')
            ->setMaxResults(10);

        return $qb->getQuery()
            ->getResult()
            ;
    }




    // /**
    //  * @return Annonces[] Returns an array of Annonces objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Annonces
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
