<?php
    include("conexion.php");
    $nombre=$_POST["nombre"];
    $apellido=$_POST["apellido1"];
    $email=$_POST["apellido2"];
    $direccion=$_POST["dirección"];
    $telefono=$_POST["telefono"];
    $dni=$_POST["dni"];
    $preferencias=$_POST["preferencias"];
    $insertar="INSERT INTO usuarios(nombre,apellido1,apellido2,dirección,telefono,dni,preferencias)values('$nombre', '$apellido1','$apellido2',' $dirección','$telefono','$dni','$preferencias')";
    mysqli_query($conexion,$insertar);
    mysqli_close($conexion);
?>