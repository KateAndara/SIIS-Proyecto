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
                   
                    <td class="text-center">
                    <select name="selectPromo" id="selectPromo" onchange="changePromocion(this,<?=$producto['Id_Producto']?>)" style="width: 100%">
                        <option value="0">Sin Promoción</option>
                        <?php 

                            foreach($producto['promociones'] as $promociones)
                            {
                                 
                                 
                                 ?>
                            <option  class="form-control" <?php
                          (isset($data['producto']['idPromo']) && $promociones['Id_Promocion']==$data['producto']['idPromo']) ? print "Selected": print "b" ;
                            ?> value="<?=  $promociones['Id_Promocion']  ?>"><?=  $promociones['Nombre_Promocion']  ?></option>
                            <?php
                            }

                        ?>
                    </select>
                    </td>
                    
                    </tr>
      
    <?php 
    $contador=$contador+1;
    } ?>
                   
    <?php
    ?>
   
<?php } ?>