<?php  
    
$venta=$data['Venta'];
$detalle=$data['detalle'];
$descuento=$data['descuento'];
?>
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
               <td class="wd15">
               <img src="http://localhost/SIIS-PROYECTO/img/logo.jpg" width="125" alt="Logo">
                </td>
            <td class="text-center">
                <h3><strong><?=  $data['DatosEmpresa'][0]['Valor']  ?></strong></h3><br><br>
                <h2>Ficha de Venta</h2>
            </td>
            <td class="text-right wd14">
            <h4>No. Venta: <strong><?= $venta['Id_Venta'] ?></strong><br>
            
                </h4>
                <p>
                    Fecha: <?= $venta['Fecha'] ?> <br>
                    Estado: <?= $venta['Nombre_estado'] ?> <br>
                    Realizada Por: <?= $venta['Usuario'] ?> <br>
                   
                </p>
            </td>
            </tr>
        </tbody>
</table>
<table class="tbl-cliente">
  <tbody>
  <tr>
          <td>Nombre:</td>
          <td><?= $venta['Nombre']."          "?></td>
          
          <br><td></td>
          <br><td></td>
          <br><td></td>
          <td>RTN:</td>
          
          <td><?= $venta['RTN']?></td>
      </tr>
      <!-- <tr>
          <td class="wd10">Email:</td>
          <td class="wd40"><?= $cliente['EMAIL']?></td>
          <td class="wd10">Teléfono:</td>
          <td class="wd40"><?= $cliente['TELEFONO']?></td>
      </tr> -->
  </tbody>
</table>
<br>
<table class="tbl-detalle">
   <thead>
       <tr>
           <th class="wd55">Producto</th>
           <th class="wd15 text-right">Precio</th>
           <th class="wd15 text-center">Cantidad</th>
           <th class="wd15 text-right">Importe</th>
       </tr>
   </thead>
   <tbody>
       <?php
        $subtotal = 0;
        foreach ($detalle as $producto){
         $importe = $producto['Precio'] * $producto['Cantidad'];
         $subtotal = $subtotal + $importe;
       ?>
       <tr>
           <td><?= $producto['Nombre']?></td>
           <td class="wd15 text-right"><?='L. '.($producto['Precio']) ?></td>
           <td class="wd15 text-center"><?= $producto['Cantidad']?></td>
           <td class="wd15 text-right"><?='L. '.$importe ?></td>
       </tr>
       <?php } ?>
   </tbody>
   <tfoot>
      <tr>
          <td colspan="3" class="wd15 text-right" >Subtotal:</td>
          <td class="wd15 text-right"><?='L. '.$subtotal ?></td>
      </tr> 
      <tr>
          <td colspan="3" class="wd15 text-right">Descuento <?=  $descuento['Nombre_descuento']  ?>:</td>
          <td class="wd15 text-right"><?= $descuento['Total_descuento']?></td>
      </tr> 
      <tr>
          <td colspan="3" class="wd15 text-right">Impuesto:</td>
          <td class="wd15 text-right"><?= $venta['Impuesto']?></td>
      </tr> 
      <tr>
          <td colspan="3" class="wd15 text-right"><strong> Total:</strong></td>
          <td class="wd15 text-right"><strong><?= $venta['Total']?></strong></td>
      </tr> 
      
   </tfoot>
 
</table>
    <div class="text-center">
    <p>
        Si tienes preguntas sobre tu pedido, <br>pongase en contacto con nombre, teléfono y Email</p>
        <h4>¡Gracias por tu compra!</h4>
    </div>
</body>
</html>