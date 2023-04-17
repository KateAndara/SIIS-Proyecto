<?php
function getPermisos(int $idModulo)
{
    if (!empty($_SESSION['Id_Usuario'])) {
        require_once '../config/conexion3.php';
        
        require_once("../models/permisos.php");
        $permisos = '';
        $PermisosMod = '';
        $permisos = new Permiso();

        
     

        $id_rol=$_SESSION['Id_Rol'];
        


        $resultado=$permisos->get_permisos2($id_rol);
       

       
       

       if(count($resultado) > 0){
            $permisos = $resultado;
            $PermisosMod = isset($resultado[$idModulo]) ? $resultado[$idModulo] : "";
        }
        $_SESSION['permisos'] = $permisos;
        $_SESSION['permisosMod'] = $PermisosMod;
    }
}


const MVENTAS=24;
const MDESCUENTOS=25;
const MPROMOCIONES=26;
const MDETALLEVENTAS=27;
const MDESCUENTOSAPLICADOS=28;
const MPROMOCIONES_APLICADAS=24;
const MCLIENTES=28;
const MCOMPRAS=29;
const MNUEVACOMPRA=29;
const MPROVEEDORES=30;
const MPREGUNTAS=31;
const MPROCESOPRODUCCION=32;
const MINVENTARIO=33;
const MPRODUCTOS=34;
const MKARDEX=35;
const MUSUARIOS=36;
const MROLES=37;
const MPERMISOS=38;
const MBITACORA=39;
const MPARAMETROS=40;
const MOBJETOS=41;
const MCARGOS=42;
const MESTADOvENTA=43;
const MTIPOPRODUCTO=44;
const MTALONARIO=45;
const MCONTACTOPROVEEDORES=46;
const MCONTACTOCLIENTES=47;
const MTIPOCONTACTO=48;
const MTIPOMOVIMIENTO=49;
const MESTADOPROCESO=50;
const MPERFIL=53;
const MACERCADE=52;
const MBACKUP=51;


?>