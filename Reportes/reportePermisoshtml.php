<?php  
    


$modulos=$data['modulos'];
$nombreRol=$data['nombreRol'];

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <style>
      table{
          width: 100%;

      }
      table td, table th{
          font-size: 13px;
      }
      h4{
          margin-bottom: 0px;
      }
      .text-center{
          text-align: center;
      } 
      .text-right{
          text-align: right;
      }
      .wd33{
         width: 33.33% 
      }
      .tbl-cliente{
          border: 1px solid #CCC;
          border-radius: 10px;
          padding: 5px;
      }
      .wd10{
        width: 10%;   
      }
      .w5{
        width: 10px;
      }
      .wd15{
        width: 15%;   
    }
    .wd20{
        width: 19%;   
    }
      .wd38{
          width: 38%;
      }
      .wd40{
          width: 40%;
      }
      .wd45{
          width: 45%;
      }
      .wd55{
          width: 55%;
      }
      .tbl-detalle{
          border-collapse: collapse;
      }
      .tbl-detalle thead th{
          padding: 5px;
          background-color: #ae9c8f;
          color: #FFF;
      }
      .tbl-detalle tbody td{
          border-bottom: 1px solid #CCC;
          padding: 5px;
      }
      .tbl-detalle tfoot td{
          padding: 5px
      }

      .switch {
			position: relative;
			display: inline-block;
			width: 60px;
			height: 34px;
		}

		.switch input {
			opacity: 0;
			width: 0;
			height: 0;
		}

		.slider {
			position: absolute;
			cursor: pointer;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background-color: #ccc;
			-webkit-transition: .4s;
			transition: .4s;
		}

		.slider:before {
			position: absolute;
			content: "";
			height: 26px;
			width: 26px;
			left: 4px;
			bottom: 4px;
			background-color: white;
			-webkit-transition: .4s;
			transition: .4s;
		}

		input:checked+.slider {
			background-color: #2196F3;
		}

		input:focus+.slider {
			box-shadow: 0 0 1px #2196F3;
		}

		input:checked+.slider:before {
			-webkit-transform: translateX(26px);
			-ms-transform: translateX(26px);
			transform: translateX(26px);
		}

		/* Rounded sliders */
		.slider.round {
			border-radius: 34px;
		}

		.slider.round:before {
			border-radius: 50%;
		}
        
    </style>
</head>
<body>
   <table class="tbl-hader" style="margin-bottom: 50rem;">
       <tbody>
           <tr>
               <td class="wd20">
               <img src="http://localhost/SIIS-PROYECTO/img/logo.jpg" width="125" alt="Logo">
                </td>
            <td class="text-center">
                <h3><strong><?=  $data['DatosEmpresa'][0]['Valor']  ?></strong></h3><br><br>
                <h2>Permisos - <?=  $nombreRol  ?></h2>
            </td>
            
            </tr>
        </tbody>
</table>

<br>

    <input type="hidden" id="idrol" name="idrol" value="<?= $data['idrol']; ?>" required="">
        <div class="table-responsive">
          <table class="table tbl-detalle">
            <thead>
              <tr>
                <th class="wd5">#</th>
                <th class="wd20">Módulo</th>
                <th class="wd20">Ver</th>
                <th class="wd20">Crear</th>
                <th class="wd20">Actualizar</th>
                <th class="wd20">Eliminar</th>
              </tr>
            </thead>
            <tbody>
            <?php 
                    $no=1;
                    $modulos = $data['modulos'];
                    for ($i=0; $i < count($modulos); $i++) { 

                        $permisos = $modulos[$i]['permisos'];
                        $rCheck = $permisos['r'] == 1 ? " Si " : "No";
                        $wCheck = $permisos['w'] == 1 ? " Si " : "No";
                        $uCheck = $permisos['u'] == 1 ? " Si " : "No";
                        $dCheck = $permisos['d'] == 1 ? " Si " : "No";

                        $idmod = $modulos[$i]['Id_Objeto'];
                     
                    
                ?>
              <tr>
             
              <td> <?= $no; ?>
                    <input type="hidden" name="modulos[<?= $i; ?>][Id_Objeto]" value="<?= $idmod ?>" required ></td>
                <td><?=  $modulos[$i]['Objeto'];  ?></td>
                
                <td>
                <input type="text" id="unchecked" class="deschecar" name="modulos[<?= $i; ?>][r]" value=" <?= $rCheck ?>">
                </td>
              
                <td>
                 
                      <input type="text" class="selectAll" onclick="checkBoxes('modulos[<?= $i; ?>][r]')" name="modulos[<?= $i; ?>][w]" value="  <?= $wCheck ?>">
                 
                </td>
                <td>
                 
                      <input type="text" class="selectAll" onClick="checkBoxes('modulos[<?= $i; ?>][r]')" name="modulos[<?= $i; ?>][u]" value="  <?= $uCheck ?>">
                 
                </td>
                <td>
                  
                      <input type="text" class="selectAll" onClick="checkBoxes('modulos[<?= $i; ?>][r]')" name="modulos[<?= $i; ?>][d]" value=" <?= $dCheck ?>">
                 
                </td>
                
              </tr>
              <?php 
                    $no++;
                }
              ?>
            </tbody>
          </table>
        </div>
        

    
</body>
</html>