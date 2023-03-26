<?php

namespace App\Repository;

use App\Entity\Favorite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Favorite>
 *
 * @method Favorite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Favorite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Favorite[]    findAll()
 * @method Favorite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FavoriteRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Favorite::class);
    }

    public function addFavorite(string $fruitId): ?Favorite
    {
        $count = sizeof($this->findAll());

        if ($count < 10) {
            $fav = new Favorite();
            $fav->setFruitId((int) $fruitId);

            $this->getEntityManager()->persist($fav);
            $this->getEntityManager()->flush();

            return $fav;
        }

        return null;
    }

    public function remove(string $fruitId): bool
    {
        $favorite = $this->findOneByFruitId($fruitId);

        if ($favorite) {
            $this->getEntityManager()->remove($favorite);
            $this->getEntityManager()->flush();

            return true;
        }

        return false;
    }

    public function findOneByFruitId(int $fruitId): ?Favorite
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.fruit_id = :val')
            ->setParameter('val', $fruitId)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @return string[]
     */
    public function findAllIds(): array
    {
        return $this->createQueryBuilder('f')
            ->select('f.fruit_id')
            ->getQuery()
            ->getResult();
    }
}
