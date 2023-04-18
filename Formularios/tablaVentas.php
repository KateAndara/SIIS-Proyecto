<?php 
    
   if (isset($_SESSION['ventaDetalle']) and count($_SESSION['ventaDetalle'])>0) {
?>
    
    <?php
    $contador=0;
    foreach($_SESSION['ventaDetalle'] as $producto )
    {   
        
    ?>
       
                  <tr>
                    <td><?= $producto['Id_Producto']   ?></td>
                    <td><?=  $producto['Nombre']  ?></td>
                    <td><?=  $producto['Cantidad']  ?></td>
                    <td><?=  $producto['Precio']  ?></td>
                    <td><?=  $producto['Precio']*$producto['Cantidad']  ?></td>
                   
                    <td class="text-center"><a class="link_delete" href="$" # onclick="event.preventDefault();del_product_detalle('<?=  $producto['Id_Producto']  ?>');"><i class="far fa-trash-alt" style="color:red"></i></a></td>
                    
                    </tr>
      
    <?php 
    $contador=$contador+1;
    } ?>
                   
    <?php
    ?>
   
<?php } ?>