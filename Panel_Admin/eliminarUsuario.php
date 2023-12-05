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

// Obtener correo del usuario a eliminar
$emailEliminar = $_POST['emailEliminar'];

// Buscar usuario en la base de datos
$sql_check_user = "SELECT * FROM usuarios WHERE email = '$emailEliminar'";
$result_check_user = $conn->query($sql_check_user);

if ($result_check_user->num_rows > 0) {
    // Usuario encontrado, eliminarlo
    $sql_delete_user = "DELETE FROM usuarios WHERE email = '$emailEliminar'";
    
    if ($conn->query($sql_delete_user) === TRUE) {
        echo "Usuario eliminado exitosamente.";
    } else {
        echo "Error al eliminar usuario: " . $conn->error;
    }
} else {
    // Usuario no encontrado
    echo "Usuario no encontrado.";
}

// Cerrar conexión
$conn->close();
?>
