<?php  
    
    $Compra=$data['Compra'];
    $DetalleCompra=$data['DetalleCompra'];

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
        width: 14.3%;   
      }
      .wd11{
        width: 10%;   
      }
      .wd15{
        width: 15%;   
    }
    .wd20{
        width: 20%;   
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
                <h2>Ficha de compra</h2>
            </td>
            <td class="text-right wd14">
            <h4>No. Compra: <strong><?= $Compra['Id_Compra'] ?></strong><br>
            
                </h4>
            </td>
            </tr>
        </tbody>
</table>
<table class="tbl-cliente">
  <tbody>
  <tr>
          <td>Proveedor:</td>
          <td><?= $Compra['nombreProveedor'] ?></td>
          <td>Fecha Compra:</td>
          <td><?= $Compra['Fecha_compra']?></td>
      </tr>
      <tr>
          <td class="wd11">Total:</td>
          <td class="wd40"><?= $Compra['Total']?></td>
          <td class="wd11">Observación:</td>
          <td class="wd40"><?= $Compra['Observacion']?></td>
      </tr>
  </tbody>
</table>
<br>
<table class="tbl-detalle">
   <thead>
       <tr>
           <th class="wd13 text-center">Nombre</th>
           <th class="wd13 text-center">Cantidad</th>
           <th class="wd13 text-right">Precio</th>
           <th class="wd13 text-right">Especie</th>
           <th class="wd13 text-right">Peso Vivo</th>
           <th class="wd13 text-right">Canal</th>
          <th class="wd13 text-right">Rendimiento</th> 

       </tr>
   </thead>
   <tbody>
       <?php
        $subtotal = 0;
        foreach ($DetalleCompra as $producto){
        /*  $importe = $producto['PRECIO'] * $producto['CANTIDAD'];
         $subtotal = $subtotal + $importe; */
       ?>
       <tr>
           <td class="wd10 text-center"><?=' '.($producto['Nombre']) ?></td>
           <td class="wd10 text-center"><?= $producto['Cantidad']?></td>
           <td class="wd10 text-right"><?='L. '. $producto['Precio_libra'] ?></td>
           <td class="wd10 text-right"><?=' '. $producto[0]['Especie'] ?></td>
           <td class="wd10 text-right"><?=' '. $producto[0]['Peso_vivo'] ?></td>
           <td class="wd10 text-right"><?=' '. $producto[0]['Canal'] ?></td>
           <td class="wd10 text-right"><?=' '. $producto[0]['Rendimiento'] ?></td> 


       </tr>
       <?php } ?>
   </tbody>
 
</table>
    
</body>
</html>