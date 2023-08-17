<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    // Conexión a la base de datos
    require_once '../config/conexion.php';

    // Consulta SQL para obtener las cantidades de materia prima
    $queryCantidadesMateriaPrima = "SELECT
        pt_mp.Nombre AS NombreMateriaPrima,
        SUM(ptmp.Cantidad) AS CantidadMateriaPrima
    FROM
        tbl_producto_terminado_mp ptmp
    JOIN
        tbl_productos pt_mp ON ptmp.Id_Producto = pt_mp.Id_Producto
    JOIN
        tbl_proceso_produccion pp ON ptmp.Id_Proceso_Produccion = pp.Id_Proceso_Produccion
    WHERE
        pp.Fecha BETWEEN '$startDate' AND '$endDate'
    GROUP BY
        pt_mp.Id_Producto, pt_mp.Nombre";

    // Consulta SQL para obtener las cantidades de producto final
    $queryCantidadesProductoFinal = "SELECT
        pt_pf.Nombre AS NombreProductoFinal,
        SUM(ptf.Cantidad) AS CantidadProductoFinal
    FROM
        tbl_producto_terminado_final ptf
    JOIN
        tbl_productos pt_pf ON ptf.Id_Producto = pt_pf.Id_Producto
    JOIN
        tbl_proceso_produccion pp ON ptf.Id_Proceso_Produccion = pp.Id_Proceso_Produccion
    WHERE
        pp.Fecha BETWEEN '$startDate' AND '$endDate'
    GROUP BY
        pt_pf.Id_Producto, pt_pf.Nombre";

    // Ejecutar las consultas
    $resultCantidadesMateriaPrima = mysqli_query($conexion, $queryCantidadesMateriaPrima);
    $resultCantidadesProductoFinal = mysqli_query($conexion, $queryCantidadesProductoFinal);

    // Preparar los datos para el reporte
    $cantidadesMateriaPrimaDetalles = [];
    while ($row = mysqli_fetch_assoc($resultCantidadesMateriaPrima)) {
        $cantidadMateriaPrimaDetalle = array(
            "nombreMateriaPrima" => $row['NombreMateriaPrima'],
            "cantidadMateriaPrima" => $row['CantidadMateriaPrima']
        );
        $cantidadesMateriaPrimaDetalles[] = $cantidadMateriaPrimaDetalle;
    }

    $cantidadesProductoFinalDetalles = [];
    while ($row = mysqli_fetch_assoc($resultCantidadesProductoFinal)) {
        $cantidadProductoFinalDetalle = array(
            "nombreProductoFinal" => $row['NombreProductoFinal'],
            "cantidadProductoFinal" => $row['CantidadProductoFinal']
        );
        $cantidadesProductoFinalDetalles[] = $cantidadProductoFinalDetalle;
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Producción</title>
    <!-- Agregar librerías de Chart.js aquí -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Reporte de Producción</h1>
    
    <div>
        <h2>Cantidades de Materia Prima</h2>
        <canvas id="cantidadMateriaPrimaChart"></canvas>
    </div>

    <div>
        <h2>Cantidades de Producto Final</h2>
        <canvas id="cantidadProductoFinalChart"></canvas>
    </div>
    
    <!-- Agregar código de Chart.js para el gráfico de cantidades de materia prima -->
    <script>
        var ctxMateriaPrima = document.getElementById("cantidadMateriaPrimaChart").getContext("2d");
        var cantidadMateriaPrimaChart = new Chart(ctxMateriaPrima, {
            type: "bar",
            data: {
                labels: <?php echo json_encode(array_column($cantidadesMateriaPrimaDetalles, 'nombreMateriaPrima')); ?>,
                datasets: [{
                    label: "Cantidad Materia Prima",
                    data: <?php echo json_encode(array_column($cantidadesMateriaPrimaDetalles, 'cantidadMateriaPrima')); ?>,
                    backgroundColor: "rgba(75, 192, 192, 0.2)",
                    borderColor: "rgba(75, 192, 192, 1)",
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                       //precision: 0 // Esto mostrará solo números enteros en el eje Y
                    }
                }
            }
        });

        // Agregar código de Chart.js para el gráfico de cantidades de producto final
        var ctxProductoFinal = document.getElementById("cantidadProductoFinalChart").getContext("2d");
        var cantidadProductoFinalChart = new Chart(ctxProductoFinal, {
            type: "bar",
            data: {
                labels: <?php echo json_encode(array_column($cantidadesProductoFinalDetalles, 'nombreProductoFinal')); ?>,
                datasets: [{
                    label: "Cantidad Producto Final",
                    data: <?php echo json_encode(array_column($cantidadesProductoFinalDetalles, 'cantidadProductoFinal')); ?>,
                    backgroundColor: "rgba(192, 75, 75, 0.2)",
                    borderColor: "rgba(192, 75, 75, 1)",
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
