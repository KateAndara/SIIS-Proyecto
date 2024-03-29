<?php 
require '../Libraries/html2pdf/vendor/autoload.php'; 
require '../Libraries/html2pdf/vendor/autoload.php';
require_once('../config/conexion4.php');
require_once('../config/conexion3.php');

$idProceso=$_GET['id'];
//funcion para traer el html
function getFile(string $url, $data)
        {
            ob_start();
            require_once("../Formularios/{$url}.php");
            $file = ob_get_clean();
            return $file;        
        }


// ------------------------- Codigo para consultar la base de datos
$arrProceso=[];
 $sql = "SELECT * FROM tbl_proceso_produccion WHERE Id_Proceso_Produccion=$idProceso";
 $resultado = mysqli_query($conn, $sql);
 $resultado=mysqli_fetch_array($resultado,1);

 $arrProceso['Proceso']=$resultado;

 $sql2 = "SELECT mp.*,p.Nombre FROM tbl_producto_terminado_mp mp
 INNER JOIN tbl_productos p on p.Id_Producto=mp.Id_Producto
 WHERE mp.Id_Proceso_Produccion=$idProceso";
 $resultado = mysqli_query($conn, $sql2);
 $resultado=mysqli_fetch_all($resultado,1);
    
 $arrProceso['ProductosMP']=$resultado;

 $sql3 = "SELECT pf.*,p.Nombre FROM tbl_producto_terminado_final pf
 INNER JOIN tbl_productos p on p.Id_Producto=pf.Id_Producto
 WHERE pf.Id_Proceso_Produccion=$idProceso";
 $resultado = mysqli_query($conn, $sql3);
 $resultado=mysqli_fetch_all($resultado,1);
    
 $arrProceso['ProductosFinal']=$resultado;

$sql = "SELECT Valor FROM tbl_ms_parametros where Parametro='NOMBRE_EMPRESA'"; 
$resultado = mysqli_query($conn, $sql);
 $resultado=mysqli_fetch_all($resultado,1);

$arrProceso['DatosEmpresa']=$resultado;

$data=$arrProceso;

use Spipu\Html2Pdf\Html2Pdf;

ob_end_clean();
$html = getFile("../Reportes/reporteProcesoProduccionHtml", $data);
$html2pdf = new Html2Pdf('L', 'letter', 'es', 'true', 'UTF-8');

// Reduce el margen inferior para acercar el contenido al pie de página
$html2pdf->pdf->SetMargins(10, 10, 10);

$html2pdf->writeHTML($html);

date_default_timezone_set('America/Tegucigalpa');
$fecha = date('d/m/Y H:i:s');
$pagina_actual = $html2pdf->pdf->getPage();
$paginas_totales = $html2pdf->pdf->getNumPages();

// Controla el espacio vertical en el pie de página
$espacio_pie = 5; 

$html2pdf->writeHTML("
    <div style='position: absolute; bottom: {$espacio_pie}px; left: 10px;'>
        Generado el $fecha - Página $pagina_actual de $paginas_totales
    </div>
", true, false, true, false, '');

$html2pdf->output('Reporte de Producción.pdf');
        

?>