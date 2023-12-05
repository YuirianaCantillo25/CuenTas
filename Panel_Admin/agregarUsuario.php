<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usuariosCuentas";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$contraseña = password_hash($_POST['contraseña'], PASSWORD_BCRYPT);
$rol = $_POST['rol'];

// Validar si el correo ya está registrado
$sql_check_email = "SELECT * FROM usuarios WHERE email = '$email'";
$result_check_email = $conn->query($sql_check_email);

if ($result_check_email->num_rows > 0) {
    // El correo ya está registrado
    echo "Usuario ya registrado. Ingresa otro correo.";
} else {
    // Insertar usuario en la base de datos
    $sql_insert_user = "INSERT INTO usuarios (nombre, email, contraseña, rol) VALUES ('$nombre', '$email', '$contraseña', '$rol')";

    if ($conn->query($sql_insert_user) === TRUE) {
        echo "Usuario agregado exitosamente.";
    } else {
        echo "Error al agregar usuario: " . $conn->error;
    }
}

// Cerrar conexión
$conn->close();
?>
