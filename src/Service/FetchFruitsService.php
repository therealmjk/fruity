<?php

namespace App\Service;

use App\Entity\Fruit;
use App\Event\AfterFruitsSavedEvent;
use App\Repository\FruitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FetchFruitsService
{

    private const URL = 'https://fruityvice.com/api/fruit/all';

    public function __construct(
        public readonly HttpClientInterface $client,
        public readonly FruitRepository $fruitRepository,
        public readonly EntityManagerInterface $entityManager,
        public readonly EventDispatcherInterface $eventDispatcher,
        public readonly LoggerInterface $logger
    ) {
    }

    public function fetchFruits(): mixed
    {
        try {
            $response = $this->client->request('GET', self::URL);
            $fruits = json_decode($response->getContent());
            $this->storeToDatabase($fruits);

            return $fruits;
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());

            return null;
        }
    }

    private function storeToDatabase(array $fruits): void
    {
        if (! empty($fruits)) {

            foreach ($fruits as $fruit) {

                $fruitId = $fruit->id ?? 0;
                $fruitName = $fruit->name ?? null;

                if (! $fruitId || ! $fruitName) {
                    continue;
                }

                $this->insertUpdateFruit($fruit);
            }

            $this->eventDispatcher->dispatch(new AfterFruitsSavedEvent());
        }
    }

    private function insertUpdateFruit(object $fruit): void
    {
        # find fruit with existing fruit id
        $dbFruit = $this->fruitRepository->findOneByFruitId($fruit->id);

        if (! $dbFruit) {
            $dbFruit = new Fruit();
            $dbFruit->setFruitId($fruit->id);
        }

        $dbFruit->setGenus($fruit->genus ?? null);
        $dbFruit->setName($fruit->name);
        $dbFruit->setFamily($fruit->family ?? null);
        $dbFruit->setFruitOrder($fruit->order ?? null);
        $dbFruit->setNutritions((array) $fruit->nutritions ?? null);

        # insert or update
        $this->entityManager->persist($dbFruit);
        $this->entityManager->flush();
    }
}