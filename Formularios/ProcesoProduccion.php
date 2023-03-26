<?php 
include '../components/header.components.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proceso de producción</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../JS/ProcesoProduccion.js"></script>
</head>
<body>
    <div class="col-md-12 cards-white" style="margin: 0 auto; width: 110%; max-width: none; margin-left: -20px;">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#pestaña1" style="color:black">Inicio de proceso</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#pestaña2" style="color:black">Materia prima</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#pestaña3" style="color:black">Producto terminado</a>
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
                                    Proceso de Producción
                                </h3>
                            </div>
                            <div class="col-12">
                                <form class="InsertProcesoProduccion">
                                    <label for="">SELECCIONE EL ESTADO DEL PROCESO</label> 
                                    <select id="Select_Estados_Proceso" class="form-control">
                                        <option value="">Seleccione un estado</option>
                                    </select>
                                    <label for="Fecha">FECHA</label>
                                    <input type="date" id="Fecha" class="form-control" pattern="\d{4}/\d{2}/\d{2}">
                                    <hr>
                                    <div id="btnagregarProcesoProduccion">
                                        <input type="submit" id="btnagregar" onclick="AgregarProcesoProduccion()" value="Siguiente" class="btn btn-success">
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
                                Agregar Producto Terminado de Materia Prima
                            </h3>
                        </div>
                        <div class="col-12">
                            <form class="InsertProductoTerminado">
                                <label for="">SELECCIONE UN PRODUCTO</label> 
                                <select id="Select_Producto" class="form-control">
                                    <option value="">Seleccione un producto</option>
                                </select>
                                <label for="">ID PROCESO DE PRODUCCIÓN</label>
                                <input type="number" id="Id_Proceso_Produccion" class="form-control" placeholder="Ingrese el código del proceso de producción">
                                <label for="">CANTIDAD</label>
                                <input type="number" id="Cantidad" class="form-control" placeholder="Ingrese ingrese la cantidad del producto">
                                <hr>
                                <div id="btnagregarProductoTerminado">
                                    <input type="submit" id="btnagregarMP" onclick="AgregarProductoTerminadoMP()" value="Agregar" class="btn btn-success">
                                </div>
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
                                Agregar Producto Terminado Final
                            </h3>
                        </div>
                        <div class="col-12">
                            <form class="InsertProductoTerminadoFinal">
                                <label for="">SELECCIONE UN PRODUCTO</label> 
                                <select id="Select_ProductoF" class="form-control">
                                    <option value="">Seleccione un producto</option>
                                </select>
                                <label for="">ID PROCESO DE PRODUCCIÓN</label>
                                <input type="number" id="Id_Proceso_ProduccionF" class="form-control" placeholder="Ingrese el código del proceso de producción">
                                <label for="">CANTIDAD</label>
                                <input type="number" id="CantidadF" class="form-control" placeholder="Ingrese ingrese la cantidad del producto">
                                <hr>
                                <div id="btnagregarProductoTerminadoF">
                                    <input type="submit" id="btnagregarF" onclick="AgregarProductoTerminadoFinal()" value="Agregar" class="btn btn-success">
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
</body>
</html>
