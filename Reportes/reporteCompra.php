<?php 
require '../Libraries/html2pdf/vendor/autoload.php'; 
require '../Libraries/html2pdf/vendor/autoload.php';
require_once('../config/conexion4.php');
require_once('../config/conexion3.php');

$idCompra=$_GET['id'];
//funcion para traer el html
function getFile(string $url, $data)
        {
            ob_start();
            require_once("../Formularios/{$url}.php");
            $file = ob_get_clean();
            return $file;        
        }


// ------------------------- Codigo para consultar la base de datos
$arrCompra=[];
 $sql = "SELECT c.*, p.Nombre as nombreProveedor FROM  tbl_compras c INNER JOIN tbl_proveedores p on c.Id_Proveedor=p.Id_Proveedor WHERE c.Id_Compra=$idCompra";
 $resultado = mysqli_query($conn, $sql);
 $resultado=mysqli_fetch_array($resultado,1);

 $arrCompra['Compra']=$resultado;

 $sql2 = "SELECT dc.*,p.Nombre FROM tbl_detalle_compra dc
 INNER JOIN tbl_productos p on p.Id_Producto=dc.Id_Producto
 WHERE dc.Id_Compra=$idCompra";
 $resultado = mysqli_query($conn, $sql2);
 $resultado=mysqli_fetch_all($resultado,1);
    
 $arrCompra['DetalleCompra']=$resultado;


 foreach ($arrCompra['DetalleCompra'] as $key=> $detalle) {
               
              
    $idDetalle=$detalle['Id_Detalle_Compra'];
    $sql="SELECT `Id_Detalle_Producto_Comprado`,`Especie`,`Peso_vivo`,`Canal`,`Rendimiento` FROM `tbl_detalle_producto_comprado` WHERE `Id_Detalle_Compra`= $idDetalle";          
    $resultado = mysqli_query($conn, $sql);
    $resultado=mysqli_fetch_array($resultado,1);
    
    array_push($arrCompra['DetalleCompra'][$key],$resultado);
}

$sql = "SELECT Valor FROM tbl_ms_parametros where Parametro='NOMBRE_EMPRESA'"; 
$resultado = mysqli_query($conn, $sql);
 $resultado=mysqli_fetch_all($resultado,1);

$arrCompra['DatosEmpresa']=$resultado;

$data=$arrCompra;

use Spipu\Html2Pdf\Html2Pdf;
ob_end_clean();
$html = getfile("../Reportes/reporteCompraHtml",$data);
$html2pdf = new Html2Pdf('L','letter','es','true','UTF-8');
$html2pdf->writeHTML($html);
$html2pdf->output('Factura-.pdf');

?>