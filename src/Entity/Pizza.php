<?php

namespace App\Entity;

use App\Repository\PizzaRepository;
use Core\Attributes\Table;
use Core\Attributes\TargetRepository;

#[TargetRepository(name: PizzaRepository::class)]
#[Table(name:"pizza")]
class Pizza
{
    #[Id(name:"id")]
    Private int $id;
    #[Column(name:"name")]
    Private string $name;

    #[Column(name:"description")]
    Private string $description;



    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}