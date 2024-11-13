<?php
namespace App\Fonctions;
    function Redirect_Self_URL():void{
        unset($_REQUEST);
        header("Location: ".$_SERVER['PHP_SELF']);
        exit;
    }

function GenereMDP($nbChar) :string{

    return "secret";
}
function CalculComplexiteMdp($mdp) :int
{
    $nbChar = strlen($mdp);
    $baseCara = 0;
    if (preg_match('/[a-z]/', $mdp)) $baseCara += 26 ;

    if (preg_match('/[A-Z]/', $mdp)) $baseCara += 26 ;

    if (preg_match('/[0-9]/', $mdp)) $baseCara += 10 ;

    if (preg_match('/[a-zA-Z0-9]/', $mdp)) $baseCara += 10;

    return $nbChar * log($baseCara, 2);
}