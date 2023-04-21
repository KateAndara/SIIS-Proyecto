<?php 
    $total=0;
    $Cantidad=0;
   if (isset($_SESSION['ventaDetalle']) and count($_SESSION['ventaDetalle'])>0) {
?>
    
    <?php
    $contador=0;
    foreach($_SESSION['ventaDetalle'] as $producto )
    {   

        $total=$total+($producto['Precio']*$producto['Cantidad']);
        $Cantidad=$Cantidad+$producto['Cantidad'];
        
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
        <td id="totalFila"><?=  $total  ?></td>
        <td></td>
    </tr>
<?php } ?>