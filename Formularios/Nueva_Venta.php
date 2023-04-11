<?php 
include '../components/header.components.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Venta</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../JS/Ventas.js"></script>
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css
" rel="stylesheet">

<style>
        .item1 {
            display: none;
            }
</style>
</head>
<body>
    <div class="col-md-12 cards-white" style="margin: 0 auto; width: 110%; max-width: none; margin-left: -20px;">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" id="nav1" data-toggle="tab" href="#pestaña1" style="color:black">Datos del Cliente</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="nav2"  data-toggle="tab" href="#pestaña2" style="color:black">Detalle de venta</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="nav3" data-toggle="tab" href="#pestaña3" style="color:black">Promociones del Producto</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="nav4" data-toggle="tab" href="#pestaña4" style="color:black">Descuentos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="nav5"  href="#pestaña5" style="color:black">Total de la venta</a>
            </li>
        </ul>

        <div class="tab-content">
            <div id="pestaña1" class="tab-pane fade show active">
                <!-- Aquí va el formulario original -->
                <div id="pestaña1" class="tab-pane fade show active">
                    <div class="Formulario">
                        <div class="row">
                            <div class="Col-12" id="titulo">
                                <h3>
                                    Datos del Cliente
                                </h3>
                            </div>
                            <div class="col-6">
                                <form class="InsertCliente">
                                    <label for="">NOMBRE DEL CLIENTE</label> 
                                    <input type="text" id="Nombre" name="Nombre" class="form-control" placeholder="Roberto...">
                                    <label for="Fecha">FECHA DE NACIMIENTO</label>
                                    <input type="date" id="FechaNacimiento" name="FechaNacimiento" class="form-control" pattern="\d{4}/\d{2}/\d{2}">
                                    <label for="">DNI DEL CLIENTE</label>
                                    <input type="number" id="Dni" name="Dni" class="form-control" placeholder="0000-0000-000000">
                                    <hr>
                                    <div id="btnagregarNuevoCliente">
                                        <input type="button" id="btnCancelar" onclick="Cancelar()" value="Cancelar" class="btn btn-danger">
                                        <input type="button" id="btnagregarNuevoCliente" onclick="siguiente1()" value="Siguiente" class="btn btn-success">
                                    </div>
                                    <hr>
                                    <div class="row">
                                    <label for="">DESCUENTO: </label> 
                                    </div> 
                                    <div class="row">
                                    <label for="">SUBTOTAL: </label>
                                    </div>
                                    <div class="row">
                                    <label for="">IMPUESTO: </label>
                                    </div>
                                    <div class="row">
                                    <label for="">TOTAL: </label>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="pestaña2" class="tab-pane fade">
                <!-- Aquí va el contenido de la segunda pestaña -->
                <div class="Formulario">
                    <div class="row">
                        <div class="Col-12" id="titulo">
                            <h3>
                                Agregar Detalle de la Venta
                            </h3>
                        </div>
                        <div class="col-12">
                            <form class="InsertDetalleVenta" id="FormDetalle">
                                <label for="">SELECCIONE UN PRODUCTO</label> 
                                <select id="Select_Producto" name="Select_Producto" class="form-control">
                                    <option value="">Seleccione un producto</option>
                                    
                                </select>
                                <label for="">CANTIDAD</label>
                                <input type="number" id="Cantidad" name="Cantidad" class="form-control" placeholder="Ingrese ingrese la cantidad del producto">
                                <label for="">PRECIO </label>
                                <input type="number" id="Precio"  name="Precio"  class="form-control" placeholder="Ingrese ingrese el precio por libra">
                                <hr>
                                <div id="btnagregarDetalleVenta">
                                    <input type="submit" id="btnagregarDetalle"  value="Agregar" class="btn btn-info">
                                    <input type="button" id="btnAtras" onclick="atras1()" value="Atras" class="btn btn-warning mr-2">
                                        <input type="button" id="btnAvanzar" onclick="siguiente2()" value="Siguiente" class="btn btn-success">
                                </div>
                                <div class="box-body">
                                     <div class="table table-responsive">
                                       <table class="table table-hover" id="Tabla">
                                         <thead>
                                            <tr>
                                               
                                               <th>PRODUCTO</th>
                                               <th>CANTIDAD</th>
                                               <th>PRECIO</th>
                                               <th>OPCIONES</th>
                                            </tr>
                                         </thead>

                                         <tbody id="TableDetalle">
                                               <tr>
                                                  
                                                  <td></td>
                                                  <td></td>
                                                  <td></td>
                                                  <td>
                                                     
                                                  </td>
                                               </tr>
                                         </tbody>
                                         <tfoot>
                                            <tr>
                                               <th>TOTAL</th>
                                               <th id="CantTotal" ></th>
                                               <th id="PrecTotal" ></th>
                                               <th></th>
                                             </tr>
                                         </tfoot>
                                       </table>
                                       
                                    </div>
                                 </div>
                                 <script>
                                    const form = document.getElementById("FormDetalle");
                                    form.addEventListener("submit", function(event) {
                                      event.preventDefault();  
                                      let detalleFormData = new FormData(form);
                                      insertDetalleRow(detalleFormData);
                                      sumtotal();

                                      function insertDetalleRow(detalleFormData){
                                        let DetalleTableref = document.getElementById("TableDetalle");
                                        let newDetallerow = DetalleTableref.insertRow(-1);
                                    
                                        let newDetalleCellRef = newDetallerow.insertCell(0);
                                        newDetalleCellRef.textContent = detalleFormData.get("Select_Producto")
                                      
                                        newDetalleCellRef = newDetallerow.insertCell(1);
                                        newDetalleCellRef.textContent = detalleFormData.get("Cantidad")
 
                                        newDetalleCellRef = newDetallerow.insertCell(2);
                                        newDetalleCellRef.textContent = detalleFormData.get("Precio")

                                        newDetalleCellRef = newDetallerow.insertCell(3);
                                        newDetalleCellRef.ob_flush = "<button >" 

                                        

                                      }
                                      
                                      function sumtotal(){
                                        let CantTotal = 0;
                                        let PrecTotal = 0;
                                        const table = document.getElementById("Tabla");
                                        for (let i=1; i<table.rows.length-1; i++ ){
                                            let rowCantidad = table.rows[i].cells[1].innerHTML;
                                            let rowPrecio = table.rows[i].cells[2].innerHTML;
                                            CantTotal= CantTotal + Number(rowCantidad);
                                            PrecTotal= PrecTotal + Number(rowPrecio);
                                        }
                                        const CantidadTotal = document.getElementById("CantTotal");
                                        CantidadTotal.textContent = CantTotal;

                                        const PrecioTotal = document.getElementById("PrecTotal");
                                        PrecioTotal.textContent = PrecTotal;
                                      }
 
                                    })
                                 </script>  
                                 
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="pestaña3" class="tab-pane fade">
                <!-- Aquí va el contenido de la tercera pestaña -->
                <div class="Formulario">
                    <div class="row">
                        <div class="Col-12" id="titulo">
                            <h3>
                                Agregar Promociones 
                            </h3>
                        </div>
                        <div class="col-12">
                            <form class="Insertpromociones">
                                <label for="">SELECCIONE UNA PROMOCION</label> 
                                <select id="Select_Promocion"  name="Select_Promocion" class="form-control">
                                    <option value="">Seleccione una promocion</option>

                                </select>
                                <label for=""><P>Nuevo Precio de Venta</P></label>
                                <input type="number" id="PrecioV" name="PrecioV" class="form-control" placeholder="Precio...">
                                <hr>
                                <div id="btnagregarPromocion">
                                    <input type="submit" id="btnagregarPromocion" onclick="" value="Agregar" class="btn btn-info">
                                    <input type="button" id="btnAtras" onclick="atras2()" value="Atras" class="btn btn-warning mr-2">
                                    <input type="button" id="btnAvanzar" onclick="siguiente3()" value="Siguiente" class="btn btn-success">
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="pestaña4" class="tab-pane fade">
                <!-- Aquí va el contenido de la cuarta pestaña -->
                <div class="Formulario">
                    <div class="row">
                        <div class="Col-12" id="titulo">
                            <h3>
                                Agregar Descuentos 
                            </h3>
                        </div>
                        <div class="col-12">
                            <form class="InsertDescuento">
                                <label for="">SELECCIONE UN DESCUENTO</label> 
                                <select id="Select_Descuento" name="Select_Descuento" class="form-control">
                                    <option value="">Seleccione un descuento</option>
                                </select>
                                <label for=""><P>PORCENTAJE DEL DESCUENTO</P></label>
                                <input type="number" id="Porcentaje" name="Porcentaje" class="form-control" placeholder="Porcentaje...">
                                <label for="">TOTAL DESCONTADO </label>
                                <input type="number" id="Total descontado" name="Total descontado" class="form-control" placeholder="Total descontado...">
                                <hr>
                                <div id="btnagregarDescuento">
                                    <input type="submit" id="btnagregarDescuento" onclick="AgregarDescuento()" value="Agregar" class="btn btn-success">
                                    <input type="button" id="btnAtras" onclick="atras3()" value="Atras" class="btn btn-warning mr-2">
                                    <input type="button" id="btnAvanzar" onclick="siguiente4()" value="Siguiente" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="pestaña5" class="tab-pane fade">
                <!-- Aquí va el contenido de la quinta pestaña -->
                <div class="Formulario">
                    <div class="row">
                        <div class="Col-12" id="titulo">
                            <h3>
                                Agregar Venta
                            </h3>
                        </div>
                        <div class="col-12">
                            <form class="InsertVenta">
                                <label for="">ESTADO DE VENTA</label> 
                                <select id="Select_Estado" name="Select_Estado" class="form-control">
                                    <option value="">Seleccione un estado de venta</option>
                                </select>
                                <label for=""><P>SUBTOTAL</P></label>
                                <input type="number" id="Subtotal" class="form-control" onkeyup="calcularTotal()" placeholder="Subtotal...">
                                <label for=""><P>IMPUESTO</P></label>
                                <input type="number" id="Impuesto" class="form-control" onkeyup="calcularTotal()" placeholder="Impuesto...">
                                <label for="">TOTAL</label>
                                <input type="number" id="Total" class="form-control" placeholder="Total...">
                                <hr>
                                <div id="btnagregarVenta">
                                    <input type="button" id="btnAtras" onclick="atras4()" value="Atras" class="btn btn-warning mr-2">
                                    <input type="submit" id="btnagregarVenta" onclick="AgregarVenta()" value="Agregar" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
      

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js
"></script>
</body>
</html>
