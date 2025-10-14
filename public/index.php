<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product SRP Demo</title>
</head>
<body>
    <h1>Cadastro de Produtos</h1>
    <form action="create.php" method="post">
        <label>Nome
            <input type="text" name="name" required minlength="2" maxlength="100">
        </label>
        <label>Preço
            <input type="text" name="price" required pattern="\d+[\.,]?\d*">
        </label>
        <button type="submit">Cadastrar</button>
    </form>
    <p><a href="products.php">Ver lista de produtos</a></p>
</body>
</html>
