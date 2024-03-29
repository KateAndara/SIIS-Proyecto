<?php
session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
        header('Access-Control-Allow-Headers: token, Content-Type');
        header('Access-Control-Max-Age: 1728000');
        header('Content-Length: 0');
        header('Content-Type: text/plain');
        die();
     }
        header('Access-Control-Allow-Origin: *');  
        header('Content-Type: application/json');

        require_once '../config/conexion3.php';
        require_once '../models/Roles.php';

        function getFile(string $url, $data)
        {
            ob_start();
            require_once("{$url}.php");
            $file = ob_get_clean();
            return $file;        
        }


        $roles = new Rol();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetRoles":
                $datos=$roles->get_roles();


                    //ciclo for para insertar los botontes en cada opción
                    for ($i=0; $i < count($datos); $i++) { 

                        //variable de los botones
                        $btnView = '';
                        $btnEdit = '';
                        $btnDelete = '';

                         //si permisos es igual a Permiso_actualizacion de update crea el boton
                         if($_SESSION['permisosMod']['u']){
                            $btnView = '<button  style="background-color: #2D7AC0; color: white; display: inline-block; width: 80px;" class="rounded bg-success"  onclick="CargarPermiso(\'' .$datos[$i]['Id_Rol']. '\'); mostrarFormulario2();">Permisos</button>';
                        }

                        //si permisos es igual a Permiso_actualizacion de update crea el boton
                        if($_SESSION['permisosMod']['u']){
                            $btnEdit = '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarRol(\''.$datos[$i]['Id_Rol'].  '\'); mostrarFormulario();">Editar</button>';
                        }
                            //si permisos es igual a Permiso_eliminacion de delete crea el boton

                        if($_SESSION['permisosMod']['d']){
                            $btnDelete='<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarRol(\''.$datos[$i]['Id_Rol']. '\')">Eliminar</button>';
                        }
                    
                        
                        //unimos los botontes
                        $datos[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';

                    }
                    //Bitácora

                    $varsesion = $_SESSION['usuario'];
                    $Id_Usuario = intval($roles->get_user($varsesion));

                    if (!isset($_SESSION['ingreso_registrado_pantalla_roles'])) {
                        $roles->registrar_bitacora($Id_Usuario, 37,  'Ingresar', 'Se ingresó a la pantalla de roles ');

                        // Marcar que el ingreso ha sido registrado para esta pantalla de ventas
                        $_SESSION['ingreso_registrado_pantalla_roles'] = true;
                    }
        
                echo json_encode($datos);
            break;
            case "GetRol": //Buscar por cualquier campo 
                $busqueda = isset($body["Nombre"]) ? $body["Nombre"] : (isset($body["Id_Rol"]) ? $body["Id_Rol"] : '');
            
                $datos = $roles->get_rol($busqueda);
                
                echo json_encode($datos);
            break;
            case "GetRoleditar": //Trae la fila que se va a editar
                $datos=$roles->get_roleditar($body["Id_Rol"]);
                echo json_encode($datos);
            break;
            case "InsertRol":
                // Obtiene el nombre del rol y la descripción desde el cuerpo de la solicitud
                $Rol = $body["Rol"];
                $Descripcion = $body["Descripcion"];
            
                // Llama al método para insertar el rol y obtén el nombre del rol insertado
                $datos = $roles->insert_rol($Rol, $Descripcion);
            
                // Obtiene el Id_Usuario de la sesión
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($roles->get_user($varsesion));
            
                // Llama al método para registrar la bitácora con la información del rol insertado
                $roles->registrar_bitacora($Id_Usuario, 37, 'Insertar', 'Se insertó el rol: ' . $Rol);
            
                echo json_encode("Se agregó el rol");
            break;
            
            case "UpdateRol":
                $datos=$roles->update_rol($body["Id_Rol"],$body["Rol"],$body["Descripcion"]);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($roles->get_user($varsesion));
                $roles->registrar_bitacora($Id_Usuario, 37, 'Actualizar', 'Se actualizó el rol ' .$body["Rol"] ." con la descripción de: ".$body["Descripcion"]);
                echo json_encode("Rol Actualizado");
            break;
            case "DeleteRol":
                // Obtiene el Id_Rol desde el cuerpo de la solicitud
                $Id_Rol = $body["Id_Rol"];
            
                // Llama al método para eliminar el rol y obtiene el nombre del rol eliminado
                $rol_eliminado = $roles->roleliminar($Id_Rol);
                $datos = $roles->delete_rol($Id_Rol);
               
                
                // Obtiene el Id_Usuario de la sesión
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($roles->get_user($varsesion));
            
                // Llama al método para registrar la bitácora con la información del rol eliminado
                //if (!empty($rol_eliminado)) {
                    $roles->registrar_bitacora($Id_Usuario, 37, 'Eliminar', 'Se eliminó el rol: ' . $rol_eliminado);
               // }
            
                echo json_encode("Rol Eliminado");
            break;
            









            //Permisos
            case "GetPermisos":
                $id_Rol = $body['idRol'];
            
                $arrModulos = $roles->selectModulos();
                $arrPermisosRol = $roles->selectPermisosRol($id_Rol);
                $rol = $roles->selectRol($id_Rol);
                $nombreRol = $rol[0]['Rol'];
            
                // Eliminar el objeto "permisos" del array de módulos
                $arrModulos = array_filter($arrModulos, function($modulo) {
                    return $modulo['Tipo_objeto'] !== 'Permisos';
                });
            
                $arrPermisos = array('r' => 0, 'w' => 0, 'u' => 0, 'd' => 0);
                $arrPermisoRol = array('idrol' => $id_Rol);
            
                if (empty($arrPermisosRol)) {
                    for ($i = 0; $i < count($arrModulos); $i++) {
                        $arrModulos[$i]['permisos'] = $arrPermisos;
                    }
                } else {
                    for ($i = 0; $i < count($arrModulos); $i++) {
                        $arrPermisos = array('r' => 0, 'w' => 0, 'u' => 0, 'd' => 0);
                        if (isset($arrPermisosRol[$i])) {
                            $arrPermisos = array(
                                'r' => $arrPermisosRol[$i]['Permiso_consultar'],
                                'w' => $arrPermisosRol[$i]['Permiso_insercion'],
                                'u' => $arrPermisosRol[$i]['Permiso_actualizacion'],
                                'd' => $arrPermisosRol[$i]['Permiso_eliminacion']
                            );
                        }
                        $arrModulos[$i]['permisos'] = $arrPermisos;
                    }
                }
            
                $arrPermisoRol['modulos'] = $arrModulos;
            
                $htmlPermisos = getFile('../Formularios/EditarPermisos', $arrPermisoRol);
            
                $arrResponse = array("status" => true, "msg" => 'Producto agregado', "htmlPermisos" => $htmlPermisos, "nombreRol" => $nombreRol);
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            break;
            case "setPermisos":

                $intIdrol = intval($_POST['idrol']);
				$modulos = $_POST['modulos'];
             
				$roles->deletePermisos($intIdrol);
				foreach ($modulos as $modulo) {
					
					$idModulo = $modulo['Id_Objeto'];
					$r = empty($modulo['r']) ? 0 : 1;
					$w = empty($modulo['w']) ? 0 : 1;
					$u = empty($modulo['u']) ? 0 : 1;
					$d = empty($modulo['d']) ? 0 : 1;
					
					$requestPermiso = $roles->insertPermisos($intIdrol, $idModulo, $r, $w, $u, $d);
					$rol=$roles->selectRol($intIdrol);
				}

                $arrResponse = array('status' => true, 'msg' => 'Permisos asignados correctamente.');


               echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);

            break;
        }

?>   
