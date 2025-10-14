<?php

declare(strict_types=1);

namespace App\Domain;

final class SimpleProductValidator implements ProductValidator
{
    public function validate(array $input): array
    {
        $errors = [];

        $name = isset($input['name']) ? trim((string)$input['name']) : '';
        $price = $input['price'] ?? null;

        if ($name === '') 
        {
            $errors['name'] = 'O nome é obrigatório.';
        } 

        if (mb_strlen($name) < 2) 
        {
            $errors['name'] = 'O nome deve ter ao menos 2 caracteres.';
        } 

        if (mb_strlen($name) > 100) 
        {
            $errors['name'] = 'O nome deve ter no máximo 100 caracteres.';
        }

        if ($price === null || $price === '') 
        {
            $errors['price'] = 'O preço é obrigatório.';
        } 
        
        else 
        {
            $priceString = str_replace(',', '.', (string)$price);
            if (!is_numeric($priceString)) 
            {
                $errors['price'] = 'O preço deve ser numérico.';
            } 
            
            if (((float)$priceString) < 0) 
            {
                $errors['price'] = 'O preço não pode ser negativo.';
            }
        }

        return $errors;
    }
}

