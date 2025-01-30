<?php
session_start();
require("conexion.php"); // Asegúrate de que este archivo establece correctamente la conexión en $conexion

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dni = isset($_POST['dni']) ? trim($_POST['dni']) : null;
    $contraseña_ingresada = isset($_POST['contraseña']) ? trim($_POST['contraseña']) : null;

    if ($dni && $contraseña_ingresada) {
        // Buscar el usuario en la base de datos
        $sql = "SELECT contraseña FROM usuarios WHERE dni = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $dni);
        $stmt->execute();
        $stmt->bind_result($hash_guardado);
        $stmt->fetch();
        $stmt->close();

        if ($hash_guardado) {
            if (password_verify($contraseña_ingresada, $hash_guardado)) {
                $_SESSION['dni'] = $dni;
                header("Location: socioexito.html");
                exit();
            } else {
                echo "<script>alert('Contraseña incorrecta'); window.history.go(-1);</script>";
            }
        } else {
            echo "<script>alert('Usuario no encontrado'); window.history.go(-1);</script>";
        }
    } else {
        echo "<script>alert('Por favor, completa todos los campos.'); window.history.go(-1);</script>";
    }
}

$conexion->close();
?>

