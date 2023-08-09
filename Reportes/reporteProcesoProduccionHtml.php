<?php  
    
    $Proceso=$data['Proceso'];
    $productoMP=$data['ProductosMP'];
    $productoFinal=$data['ProductosFinal'];

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
      
      .tbl-fecha{
          border: 1px solid #CCC;
          border-radius: 10px;
          padding: 5px;
      }
      .wd10{
        width: 50%;   
      }
      .wd15{
        width: 50%;   
    }
    .wd20{
        width: 20%;   
    }
      .tbl-productos{
          border-collapse: collapse;
      }
      .tbl-productos thead th{
          padding: 5px;
          background-color: #ae9c8f;
          color: #FFF;
      }
      .tbl-productos tbody td{
          border-bottom: 1px solid #CCC;
          padding: 5px;
      }
      .tbl-productos tfoot td{
          padding: 5px
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
                <h4><strong><?=  $data['DatosEmpresa'][0]['Valor']  ?></strong></h4>
                <br>
                <h4><strong>FICHA DE PROCESO DE PRODUCCION</strong></h4>
                
            </td>
            <td class="text-right wd20">
            <h4>No. Proceso: <strong><?= $Proceso['Id_Proceso_Produccion'] ?></strong><br>
            
                </h4>
            </td>
            </tr>
        </tbody>
</table>
<table class="tbl-fecha">
  <tbody>
  <tr>
          <td>Fecha Proceso:</td>
          <td><?= date('d-m-Y', strtotime($Proceso['Fecha'])) ?></td>
      </tr>
      
  </tbody>
</table>
<br>
<div class="table-title" style="text-align:center;">
        <h4 style="color: black;">Materia Prima</h4>
</div>
<table class="tbl-productos">
   <thead>
       <tr>
           <th class="wd15 text-center">Nombre</th>
           <th class="wd10 text-center">Cantidad</th>
          <!--  <th class="wd10 text-right">Rendimiento</th> -->
       </tr>
   </thead>
   <tbody>
       <?php
        foreach ($productoMP as $producto){
        /*  $importe = $producto['PRECIO'] * $producto['CANTIDAD'];
         $subtotal = $subtotal + $importe; */
       ?>
       <tr>
           <td class="wd15 text-center"><?=' '.($producto['Nombre']) ?></td>
           <td class="wd10 text-center"><?= $producto['Cantidad']?></td>
       </tr>
       <?php } ?>
   </tbody>
 
</table>

<br>
<div class="table-title" style="text-align:center;">
        <h4 style="color: black;">Productos Terminados</h4>
</div>
<table class="tbl-productos">
   <thead>
       <tr>
           <th class="wd15 text-center">Nombre</th>
           <th class="wd10 text-center">Cantidad</th>
          <!--  <th class="wd10 text-right">Rendimiento</th> -->
       </tr>
   </thead>
   <tbody>
       <?php
        foreach ($productoFinal as $producto){
        /*  $importe = $producto['PRECIO'] * $producto['CANTIDAD'];
         $subtotal = $subtotal + $importe; */
       ?>
       <tr>
           <td class="wd15 text-center"><?=' '.($producto['Nombre']) ?></td>
           <td class="wd10 text-center"><?= $producto['Cantidad']?></td>
       </tr>
       <?php } ?>
   </tbody>
 
</table>
    
</body>
</html>