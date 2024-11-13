<?php

require_once "vendor/autoload.php";

$mdp = "aubry";
$complexiter =  App\Fonctions\CalculComplexiteMdp($mdp);
echo $complexiter;
echo PHP_EOL;


$mdp="super@ubry";
$complexiter =  App\Fonctions\CalculComplexiteMdp($mdp);
echo $complexiter;
echo PHP_EOL;


$mdp="Super@ubry2022";
$complexiter =  App\Fonctions\CalculComplexiteMdp($mdp);
echo $complexiter;
echo PHP_EOL;

$mdp="Giroud-Président||2027";
$complexiter =  App\Fonctions\CalculComplexiteMdp($mdp);
echo $complexiter;
echo PHP_EOL;
