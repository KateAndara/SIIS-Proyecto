<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    
    // Conexión a la base de datos
    require_once '../config/conexion.php';
    
    // Consulta SQL para obtener los movimientos de inventario entre las fechas seleccionadas
    $queryInventario = "SELECT i.Id_Producto, p.Nombre AS NombreProducto, 
                        tm.Descripcion AS TipoMovimiento,
                        SUM(IFNULL(k.Cantidad, 0)) AS TotalMovimiento
                        FROM tbl_inventario i
                        LEFT JOIN tbl_kardex k ON i.Id_Producto = k.Id_Producto
                        LEFT JOIN tbl_productos p ON i.Id_Producto = p.Id_Producto
                        LEFT JOIN tbl_tipo_movimiento tm ON k.Id_Tipo_Movimiento = tm.Id_Tipo_Movimiento
                        WHERE k.Fecha_hora BETWEEN '$startDate' AND '$endDate'
                        GROUP BY i.Id_Producto, k.Id_Tipo_Movimiento";

    // Ejecutar la consulta
    $resultInventario = mysqli_query($conexion, $queryInventario);

    // Preparar los datos para el reporte de inventario
    $inventarioDetalles = [];
    while ($row = mysqli_fetch_assoc($resultInventario)) {
        $inventarioDetalle = array(
            "idProducto" => $row['Id_Producto'],
            "nombreProducto" => $row['NombreProducto'],
            "tipoMovimiento" => $row['TipoMovimiento'],
            "totalMovimiento" => $row['TotalMovimiento']
        );
        $inventarioDetalles[] = $inventarioDetalle;
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);

    // Define las variables para el gráfico
    $labelsInventario = [];
    $dataInventario = [];
    foreach ($inventarioDetalles as $detalle) {
        $labelsInventario[] = $detalle['nombreProducto'] . " (" . $detalle['tipoMovimiento'] . ")";
        $dataInventario[] = $detalle['totalMovimiento'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Inventario</title>
    <!-- Agregar librerías de Chart.js aquí -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Reporte de Inventario</h1>
    
    <?php if (isset($labelsInventario) && isset($dataInventario)) { ?>
        <div>
            <h2>Movimientos de Inventario</h2>
            <canvas id="inventoryChart"></canvas>
        </div>
    <?php } ?>
    
    <!-- Agregar código de Chart.js para el gráfico de inventario -->
    <?php if (isset($labelsInventario) && isset($dataInventario)) { ?>
        <script>
            var ctxInventory = document.getElementById("inventoryChart").getContext("2d");
            var inventoryChart = new Chart(ctxInventory, {
                type: "bar",
                data: {
                    labels: <?php echo json_encode($labelsInventario); ?>,
                    datasets: [{
                        label: "Movimientos de Inventario",
                        data: <?php echo json_encode($dataInventario); ?>,
                        backgroundColor: "rgba(75, 192, 192, 0.2)",
                        borderColor: "rgba(75, 192, 192, 1)",
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Función para imprimir la página
            function imprimirReporte() {
                window.print();
            }
        </script>
    <?php } ?>
    
    <!-- Agregar un botón para imprimir el reporte -->
    <button onclick="imprimirReporte()">Imprimir Reporte</button>
</body>
</html>
