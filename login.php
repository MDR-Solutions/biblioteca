<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bdreto";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dni = isset($_POST['dni']) ? trim($_POST['dni']) : null;
    $contraseña_ingresada = isset($_POST['contraseña']) ? trim($_POST['contraseña']) : null;

    if ($dni && $contraseña_ingresada) {
        // Consultar el usuario en la base de datos
        $sql = "SELECT contraseña FROM usuarios WHERE dni = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $dni);
        $stmt->execute();
        $stmt->bind_result($hash_guardado);
        $stmt->fetch();
        $stmt->close();

        // Verificar que se haya obtenido un hash
        if ($hash_guardado) {
            // Comparar la contraseña ingresada con el hash
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

$conn->close();
?>
