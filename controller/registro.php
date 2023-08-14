<?php
 
  
  if (!empty($_POST["btnRegistrar"])){
       // Validación de campos vacios 
       if (empty($_POST["Usuario"]) or empty($_POST["Nombre"]) or empty($_POST["Dni"]) or empty($_POST["Clave"]) or empty($_POST["Confirmacion"]) or empty($_POST["Email"])) {
           echo '<div class="alert alert-danger">Uno de los campos esta vacio</div> ';
       } elseif ($_POST["Clave"] != $_POST["Confirmacion"]){
           echo '<div class="alert alert-danger">Los campos de contraseña no coinciden</div> ';
       } else {
        $usuario=$_POST["Usuario"];
        $clave=$_POST["Clave"];
        $_dni=$_POST["Dni"];
        $_correo=$_POST["Email"];

        //Validar formato DNI
        function testFormatoDni($_dni) {
          // Expresión regular para validar el formato "0000-0000-00000"
          $formatoDniRegex = '/^\d{4}-\d{4}-\d{5}$/';
      
          // Testea si el valor coincide con el formato esperado
          return preg_match($formatoDniRegex, $_dni);
        }
        //Validar correo
        function fntEmailValidate($email) {
          $stringEmail = '/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})$/';
          if (preg_match($stringEmail, $email) == 0) {
              return false;
          } else {
              return true;
          }
      }
      
        // Funcion para validar contraseña
        function valcontraseña($clave){
          if (!preg_match('`[a-z]`',$clave)){
            
            return false;
         }
         if (!preg_match('`[A-Z]`',$clave)){
            
            return false;
         }
         if (!preg_match('`[0-9]`',$clave)){
            
            return false;
         }
         if (!preg_match('`[!#$%&*^@&_+-.]`',$clave)){
            
          return false;
         }
         return true;
        }
        $sql=$conexion->query(" select * from tbl_ms_usuarios where Usuario='$usuario' ");
        if ($datos=$sql->fetch_object()){
            echo '<div class="alert alert-danger">Este nombre de usuario ya existe</div> ';
        }else if(valcontraseña($clave)==false){ // Validación del campo del correo con @ y punto.
          echo '<br>';
          echo '<div class="alert alert-danger">La contraseña debe contener mínimo un caracter en mayúscula, minúscula, un caracter numérico y un caracter especial (!#$%&*^@&_+-.)</div>';
        }else if(testFormatoDni($_dni)==false){ // Validación del Formato DNI.
          echo '<br>';
          echo '<div class="alert alert-danger">El formato del DNI es inválido.</div>';
        }else if(fntEmailValidate($_correo)==false){ // Validación de correo.
          echo '<br>';
          echo '<div class="alert alert-danger">El correo no es válido.</div>';
        }else if(strpbrk($clave, " ")){ // Validación de espacios en blanco en el campo Contraseña.
          echo '<br>';
          echo '<div class="alert alert-danger">El campo Contraseña no puede contener espacios en blanco.</div>';
        }else{

            $rol="DEFAULT";  
            $cargo="Empleado";
            //Condicion para crear el rol por defecto de los usuarios o selecionarlo
            $sql1=$conexion->query(" select * from tbl_ms_roles where Rol='$rol' ");
            if ($datos=$sql1->fetch_object()){
              $sql2=$conexion->query(" select Id_Rol from tbl_ms_roles where Rol='$rol' ");
              $id_rol=mysqli_fetch_assoc($sql2)['Id_Rol']; // Id del rol en la BD
              $id_rol= (int) $id_rol;
              
            } 
            //Condicion para crear el cargo por defecto de los usuarios o selecionarlo
            $sql4=$conexion->query(" select * from tbl_cargos where Nombre_Cargo='$cargo' ");
            if ($datos=$sql4->fetch_object()){
              $sql5=$conexion->query(" select Id_Cargo from tbl_cargos where Nombre_Cargo='$cargo' ");
              $id_cargo=mysqli_fetch_assoc($sql5)['Id_Cargo']; // Id del cargo en la BD
              $id_cargo=(int)$id_cargo;
              
            } 
            
            $parametro="FEC_VENCIMIENTO";
            $sql3=$conexion->query("select Valor from tbl_ms_parametros where Parametro='$parametro'");
            $valor=mysqli_fetch_assoc($sql3)['Valor'];
            $valor=(string)$valor;
            $usuario=$_POST["Usuario"];
            $nombre=$_POST["Nombre"];
            $dni=$_POST["Dni"];
            $contraseña=$_POST["Clave"];

            // Función para encriptar contraseña
            function encriptar($password) {
              $Encriptada = hash('sha256', $password);
              return $Encriptada;
            }
            //Variable que almacena la contraseña encriptada
            $contrasenaEncriptada = encriptar($contraseña);

            $correo=$_POST["Email"];
            $Fec_vencimiento=date("Y-m-d",strtotime("+30 days"));
            $estado="Nuevo";
            $sql = $conexion->query("INSERT INTO tbl_ms_usuarios (Id_Rol, Id_Cargo, Usuario, Nombre, Estado, Contraseña, Fecha_vencimiento, DNI, Correo_Electronico, Fecha_creacion)
            VALUES ('$id_rol', '$id_cargo', '$usuario', '$nombre', '$estado', '$contrasenaEncriptada', '$Fec_vencimiento', '$dni', '$correo', CURRENT_TIMESTAMP())");


            if ($sql==1){
                $lastInsertedId = $conexion->insert_id;
                $sqlHistorial = $conexion->query("INSERT INTO tbl_ms_hist_contraseña (Id_Usuario, Contraseña, Fecha_creacion)
                                 VALUES ('$lastInsertedId', '$contrasenaEncriptada', CURRENT_TIMESTAMP())");
                 echo '<div class="alert alert-success">Usuario registrado correctamente</div> ';
                
                 //Bitácora
                 $sql = $conexion->query("Select id_usuario from tbl_ms_usuarios where Usuario = '$usuario';");
                 $idusuario = $sql->fetch_object();


                 //limpiar datos
                 $informacion = json_encode($idusuario, true);
                 $posicion = strpos($informacion, ":") + 2;
                 $idusuario = substr($informacion, $posicion, -2);
                 $sql = $conexion->query("Select id_objeto from tbl_objetos where Objeto = 'autoregistro';");
                 $idobjeto = $sql->fetch_object();

                 // limpiar datos 
                 $informacion = json_encode($idobjeto, true);

                 $posicion = strpos($informacion, ":") + 2;

                 $idobjeto = substr($informacion, $posicion, -2);

                 
                 $sql = $conexion->query("INSERT INTO tbl_ms_bitacora(Id_Usuario,Id_Objeto,Fecha,Accion,Descripcion) VALUES($idusuario,$idobjeto,now(),'Auto registro','Se ha auto registrado el Usuario $usuario') ");

                 
                 
              } else {
                echo '<div class="alert alert-danger">Error al ingresar al usuario</div> ';
              }

              
        }
    
      } 
  }
  
?>