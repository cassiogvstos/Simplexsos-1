<?php
require_once 'Simplex/Simplex.php';

$simplex = new Simplex\Simplex();

$matrizes = $simplex->executar('3x1 + 5x2', ['x1 <= 4', 'x2 <= 4', '3x1 + 2x2 <= 18']);

echo '<pre>';
print_r($matrizes);
echo '</pre>';