<?php

namespace App\Repository;

use App\Entity\Circuit;
use App\Entity\EtapeCr;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EtapeCr|null find($id, $lockMode = null, $lockVersion = null)
 * @method EtapeCr|null findOneBy(array $criteria, array $orderBy = null)
 * @method EtapeCr[]    findAll()
 * @method EtapeCr[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtapeCrRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EtapeCr::class);
    }

    // /**
    //  * @return EtapeCr[] Returns an array of EtapeCr objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
     /**
      * @return EtapeCr[]
    */
    public function findAllOrdered()
    {
      $dql = 'SELECT ville from AppBundle\Entity\EtapeCr ville';
      $query=$this->getEntityManager()->createQuery($dql);
        return $query->execute();
        // this will return an array of Ville object
    }



    /*
   public function findByExampleField($value)
   {
       return $this->createQueryBuilder('e')
           ->Where('e.ordre = :val')
           ->setParameter('val', $value)
           ->getQuery()
           ->getResult()
           ;
   }

   public function findOneBySomeField($value): ?EtapeCr
   {
       return $this->createQueryBuilder('e')
           ->andWhere('e.exampleField = :val')
           ->setParameter('val', $value)
           ->getQuery()
           ->getOneOrNullResult()
       ;
   }
   */


/*
    public function getMaxDureeVille($ville) {
        $query = $this->createQueryBuilder('v');
        $query
            ->where(
                $query->expr()->max('v.duree')
            )
            ->join('App\Entity\Circuit','c',EtapeCr::class,$this->find())
            //setParameter('ville',$ville);


        return $query->getQuery()->getResult();;
*/


    public function getDureeEtapeCircuitVille($ville){
        $query = $this->createQueryBuilder('v')
            ->where('v.ville = :ville')
            ->setParameter('ville', $ville)->getQuery();


        return $query->getResult();


    }

}

