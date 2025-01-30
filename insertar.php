<?php
require_once("conexion.php");

// Obtener los datos enviados por POST
$nombre = $_POST["nombre"];
$apellido1 = $_POST["apellido1"];
$apellido2 = $_POST["apellido2"];
$direccion = $_POST["direccion"];
$telefono = $_POST["telefono"];
$dni = $_POST["dni"];
$preferencias = $_POST["preferencias"];
$contraseña = password_hash($_POST["contraseña"], PASSWORD_DEFAULT);

// Crear la consulta de inserción con prepared statements
$stmt = $conexion->prepare("INSERT INTO usuarios(nombre, apellido1, apellido2, direccion, telefono, dni, preferencias, contraseña) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $nombre, $apellido1, $apellido2, $direccion, $telefono, $dni, $preferencias, $contraseña);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "<script>
            alert('Usuario registrado con éxito');
            window.location='./socioexito.html';
          </script>";
} else {
    echo "<script>
            alert('Error al registrar usuario: " . $stmt->error . "');
            window.history.go(-1);
          </script>";
}

// Cerrar la conexión
$stmt->close();
$conexion->close();
?>
