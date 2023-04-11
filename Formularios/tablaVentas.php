<?php 
    
   if (isset($_SESSION['ventaDetalle']) and count($_SESSION['ventaDetalle'])>0) {
?>
    
    <?php
    $contador=0;
    foreach($_SESSION['ventaDetalle'] as $producto )
    {   
        
    ?>
       
                  <tr>
                    <td><?= $producto['Idproducto']   ?></td>
                    <td><?=  $producto['Nombreproducto']  ?></td>
                    <td><?=  $producto['Cantidad']  ?></td>
                    <td><?=  $producto['Precio']  ?></td>
                    <td class="text-center"><a class="link_delete"  href="$" # onclick="event.preventDefault();edit_product_detalle('<?=  $contador  ?>');"><i style="color:green" class="fa-solid fa-pencil"></i></a></td>
                    <td class="text-center"><a class="link_delete" href="$" # onclick="event.preventDefault();del_product_detalle('<?=  $producto['idproducto']  ?>');"><i class="far fa-trash-alt" style="color:red"></i></a></td>
                    
                    </tr>
      
    <?php 
    $contador=$contador+1;
    } ?>
                   
    <?php
    ?>
   
<?php } ?>