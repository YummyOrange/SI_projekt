<?php

/**Anon User Repository*/

namespace App\Repository;

use App\Entity\AnonUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AnonUser>
 *
 * @method AnonUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method AnonUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method AnonUser[]    findAll()
 * @method AnonUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnonUserRepository extends ServiceEntityRepository
{
    /**
     * Constructor.
     *
     * @param ManagerRegistry $registry Registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AnonUser::class);
    }

    /**
     * Function Save.
     *
     * @param AnonUser $entity Entity
     * @param bool     $flush  Flush - false
     */
    public function save(AnonUser $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Function Remoove.
     *
     * @param AnonUser $entity Entity to remove
     * @param bool     $flush  Flush
     */
    public function remove(AnonUser $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
