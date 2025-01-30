<?php
require("conexion.php"); // Asegúrate de que este archivo establece correctamente la conexión en $conexion

// Verificar si la petición es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombre = trim($_POST["nombre"]);
    $apellido1 = trim($_POST["apellido1"]);
    $apellido2 = trim($_POST["apellido2"]);
    $direccion = trim($_POST["direccion"]);
    $telefono = trim($_POST["telefono"]);
    $dni = trim($_POST["dni"]);
    $preferencias = trim($_POST["preferencias"]);
    $contraseña = password_hash(trim($_POST["contraseña"]), PASSWORD_DEFAULT);

    // Preparar la consulta segura
    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, apellido1, apellido2, direccion, telefono, dni, preferencias, contraseña) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $nombre, $apellido1, $apellido2, $direccion, $telefono, $dni, $preferencias, $contraseña);

    // Ejecutar la consulta y comprobar si fue exitosa
    if ($stmt->execute()) {
        echo "<script>
                alert('Usuario registrado con éxito');
                window.location='socioexito.html';
              </script>";
    } else {
        echo "<script>
                alert('Error al registrar usuario: " . $stmt->error . "');
                window.history.go(-1);
              </script>";
    }

    // Cerrar la sentencia y la conexión
    $stmt->close();
    $conexion->close();
} else {
    echo "<script>alert('Acceso denegado.'); window.history.go(-1);</script>";
}
?>

