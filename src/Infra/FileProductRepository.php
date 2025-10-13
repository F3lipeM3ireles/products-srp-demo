<?php

declare(strict_types=1);

namespace App\Infra;

use App\Domain\ProductRepository;

final class FileProductRepository implements ProductRepository
{
    private string $path;

    public function __construct(string $path)
    {
        $this->path = $path;

        $folder = dirname($this->path);
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        if (!file_exists($this->path)) {
            touch($this->path);
        }
    }

    public function save(array $product): void
    {
        $json = json_encode($product, JSON_UNESCAPED_UNICODE);
        if ($json === false) {
            return;
        }

        $file = fopen($this->path, 'a');
        if ($file) {
            fwrite($file, $json . PHP_EOL);
            fclose($file);
        }
    }

    public function findAll(): array
    {
        if (!file_exists($this->path)) {
            return [];
        }

        $lines = file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if (!$lines) {
            return [];
        }

        $items = [];
        foreach ($lines as $line) {
            $data = json_decode($line, true);
            if (!is_array($data)) {
                continue;
            }

            $items[] = [
                'id' => (int)($data['id'] ?? 0),
                'name' => (string)($data['name'] ?? ''),
                'price' => (float)($data['price'] ?? 0),
            ];
        }

        return $items;
    }
}
