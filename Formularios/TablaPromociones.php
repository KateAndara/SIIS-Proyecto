<?php 



   if (isset($_SESSION['ventaPromociones']) and count($_SESSION['ventaPromociones'])>0) {
?>
    
    <?php
    $contador=0;
    foreach($_SESSION['ventaPromociones'] as $promocion )
    {   
        
    ?>
       
                  <tr>
                    <td><?= $promocion['IdPromocion']   ?></td>
                    <td><?=  $promocion['Nombre']  ?></td>
                    <td><?=  $promocion['Cantidad']  ?></td>
                    <td><?=  $promocion['Precio']  ?></td>
                    <td><?=  $promocion['Precio']*$promocion['Cantidad']  ?></td>
                   
                    <td class="text-center"><a class="link_delete" href="$" # onclick="event.preventDefault();del_product_promo('<?=  $promocion['IdPromocion']  ?>');"><i class="far fa-trash-alt" style="color:red"></i></a></td>
                    
                    </tr>
                    
                    </tr>
      
    <?php 
    $contador=$contador+1;
    } ?>
                   
    <?php
    ?>
   
<?php } ?>