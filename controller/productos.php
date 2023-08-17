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
        require_once '../models/Productos.php';

        $productos = new Producto();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetProductos":
                $datos=$productos->get_productos();


                  //ciclo for para insertar los botontes en cada opción
                  for ($i=0; $i < count($datos); $i++) { 

                    //variable de los botones
                    $btnView = '';
                    $btnEdit = '';
                    $btnDelete = '';

                    

                    //si permisos es igual a Permiso_actualizacion de update crea el boton
                    if($_SESSION['permisosMod']['u']){
                        $btnEdit = '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarProducto(\''  .$datos[$i]['Id_Producto']. '\'); mostrarFormulario();">Editar</button>';
                    }
                        //si permisos es igual a Permiso_eliminacion de delete crea el boton

                    if($_SESSION['permisosMod']['d']){
                        $btnDelete='<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarProducto(\'' .$datos[$i]['Id_Producto']. '\')">Eliminar</button>';
                    }
                  
                    
                    //unimos los botontes
                    $datos[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';

                }
                //Bitácora

                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($productos->get_user($varsesion));

                if (!isset($_SESSION['ingreso_registrado_pantalla_productos'])) {
                    $productos->registrar_bitacora($Id_Usuario, 34,  'Ingresar', 'Se ingresó a la pantalla de productos ');

                    // Marcar que el ingreso ha sido registrado para esta pantalla de ventas
                    $_SESSION['ingreso_registrado_pantalla_productos'] = true;
                }
              
                echo json_encode($datos);
            break;
            case "GetProducto": //Buscar por cualquier campo 
                $busqueda = isset($body["Nombre"]) ? $body["Nombre"] : (isset($body["Id_Producto"]) ? $body["Id_Producto"] : '');
                $datos = $productos->get_producto($busqueda);
                echo json_encode($datos);
            break;
            case "GetProductoeditar": //Trae la fila que se va a editar
                $datos=$productos->get_productoeditar($body["Id_Producto"]);
                echo json_encode($datos);
            break;
            case "InsertProducto":
                $datos=$productos->insert_producto($body["Id_Tipo_Producto"],$body["Nombre"],$body["Unidad_medida"],$body["Precio"],$body["Cantidad_maxima"],$body["Cantidad_minima"]);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($productos->get_user($varsesion));
                $productos->registrar_bitacora($Id_Usuario, 34, 'Insertar', 'Se insertó el Producto: '.$body["Nombre"]);
                echo json_encode("Se agregó el producto");
            break;
            case "UpdateProducto":
                $datos=$productos->update_producto($body["Id_Producto"],$body["Id_Tipo_Producto"],$body["Nombre"],$body["Unidad_medida"],$body["Precio"],$body["Cantidad_maxima"],$body["Cantidad_minima"]);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($productos->get_user($varsesion));
                $productos->registrar_bitacora($Id_Usuario, 34, 'Actualizar', 'Se actualizó el Producto: '.$body["Nombre"]. ' con campos: '.$body["Unidad_medida"].', '.$body["Precio"].', '.$body["Cantidad_maxima"].', '.$body["Cantidad_minima"]);
                echo json_encode("Producto actualizado");
            break;
            case "DeleteProducto":
                $Id_Producto = $body["Id_Producto"];
                $producto_eliminado = $productos->productoeliminar($Id_Producto);
                
                if ($producto_eliminado !== "El producto con Id_Producto = $Id_Producto no existe.") {
                    // Si el producto existe, procede con la eliminación y el registro en la bitácora.
                    $datos = $productos->delete_producto($Id_Producto);
                    $varsesion = $_SESSION['usuario'];
                    $Id_Usuario = intval($productos->get_user($varsesion));
                    $productos->registrar_bitacora($Id_Usuario, 34, 'Eliminar', 'Se eliminó el Producto: ' . $producto_eliminado);
                    echo json_encode("Producto eliminado");
                } else {
                    // Si el producto no existe, envía un mensaje adecuado.
                    echo json_encode("El producto no existe, no se pudo eliminar.");
                }
            break;
            //Datos de otra tabla
            case "GetTipoProductos":
                $datos=$productos->get_tipoproductos();
                echo json_encode($datos);
            break;            
        }

?>