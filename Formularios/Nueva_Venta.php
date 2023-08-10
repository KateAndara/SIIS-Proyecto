<?php 
include '../components/header.components.php';
//unset($_SESSION['ventaDetalle']);
function getModal(string $nameModal, $data)
{
  $view_modal = "{$nameModal}.php";
  require_once $view_modal;
}
$data='';
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

    <link href="../CSS/styleF.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>
        .item1 {
            display: none;
            }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
    <div class="col-md-12 cards-white" style="margin: 0 auto; width: 110%; max-width: none; margin-left: -20px; border: 1px solid black;">
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
                <a class="nav-link" id="nav5" data-toggle="tab" href="#pestaña5" style="color:black">Total de la venta</a>
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
            
                                    <label for="">SELECCIONE UN CLIENTE</label> 
                                <select id="Select_Cliente" readonly name="Select_Cliente" onchange="changeCliente()" class="form-control js-example-basic-single">
                                    <!-- <option value="">Seleccione un producto</option> -->
                                    
                                </select>
                                    <label for="Fecha">FECHA DE NACIMIENTO</label>
                                    <input type="date" id="FechaNacimiento" readonly name="FechaNacimiento" class="form-control" pattern="\d{4}/\d{2}/\d{2}">
                                    <label for="">DNI DEL CLIENTE</label>
                                    <input type="number"  readonly id="Dni" name="Dni" class="form-control" placeholder="0000-0000-000000">
                                    <hr>
                                    <div id="btnagregarNuevoCliente">
                                        <input type="button" id="btnCancelar" onclick="Cancelar()" value="Cancelar" class="btn btn-danger">
                                        <a type="button" id="btnagregarNuevoCliente" onclick="siguiente1()"  value="Siguiente" style="color:white" class="btn btn-success">Siguiente <i class="bi bi-arrow-right-circle"></i></a>
                                    </div>
                                    <hr>
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
                                <br>

                                <select id="Select_Producto" name="Select_Producto" onchange="changeProducto()" style="width: 100%" class="form-control js-example-basic-single">
                                    <!-- <option value="">Seleccione un producto</option> -->
                                    
                                </select>
                                <br>
                                <label for="">PRECIO </label>
                                <input type="number" id="Precio" readonly  name="Precio"  class="form-control" placeholder="Ingrese ingrese el precio por libra">
                                <label for="">CANTIDAD</label>
                                <input type="number" id="Cantidad" name="Cantidad" class="form-control" placeholder="Ingrese ingrese la cantidad del producto">
                           
                                    <!-- <option value="">Seleccione un producto</option> -->
                                    
                                </select>
                          <hr>
                                <div id="btnagregarDetalleVenta">
                                    <input type="submit" id="btnagregarDetalle"  value="Agregar" class="btn btn-info" onclick="AgregarDetalleVenta()">
                                    <input type="button" id="btnAtras" onclick="atras1()" value="Atras" class="btn btn-warning mr-2">
                                    <a type="button" id="btnagregarNuevoCliente" onclick="siguiente2()"  value="Siguiente" style="color:white" class="btn btn-success">Siguiente <i class="bi bi-arrow-right-circle"></i></a>
                                </div>
                                <div class="box-body">
                                <div class="card-body table-responsive mt-4" id="tableVenta">
                                <table  class="table table-hover text-nowrap">
                                    <thead class="thead-dark">
                                       
                                        <tr>
                                            <th style="width: 100px">Código</th>
                                            <th style="width: 400px">Nombre</th>
                                            <th style="width: 100px">Cantidad</th>
                                            <th style="width: 100px">Precio</th>
                                            <th style="width: 100px">Total</th>
                                           
                                            <th style="text-align-last:center">Eliminar</th>

                                        </tr>
                                    </thead>
                                    <tbody id="tablaVenta">
                                    <?=  getModal("tablaVentas",$data)  ?>
                                    </tbody>
                                    <tfoot class="thead-dark font-weight-bold" style="background-color: darkseagreen;" id="detalle_totales">
                                <?=  getModal("tablaTotales",$data)  ?>
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
                                        newDetalleCellRef.textContent = $('select[name="Select_Producto"] option:selected').text()
                                      
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
               
                <div class="Formulario">
                    <div class="row">
                        <div class="Col-12" id="titulo">
                            <h3>
                                Agregar Promociones 
                            </h3>
                        </div>
                        <form class="InsertDetalleVenta" id="formPromociones">
                            <div class="mb-4">
                            <label for="">SELECCIONE UNA PROMOCIÓN</label> 
                                <br>

                                <select id="Select_Promocion" name="Select_Promocion" onchange="changePromo()" style="width: 100%" class="form-control js-example-basic-single">
                                    <!-- <option value="">Seleccione un producto</option> -->
                                    
                                </select>

                                <label for="">CANTIDAD PROMOCIONES</label>
                                <input type="number" id="cantidadPromociones" name="cantidadPromociones" class="form-control" placeholder="Ingrese ingrese la cantidad del producto">

                                <label for="">PRECIO PROMOCION</label>
                                <input type="number" id="precioPromocion" readonly  name="precioPromocion"  class="form-control" >

                            </div>
                        
                                <div id="btnagregarDetalleVenta">
                                    <a  id=""  value="Agregar" class="btn btn-info" onclick="agregarPromoción()">Agregar</a>
                                    <input type="button" id="btnAtras" onclick="atras2()" value="Atras" class="btn btn-warning mr-2">
                                    <a type="button" id="btnagregarNuevoCliente" onclick="siguiente3()"  value="Siguiente" style="color:white" class="btn btn-success">Siguiente <i class="bi bi-arrow-right-circle"></i></a>
                                </div>
                        <div class="col-12">
                        <div class="card-body table-responsive mt-4" id="tableVenta">
                                <table  class="table table-hover text-nowrap">
                                    <thead class="thead-dark">
                                       
                                        <tr>
                                            <th style="width: 100px">Código</th>
                                            <th style="width: 400px">Nombre</th>
                                            <th style="width: 100px">Cantidad</th>
                                            <th style="width: 100px">Precio</th>
                                            <th style="width: 100px">Total</th>
                                           
                                            <th style="text-align-last:center">Promoción</th>

                                        </tr>
                                    </thead>
                                    <tbody id="tablaVenta2">
                                    <?=  getModal("tablaPromociones",$data)  ?>
                                    </tbody>
                                    <tfoot class="thead-dark font-weight-bold" style="background-color: darkseagreen;" id="detalle_totales2">
                                <?=  getModal("totalesPromociones",$data)  ?>
                                </tfoot>
                            
                                    
                                </table>
                            </div>
                        </div>
                        </form>
                       
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
                                <select id="Select_Descuento" onchange="changeDescuento();" name="Select_Descuento" class="form-control">
                                    <option value="">Seleccione un descuento</option>
                                </select>
                                <label for=""><P>PORCENTAJE DEL DESCUENTO</P></label>
                                <input type="text" readonly id="Porcentaje" value="0" name="Porcentaje" class="form-control" placeholder="Porcentaje...">
                                <label for="">Total Detalle Venta </label>
                                <input type="text" readonly id="totalDetalle" name="Total descontado" class="form-control" placeholder="">
                                <label for="">TOTAL DESCONTADO </label>
                                <input type="text" readonly id="Totaldescontado" value="0" name="Total descontado" class="form-control" placeholder="Total descontado...">
                                <label for="">Subtotal </label>
                                <input type="text" readonly id="SubtotalDescuento" name="Total descontado" class="form-control" placeholder="">
                                <hr>
                                <div id="btnagregarDescuento">
                                  <!--   <input type="submit" id="btnagregarDescuento" onclick="AgregarDescuento()" value="Agregar" class="btn btn-success"> -->
                                    <input type="button" id="btnAtras" onclick="atras3()" value="Atras" class="btn btn-warning mr-2">
                                    <a type="button" id="btnagregarNuevoCliente" onclick="siguiente4()"  value="Siguiente" style="color:white" class="btn btn-success">Siguiente <i class="bi bi-arrow-right-circle"></i></a>
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
                              <div class="row">
                                <div class="col-6">
                                    <label for="">ESTADO DE VENTA</label> 
                                    <select id="Select_Estado" name="Select_Estado" class="form-control">
                                        <option value="">Seleccione un estado de venta</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                  <label for="">SUBTOTAL</label>
                                  <input type="number" readonly id="Subtotal" class="form-control" onkeyup="calcularTotal()" placeholder="Subtotal...">
                                </div>
                             </div> 
                                <br>
                             <div class="row">
                                <div class="col-6">
                                   <label for="" id="labelImpuesto">IMPUESTO</label>
                                   <input type="text" readonly onkeypress="calcularTotal()"; id="Impuesto" class="form-control" onkeyup="calcularTotal()" placeholder="Impuesto...">
                                </div>
                                <div class="col-6">
                                    <label for="RTN">RTN</label>
                                    <input type="number" id="RTN" class="form-control" placeholder="ejem: 08011990100114" maxlength="14" oninput="this.value = this.value.replace(/[^0-9]/g, ''); if(this.value.length > 14) this.value = this.value.slice(0, 14);">
                                    <small id="rtnValidationMessage" class="text-danger"></small>
                                </div>
                                <script>
                                    const rtnInput = document.getElementById("RTN");
                                    const validationMessage = document.getElementById("rtnValidationMessage");

                                    rtnInput.addEventListener("input", function() {
                                        if (rtnInput.value.length !== 14) {
                                            validationMessage.textContent = "El RTN debe tener exactamente 14 dígitos numéricos.";
                                        } else {
                                            validationMessage.textContent = "";
                                        }
                                    });
                                </script>
                             </div>   
                                <br>
                             <div class="row align-items-end">   
                                <div class="col-6">
                                   <label for="">TOTAL</label>
                                   <input type="number" id="Total" class="form-control" placeholder="Total...">
                                </div>   
                                <div class="col-6">
                                  
                                   <a onclick="event.preventDefault();CalcularImpuesto();" class="btn btn-success" style="color:white;"> Calcular Impuesto</a>
                                </div>   
                             </div>   
                                <hr>
                                <input type="hidden" id="idTalonario">
                                <input type="hidden" id="valorActualTalonario">
                                <label for="">NUMERO DE FACTURA</label>
                                <div class="row">
                                  <div class="col-4">
                                    <input type="button" onclick="generarFactura()" id="GenerarFactura" value="Generar Factura" class="btn btn-secondary">      
                                  </div>
                                  <div class="col-4">
                                    <input type="text" readonly id="Numero_factura" class="form-control" placeholder="Factura...">
                                  </div>
                                </div>
                                <hr>
                                <div >
                                    <input type="button" id="btnAtras" onclick="atras4()" value="Atras" class="btn btn-warning mr-2">
                                    <a id="btnagregarVenta" disabled onclick="agregarVenta()" value="Finalizar Venta" class="btn btn-info">Finalizar Venta</a>
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
