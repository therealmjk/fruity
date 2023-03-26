<?php

namespace App\Entity;

use App\Repository\FavoriteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FavoriteRepository::class)]
class Favorite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $fruit_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFruitId(): ?int
    {
        return $this->fruit_id;
    }

    public function setFruitId(int $fruit_id): self
    {
        $this->fruit_id = $fruit_id;

        return $this;
    }
}
