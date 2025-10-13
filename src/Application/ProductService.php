<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\ProductRepository;
use App\Domain\ProductValidator;

final class ProductService
{
    private ProductRepository $repository;
    private ProductValidator $validator;

    public function __construct(ProductRepository $repository, ProductValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $input): array
    {
        $errors = $this->validator->validate($input);
        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }

        $name = trim((string)$input['name']);
        $price = (float) str_replace(',', '.', (string)$input['price']);

        $products = $this->repository->findAll();
        $lastId = 0;
        foreach ($products as $p) {
            if (isset($p['id']) && (int)$p['id'] > $lastId) {
                $lastId = (int)$p['id'];
            }
        }
        $nextId = $lastId + 1;

        $product = [
            'id' => $nextId,
            'name' => $name,
            'price' => $price,
        ];

        $this->repository->save($product);

        return ['success' => true, 'product' => $product];
    }


    public function list(): array
    {
        return $this->repository->findAll();
    }
}
