<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usuariosCuentas";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$codigoProducto = $conn->real_escape_string($_POST['buscarCodigo']);
$unidadesCompradas = (int)$_POST['unidadesCompradas'];

// Obtener información actual del inventario
$sqlInfoInventario = "SELECT existencia_inicial, entradas FROM inventario WHERE codigo_producto = '$codigoProducto'";
$resultInfoInventario = $conn->query($sqlInfoInventario);

if ($resultInfoInventario) {
    if ($resultInfoInventario->num_rows > 0) {
        $rowInfoInventario = $resultInfoInventario->fetch_assoc();
        $existenciaInicial = $rowInfoInventario['existencia_inicial'];
        $entradasAnteriores = $rowInfoInventario['entradas'];

        // Calcular el nuevo stock y actualizar la tabla de compras
        $unidadesCompradasActual = $unidadesCompradas;
        $nuevoStock = $existenciaInicial + $entradasAnteriores + $unidadesCompradasActual;

        $sqlActualizarCompras = "UPDATE inventario SET entradas = entradas + $unidadesCompradasActual, stock = $nuevoStock WHERE codigo_producto = '$codigoProducto'";
        $resultActualizarCompras = $conn->query($sqlActualizarCompras);

        if ($resultActualizarCompras) {
            echo "Compra registrada exitosamente";
        } else {
            echo "Error al actualizar compras: " . $conn->error;
        }
    } else {
        echo "Error: Producto no encontrado";
    }
} else {
    echo "Error en la consulta: " . $conn->error;
}

$conn->close();

?>
