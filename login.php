<?php
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
    $dni = isset($_POST['dni']) ? htmlspecialchars(trim($_POST['dni'])) : null;
    $contraseña = isset($_POST['contraseña']) ? htmlspecialchars(trim($_POST['contraseña'])) : null;

    if ($dni && $contraseña) {
        // Consultar el usuario en la base de datos
        $sql = "SELECT * FROM usuarios WHERE dni = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $dni);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Depuración: Mostrar valores que se están comparando
            // (Eliminar estas líneas en producción)
            echo "Contraseña ingresada: " . $contraseña . "<br>";
            echo "Hash en la base de datos: " . $user['contraseña'] . "<br>";

            // Verificar la contraseña
            if (password_verify($contraseña, $user['contraseña'])) {
                session_start();
                $_SESSION['dni'] = $user['dni'];
                echo "¡Login exitoso! Bienvenido, usuario con DNI: " . htmlspecialchars($user['dni']);
            } else {
                echo "Contraseña incorrecta.";
            }
        } else {
            echo "Usuario no encontrado.";
        }

        $stmt->close();
    } else {
        echo "Por favor, completa todos los campos.";
    }
}

$conn->close();
?>
