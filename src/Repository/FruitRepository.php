<?php

namespace App\Repository;

use App\Entity\Fruit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Fruit>
 *
 * @method Fruit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fruit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fruit[]    findAll()
 * @method Fruit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FruitRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fruit::class);
    }

    public function findOneByFruitId(int $fruitId): ?Fruit
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.fruit_id = :val')
            ->setParameter('val', $fruitId)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @return Fruit[] Returns an array of Favorite objects
     */
    private function findAllAndFilter(string $value = ''): array
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.name like :val')
            ->orWhere('f.family like :val')
            ->setParameter('val', "%$value%")
            ->orderBy('f.id', 'ASC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Fruit[] Returns an array of Favorite objects
     */
    private function findFavorites(FavoriteRepository $favoriteRepository): array
    {
        $favIds = $favoriteRepository->findAllIds();

        return $this->createQueryBuilder('f')
            ->andWhere('f.id in (:vals)')
            ->setParameter('vals', $favIds)
            ->orderBy('f.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function transformAll(FavoriteRepository $favoriteRepository, string $keyword): array
    {
        $fruits = $this->findAllAndFilter($keyword);

        return $this->transformProcess($favoriteRepository, $fruits);
    }

    public function transformFavorites(FavoriteRepository $favoriteRepository): array
    {
        $fruits = $this->findFavorites($favoriteRepository);

        return $this->transformProcess($favoriteRepository, $fruits);
    }

    private function transform(Fruit $fruit, FavoriteRepository $favoriteRepository): array
    {
        $isFavorite = (bool) $favoriteRepository->findOneByFruitId((int) $fruit->getId());
        $totalNutrition = 0;
        foreach ($fruit->getNutritions() as $nutritionValue) {
            $totalNutrition += $nutritionValue;
        }

        return [
            'id'              => (int) $fruit->getId(),
            'name'            => $fruit->getName(),
            'genus'           => $fruit->getGenus(),
            'family'          => $fruit->getFamily(),
            'fruit_id'        => $fruit->getFruitId(),
            'fruit_order'     => $fruit->getFruitOrder(),
            'nutrition_total' => round($totalNutrition, 2),
            'is_favorite'     => $isFavorite,
        ];
    }

    public function transformProcess(FavoriteRepository $favoriteRepository, $fruits): array
    {
        $fruitsArray = [];

        foreach ($fruits as $fruit) {
            $fruitsArray[] = $this->transform($fruit, $favoriteRepository);
        }

        return $fruitsArray;
    }
}
