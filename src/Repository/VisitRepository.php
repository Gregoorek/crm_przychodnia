<?php


namespace App\Repository;


use App\Entity\Patient;
use App\Entity\User;
use App\Entity\Visit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

class VisitRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Visit::class);
    }

    public function findByPacient(Patient $patient)
    {
        return $this->findBy([
            'patient'=> $patient
        ]);
    }
//zapytanie do wysylania powiadomienia

    /**
     * @param \DateTime $dateTimeNow
     * @return Visit[]
     * @throws \Exception
     */
    public function findNextVisit(\DateTime $dateTimeNow): array
    {
        $startDate = clone $dateTimeNow;
        $startDate->add(new \DateInterval('P1D'));

        $endDate = clone $startDate;
        $endDate->add(new \DateInterval('P20D'));   //zmienic na PT8H zeby tylko z jednego dnia powiadomienia

       /* $qb = $this->createQueryBuilder('visit');
        $qb->where('visit.startDate > :startDate')
            ->andWhere('visit.startDate <= :endDate')
            ->setParameter('startDate', $startDate)
            ->setParameter('endDate', $endDate);

        //przetestowanie zapytnia
        //SELECT visit FROM App\Entity\Visit visit WHERE visits.startDate > :startDate AND visit.startDate <= :endDate
        //var_dump($qb->getQuery()->getDQL());

        $query = $qb->getQuery();

        return $query->getResult(); */

      return $this->createQueryBuilder('visit')
            ->andWhere('visit.startDate > :startDate')
            ->andWhere('visit.startDate <= :endDate')
            ->setParameter('startDate', $startDate)
            ->setParameter('endDate', $endDate)
            ->getQuery()
            ->getResult();

    }
}