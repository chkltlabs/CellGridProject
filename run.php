<?php
require "bootstrap.php";

//using basic CLI interaction tips from https://stackoverflow.com/questions/5794030/interactive-shell-using-php

echo "Run Grid Model Tests? (Y/N) - ";

$stdin = fopen('php://stdin', 'r');
$response = fgetc($stdin);
if (strtoupper($response) == 'Y') {
    \Tests\ModelGridTest::run();
}

echo "Run Predetermined test cases? (Y/N) - ";

$stdin = fopen('php://stdin', 'r');
$response = fgetc($stdin);
if (strtoupper($response) == 'Y') {
    \Tests\PredeterminedTestCases::run();
}

echo "Run Complete Assignment? (Y/N) - ";

$stdin = fopen('php://stdin', 'r');
$response = fgetc($stdin);
if (strtoupper($response) == 'Y') {
    \Tests\CompleteAssignment::run();
}
