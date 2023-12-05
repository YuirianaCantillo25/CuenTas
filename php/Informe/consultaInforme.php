<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usuariosCuentas";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$fechaDesde = $_GET['fechaDesde'];
$fechaHasta = $_GET['fechaHasta'];

if (!empty($fechaDesde) && !empty($fechaHasta)) {
    $fechaDesde = date('Y-m-d', strtotime($fechaDesde));
    $fechaHasta = date('Y-m-d', strtotime($fechaHasta));
    $sql = "SELECT fecha, SUM(ingresos) as total_ingresos, SUM(gastos) as total_gastos FROM balance WHERE fecha BETWEEN '$fechaDesde' AND '$fechaHasta' GROUP BY fecha";
} else {
    $sql = "SELECT fecha, SUM(ingresos) as total_ingresos, SUM(gastos) as total_gastos FROM balance GROUP BY fecha";
}

$result = $conn->query($sql);

$fechas = [];
$ingresos = [];
$gastos = [];

while ($row = $result->fetch_assoc()) {
    $fechas[] = $row['fecha'];
    $ingresos[] = $row['total_ingresos'];
    $gastos[] = $row['total_gastos'];
}

$datos_json = json_encode([
    'fechas' => $fechas,
    'ingresos' => $ingresos,
    'gastos' => $gastos
]);

$conn->close();

echo $datos_json;
?>
