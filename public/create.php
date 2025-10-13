<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Application\ProductService;
use App\Domain\SimpleProductValidator;
use App\Infra\FileProductRepository;

$file = __DIR__ . '/../storage/products.txt';

$service = new ProductService(new FileProductRepository($file), new SimpleProductValidator);

$response = $service->create($_POST);
$httpCode = $response ? 201 : 422;

http_response_code($httpCode);

echo $response ? 'Producto criado com sucesso' : 'Falha ao criar produto';
