<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedCategory = $_POST['categorySelect'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    
    // Conexión a la base de datos
    require_once '../config/conexion.php';
    
    if ($selectedCategory === 'ventas') {
        // Consulta SQL para obtener los detalles de venta por producto en el rango de fechas
        $queryProductos = "SELECT p.Nombre AS NombreProducto, SUM(dv.Cantidad * dv.Precio) AS TotalVentaProducto
        FROM tbl_detalle_de_venta dv
        INNER JOIN tbl_productos p ON dv.Id_Producto = p.Id_Producto
        INNER JOIN tbl_ventas v ON dv.Id_Venta = v.Id_Venta
        WHERE v.Fecha BETWEEN '$startDate' AND '$endDate'
        GROUP BY p.Nombre";

        // Consulta SQL para obtener el total general de ventas en el rango de fechas
        $queryTotalGeneral = "SELECT SUM(dv.Cantidad * dv.Precio) + SUM(dv.Cantidad * dv.Precio) * (v.Impuesto / 100) AS TotalGeneral
                    FROM tbl_detalle_de_venta dv
                    INNER JOIN tbl_ventas v ON dv.Id_Venta = v.Id_Venta
                    WHERE v.Fecha BETWEEN '$startDate' AND '$endDate'";



        // Ejecutar las consultas
        $resultProductos = mysqli_query($conexion, $queryProductos);
        $resultTotalGeneral = mysqli_query($conexion, $queryTotalGeneral);

        // Preparar los datos para el gráfico de productos
        $labelsProductos = [];
        $dataProductos = [];
        while ($row = mysqli_fetch_assoc($resultProductos)) {
        $labelsProductos[] = $row['NombreProducto'];
        $dataProductos[] = $row['TotalVentaProducto'];
        }

        // Obtener el total general de ventas
        $rowTotalGeneral = mysqli_fetch_assoc($resultTotalGeneral);
        $totalGeneral = $rowTotalGeneral['TotalGeneral'];

        // Cerrar la conexión a la base de datos
        mysqli_close($conexion);
    }
    
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas</title>
    <!-- Agregar librerías de Chart.js aquí -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Reporte de Ventas</h1>
    
    <div>
        <h2>Ventas por Producto</h2>
        <canvas id="productSalesChart"></canvas>
    </div>
    
    <div>
        <h2>Total General de Ventas</h2>
        <p>Total General de Ventas: <?php echo number_format($totalGeneral, 2); ?></p>
    </div>
    
    <!-- Agregar código de Chart.js para el gráfico de ventas por producto -->
    <script>
        var ctxProduct = document.getElementById("productSalesChart").getContext("2d");
        var productSalesChart = new Chart(ctxProduct, {
            type: "bar",
            data: {
                labels: <?php echo json_encode($labelsProductos); ?>,
                datasets: [{
                    label: "Ventas por Producto",
                    data: <?php echo json_encode($dataProductos); ?>,
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
    
    <!-- Agregar un botón para imprimir el reporte -->
    <button onclick="imprimirReporte()">Imprimir Reporte</button>
</body>
</html>

