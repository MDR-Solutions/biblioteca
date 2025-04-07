<?php
$server = "localhost";
$user = "admin";
$pass = "admin";
$db = "bdreto";

$conexion = new mysqli($server, $user, $pass, $db);

if($conexion->connect_errno){
    die("Conexion Fallida". $conexion->connect_errno);
} else{
    echo "";
}

?>