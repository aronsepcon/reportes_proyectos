<?php
require_once("mysql_conector.inc.php");
require_once("constantes.inc.php");


$idTop = $_POST['idTop'];
$potencial = $_POST['potencial'];


$query = "UPDATE tops SET potencial = '$potencial' WHERE idtop = '$idTop'";

$statement     = $pdo->prepare($query);
$statement->execute(array());
$results     = $statement->fetchAll();
$rowaffect     = $statement->rowCount($query);
$salida     = "";



if($rowaffect == 1){
    
    echo json_encode(array("status" => 200, "cotenido" => "ok"));

}else{

    echo json_encode(array("status" => 404, "cotenido" => "fail"));

}

