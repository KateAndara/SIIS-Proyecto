<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedCategory = $_POST['categorySelect'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    
    // Conexión a la base de datos
    require_once '../config/conexion.php';
    
    if ($selectedCategory === 'compras') {
        // Consulta SQL para obtener los detalles de compra por producto en el rango de fechas
        $queryCompras = "SELECT c.Id_Compra, c.Fecha_compra, c.Total, p.Nombre AS NombreProveedor, d.Cantidad, pr.Nombre AS NombreProducto
        FROM tbl_compras c
        INNER JOIN tbl_proveedores p ON c.Id_Proveedor = p.Id_Proveedor
        INNER JOIN tbl_detalle_compra d ON c.Id_Compra = d.Id_Compra
        INNER JOIN tbl_productos pr ON d.Id_Producto = pr.Id_Producto
        WHERE c.Fecha_compra BETWEEN '$startDate' AND '$endDate' AND c.Cancelada = 0";

        // Consulta SQL para obtener el total general de compras en el rango de fechas, excluyendo las canceladas
        $queryTotalGeneralCompras = "SELECT SUM(c.Total) AS TotalGeneralCompras
        FROM tbl_compras c
        WHERE c.Fecha_compra BETWEEN '$startDate' AND '$endDate' AND c.Cancelada = 0";

        // Ejecutar las consultas
        $resultCompras = mysqli_query($conexion, $queryCompras);
        $resultTotalGeneralCompras = mysqli_query($conexion, $queryTotalGeneralCompras);

        // Preparar los datos para el reporte de compras
        $comprasDetalles = [];
        while ($row = mysqli_fetch_assoc($resultCompras)) {
            $compraDetalle = array(
                "idCompra" => $row['Id_Compra'],
                "fechaCompra" => $row['Fecha_compra'],
                "totalCompra" => $row['Total'],
                "proveedor" => $row['NombreProveedor'],
                "cantidad" => $row['Cantidad'],
                "producto" => $row['NombreProducto']
            );
            $comprasDetalles[] = $compraDetalle;
        }

        // Obtener el total general de compras
        $rowTotalGeneralCompras = mysqli_fetch_assoc($resultTotalGeneralCompras);
        $totalGeneralCompras = $rowTotalGeneralCompras['TotalGeneralCompras'];

        // Cerrar la conexión a la base de datos
        mysqli_close($conexion);

        // Define las variables para el gráfico (debes tener lógica similar para generar $labelsProductos)
        $labelsCompras = [];
        $dataCompras = [];
        foreach ($comprasDetalles as $compra) {
            $labelsCompras[] = $compra['producto'] . " (Proveedor: " . $compra['proveedor'] . ")";
            $dataCompras[] = $compra['totalCompra'];
        }
    
    
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Compras</title>
    <!-- Agregar librerías de Chart.js aquí -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Reporte de Compras</h1>
    
    <div>
        <h2>Compras por Producto</h2>
        <canvas id="productSalesChart"></canvas>
    </div>
    
    <div>
        <h2>Total General de Compras</h2>
        <p>Total General de Compras: <?php echo number_format($totalGeneralCompras, 2); ?></p>
    </div>
    
    <!-- Agregar código de Chart.js para el gráfico de ventas por producto -->
    <script>
                var ctxProduct = document.getElementById("productSalesChart").getContext("2d");
                var productSalesChart = new Chart(ctxProduct, {
                    type: "bar",
                    data: {
                        labels: <?php echo json_encode($labelsCompras); ?>,
                        datasets: [{
                            label: "Compras por Producto",
                            data: <?php echo json_encode($dataCompras); ?>,
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

