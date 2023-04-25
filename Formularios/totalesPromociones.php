<?php 
    $total=0;
    $Cantidad=0;
   if (isset($_SESSION['ventaPromociones']) and count($_SESSION['ventaPromociones'])>0) {
?>
    
    <?php
    $contador=0;
    foreach($_SESSION['ventaPromociones'] as $promociones )
    {   

        $total=$total+($promociones['Precio']*$promociones['Cantidad']);
        $Cantidad=$Cantidad+$promociones['Cantidad'];
        
    ?>
       
                 
                    
                   
                   
      
    <?php 
    $contador=$contador+1;
    } ?>
                   
    <?php
    ?>
    <tr>
        <td>Total:</td>
        <td></td>
        <td><?=  $Cantidad  ?></td>
        <td></td>
        <td id="totalFila_promo"><?=  $total  ?></td>
        <td></td>
    </tr>
<?php } ?>