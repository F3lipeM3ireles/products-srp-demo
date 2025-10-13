<?php

declare(strict_types=1);

namespace App\Domain;

interface ProductValidator
{
    public function validate(array $input): array;
}
