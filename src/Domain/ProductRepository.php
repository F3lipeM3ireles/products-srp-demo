<?php

declare(strict_types=1);

namespace App\Domain;

interface ProductRepository
{
    public function save(array $product): void;

    public function findAll(): array;
}
