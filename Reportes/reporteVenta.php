<?php 
require '../Libraries/html2pdf/vendor/autoload.php'; 
require '../Libraries/html2pdf/vendor/autoload.php';
require_once('../config/conexion4.php');
require_once('../config/conexion3.php');
require_once '../models/Ventas.php';
$ventas = new Ventas();

$idVenta=$_GET['id'];


//funcion para traer el html
function getFile(string $url, $data)
        {
            ob_start();
            require_once("../Formularios/{$url}.php");
            $file = ob_get_clean();
            return $file;        
        }


// ------------------------- Codigo para consultar la base de datos

$arrVenta=array();

$venta=$ventas->get_venta($idVenta);
$detalle=$ventas->get_detalle($idVenta);
$descuento=$ventas->get_descuentoVenta($idVenta);






$arrVenta['Venta']=$venta;
$arrVenta['detalle']=$detalle;
$arrVenta['descuento']=$descuento;





    $sql = "SELECT Valor FROM tbl_ms_parametros where Parametro='NOMBRE_EMPRESA'"; 
    $resultado = mysqli_query($conn, $sql);
     $resultado=mysqli_fetch_all($resultado,1);
    
    $arrVenta['DatosEmpresa']=$resultado;

use Spipu\Html2Pdf\Html2Pdf;
ob_end_clean();
$html = getfile("../Reportes/reporteVentaHtml",$arrVenta);
$html2pdf = new Html2Pdf('L','letter','es','true','UTF-8');
$html2pdf->writeHTML($html);
$html2pdf->output('Factura-.pdf');

?>