<?php

    
?>


              <form action="" id="formPermisos" name="formPermisos">
                <input type="hidden" id="idrol" name="idrol" value="<?= $data['idrol']; ?>" required="">
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Módulo</th>
                            <th>Ver</th>
                            <th>Crear</th>
                            <th>Actualizar</th>
                            <th>Eliminar</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                                $no=1;
                                $modulos = $data['modulos'];
                                for ($i=0; $i < count($modulos); $i++) { 

                                    $permisos = $modulos[$i]['permisos'];
                                    $rCheck = $permisos['r'] == 1 ? " checked " : "";
                                    $wCheck = $permisos['w'] == 1 ? " checked " : "";
                                    $uCheck = $permisos['u'] == 1 ? " checked " : "";
                                    $dCheck = $permisos['d'] == 1 ? " checked " : "";

                                    $idmod = $modulos[$i]['Id_Objeto'];
                                 
                            ?>
                          <tr>
                         
                          <td> <?= $no; ?>
                                <input type="hidden" name="modulos[<?= $i; ?>][Id_Objeto]" value="<?= $idmod ?>" required ></td>
                            <td><?=  $modulos[$i]['Objeto'];  ?></td>
                            
                            <td>
                              <div class="slideThree">
                                <label class="switch">
                                  <input type="checkbox" id="unchecked" class="deschecar" name="modulos[<?= $i; ?>][r]" <?= $rCheck ?>><span class="slider round" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                </label>
                              </div>
                            </td>
                             <!-- Codigo para solo mostrar leer en calendario -->
                             <?php
                            //if ($idmod==7) {
                              //break;
                             //}
                            ?> 
                            <td>
                              <div class="slideThree">
                                <label class="switch">
                                  <input type="checkbox" class="selectAll" onclick="checkBoxes('modulos[<?= $i; ?>][r]')" name="modulos[<?= $i; ?>][w]" <?= $wCheck ?>><span class="slider round" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                </label>
                              </div>
                            </td>
                            <td>
                              <div class="slideThree">
                                <label class="switch">
                                  <input type="checkbox" class="selectAll" onClick="checkBoxes('modulos[<?= $i; ?>][r]')" name="modulos[<?= $i; ?>][u]" <?= $uCheck ?>><span class="slider round" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                </label>
                              </div>
                            </td>
                            <td>
                              <div class="slideThree">
                                <label class="switch">
                                  <input type="checkbox" class="selectAll" onClick="checkBoxes('modulos[<?= $i; ?>][r]')" name="modulos[<?= $i; ?>][d]" <?= $dCheck ?>><span class="slider round" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                </label>
                              </div>
                            </td>
                            
                          </tr>
                          <?php 
                                $no++;
                            }
                          ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="text-center mb-4">
                        <a class="btn btn-success" id="Gurdar" onclick="gurdarPermisos()" ><i class="fa fa-fw fa-lg fa-check-circle" aria-hidden="true"></i> Guardar</a>
                        <a class="btn btn-danger" type="button" href="Roles.php"><i class="app-menu__icon fas fa-sign-out-alt" aria-hidden="true"></i> Salir</a>
                    </div>
                </form>