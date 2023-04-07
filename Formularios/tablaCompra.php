<?php 
    
   if (isset($_SESSION['compraDetalle']) and count($_SESSION['compraDetalle'])>0) {
?>
    
    <?php
    $contador=0;
    foreach($_SESSION['compraDetalle'] as $producto )
    {   
        
    ?>
       
                  <tr>
                    <td><?= $producto['idproducto']   ?></td>
                    <td><?=  $producto['nombre']  ?></td>
                    <td><?=  $producto['cantidad']  ?></td>
                    <td><?=  $producto['precio']  ?></td>
                    <td class="text-center"><a class="link_delete"  href="$" # onclick="event.preventDefault();edit_product_detalle('<?=  $contador  ?>');"><i style="color:green" class="fa-solid fa-pencil"></i></a></td>
                    <td class="text-center"><a class="link_delete" href="$" # onclick="event.preventDefault();del_product_detalle('<?=  $producto['idproducto']  ?>');"><i class="far fa-trash-alt" style="color:red"></i></a></td>
                    
                    </tr>
      
    <?php 
    $contador=$contador+1;
    } ?>

    <?php
    ?>
   
<?php } ?>

