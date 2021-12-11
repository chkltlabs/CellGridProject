<?php
require "Models/Grid.php";
$grid = new \Models\Grid([
    [1,0,0],
    [0,0,0],
    [2,2,0]
]);

print($grid->toArray());
print($grid->nextGrid()->toArray());