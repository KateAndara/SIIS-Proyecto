<?php 
require '../Libraries/html2pdf/vendor/autoload.php'; 
require '../Libraries/html2pdf/vendor/autoload.php';
require_once('../config/conexion4.php');
require_once('../config/conexion3.php');
require_once '../models/Roles.php';

$roles = new Rol();

$id_Rol=$_GET['rol'];


//funcion para traer el html
function getFile(string $url, $data)
        {
            ob_start();
            require_once("../Formularios/{$url}.php");
            $file = ob_get_clean();
            return $file;        
        }


// ------------------------- Codigo para consultar la base de datos
$arrModulos = $roles->selectModulos();
$arrPermisosRol = $roles->selectPermisosRol($id_Rol);

$rol=$roles->selectRol($id_Rol);

$nombreRol=$rol[0]['Rol'];

//$arrRol = $this->model->getRol($rolid);
$arrPermisos = array('r' => 0, 'w' => 0, 'u' => 0, 'd' => 0);
$arrPermisoRol = array('idrol' => $id_Rol);
$arrPermisoRol['nombreRol']=$nombreRol;

if(empty($arrPermisosRol))
{
    for ($i=0; $i < count($arrModulos) ; $i++) { 

        $arrModulos[$i]['permisos'] = $arrPermisos;
    }
}else{
    for ($i=0; $i < count($arrModulos); $i++) {
        $arrPermisos = array('r' => 0, 'w' => 0, 'u' => 0, 'd' => 0);
        if(isset($arrPermisosRol[$i])){
            $arrPermisos = array('r' => $arrPermisosRol[$i]['Permiso_consultar'], 
                                 'w' => $arrPermisosRol[$i]['Permiso_insercion'], 
                                 'u' => $arrPermisosRol[$i]['Permiso_actualizacion'], 
                                 'd' => $arrPermisosRol[$i]['Permiso_eliminacion'] 
                                );            
        }
        $arrModulos[$i]['permisos']=$arrPermisos;
     }
    }

    $arrPermisoRol['modulos']=$arrModulos;

    $sql = "SELECT Valor FROM tbl_ms_parametros where Parametro='NOMBRE_EMPRESA'"; 
    $resultado = mysqli_query($conn, $sql);
     $resultado=mysqli_fetch_all($resultado,1);
    
    $arrPermisoRol['DatosEmpresa']=$resultado;

    use Spipu\Html2Pdf\Html2Pdf;
    ob_end_clean();
    $html = getfile("../Reportes/reportePermisoshtml",$arrPermisoRol);
    $html2pdf = new Html2Pdf('L','letter','es','true','UTF-8');
    $html2pdf->writeHTML($html);
    // Agregar pie de página
    date_default_timezone_set('America/Tegucigalpa');
    $fecha = date('d/m/Y H:i:s');
    $pagina_actual = $html2pdf->pdf->getPage();
    $paginas_totales = $html2pdf->pdf->getNumPages();
    $numero_br = 28;
    $br_tags = '';
    for ($i = 0; $i < $numero_br; $i++) {
    $br_tags .= '<br>';
    }
    $html2pdf->writeHTML("$br_tags<div style='position: fixed; bottom: 10px; right: 10px;'>Generado el $fecha - Página $pagina_actual de $paginas_totales</div>", true, false, true, false, '');
    $html2pdf->output('Reporte de Permisos-.pdf');
        

;
        

?>
