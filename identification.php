<?php
require_once 'requeteBase.php';
$database = new baseDeDonnee();

$connecte = false;
$idCompte = $_GET['me'];
if (is_numeric($idCompte)){
    
    $idCompte = (int) $idCompte;

    if ($database->compteDansBD($idCompte)){
        $connecte = true;
    }
}

?>
