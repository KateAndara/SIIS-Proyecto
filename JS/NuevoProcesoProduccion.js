var UrlInsertarProductoTerminadoMP = 'http://localhost/SIIS-PROYECTO/controller/nuevoProcesoProduccion.php?opc=InsertProductoTerminadoMP'; // Insertar
var UrlInsertarProductoTerminadoMPEditandoProceso = 'http://localhost/SIIS-PROYECTO/controller/nuevoProcesoProduccion.php?opc=InsertProductoTerminadoMPEditandoProceso'; // Insertar
var UrlInsertarProductoTerminadoFinal = 'http://localhost/SIIS-PROYECTO/controller/nuevoProcesoProduccion.php?opc=InsertProductoTerminadoFinal'; // Insertar
var UrlInsertarProductoTerminadoFinalEditandoProceso = 'http://localhost/SIIS-PROYECTO/controller/nuevoProcesoProduccion.php?opc=InsertProductoTerminadoFinalEditandoProceso'; // Insertar
var UrlInsertarProcesoProduccion = 'http://localhost/SIIS-PROYECTO/controller/nuevoProcesoProduccion.php?opc=InsertProcesoProduccion'; // Insertar
//Si se necesita traer datos de otra tabla para una lista desplegable
var UrlProductosMP = 'http://localhost/SIIS-PROYECTO/controller/nuevoProcesoProduccion.php?opc=GetProductosMP'; 
var UrlProductosTerminados = 'http://localhost/SIIS-PROYECTO/controller/nuevoProcesoProduccion.php?opc=GetProductosTerminados'; 
var UrlEstadoProceso = 'http://localhost/SIIS-PROYECTO/controller/nuevoProcesoProduccion.php?opc=GetEstadoProceso'; 


$(document).ready(function(){
   CargarProductosMP();
   CargarProductosTerminados();
   CargarEstadosProceso();
});


function AgregarProductoTerminadoMP(event){
    event.preventDefault();
        // Obtener los valores de los campos
        var productoSeleccionado = $('#Select_ProductoMP').val();
        var cantidadIngresada = $('#Cantidad').val();
        
        // Validar que se haya seleccionado un producto
        if (productoSeleccionado === "") {
            Swal.fire({
                title: 'Seleccione un producto de materia prima',
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            });
            return;
        }
        
        // Validar que la cantidad sea un número mayor a 0
        if (!(/^\d+$/.test(cantidadIngresada)) || parseInt(cantidadIngresada) <= 0) {
            Swal.fire({
                title: 'Ingrese una cantidad válida',
                text: 'La cantidad debe ser un número entero mayor a 0.',
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            });
            document.querySelector("#Cantidad").value = ""; // limpiar el valor ingresado
            return;
        }
        
        // Crear el objeto con los datos
        var datosProductoTerminadoMP = {
            Id_Producto: productoSeleccionado,
            Cantidad: cantidadIngresada
        };
    var datosProductoTerminadoJson= JSON.stringify(datosProductoTerminadoMP );

    $.ajax({
        url:UrlInsertarProductoTerminadoMP,
        type: 'POST',
        data: datosProductoTerminadoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(response){
            console.log(response);
            Swal.fire({
                title: 'Producto Agregado',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    CargarProductosTerminadosMP();
                    document.querySelector("#Select_ProductoMP").value = ""; // limpiar el valor seleccionado
                    document.querySelector("#Cantidad").value = ""; // limpiar el valor ingresado
                    document.querySelector(".InsertProductoTerminado").reset(); // resetear el formulario
                }
            });
        },

        error: function(textStatus, errorThrown){
            Swal.fire({
                title: 'Error al agregar producto',
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            });
        }
    });
}

function AgregarProductoTerminadoMPEditandoProceso(event, idProceso){
    event.preventDefault();
    // Obtener los valores de los campos
    var productoSeleccionado = $('#Select_ProductoMP').val();
    var cantidadIngresada = $('#Cantidad').val();
    
    // Validar que se haya seleccionado un producto
    if (productoSeleccionado === "") {
        Swal.fire({
            title: 'Seleccione un producto de materia prima',
            icon: 'error',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
        });
        return;
    }
    
    // Validar que la cantidad sea un número mayor a 0
    if (!(/^\d+$/.test(cantidadIngresada)) || parseInt(cantidadIngresada) <= 0) {
        Swal.fire({
            title: 'Ingrese una cantidad válida',
            text: 'La cantidad debe ser un número entero mayor a 0.',
            icon: 'error',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
        });
        document.querySelector("#Cantidad").value = ""; // limpiar el valor ingresado
        return;
    }
    
    // Crear el objeto con los datos
    var datosProductoTerminadoMP = {
        Id_Producto: productoSeleccionado,
        Cantidad: cantidadIngresada,
        Id_Proceso_Produccion: idProceso
    };
    var datosProductoTerminadoJson= JSON.stringify(datosProductoTerminadoMP );

    $.ajax({
        url:UrlInsertarProductoTerminadoMPEditandoProceso,
        type: 'POST',
        data: datosProductoTerminadoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(response){
            console.log(response);
            Swal.fire({
                title: 'Producto Agregado',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    CargarProductosTerminadosMP();
                    document.querySelector("#Select_ProductoMP").value = ""; // limpiar el valor seleccionado
                    document.querySelector("#Cantidad").value = ""; // limpiar el valor ingresado
                    document.querySelector(".InsertProductoTerminado").reset(); // resetear el formulario
                    CargarProductosTerminadosMPEditandoProceso(idProceso);
                }
            });
        },

        error: function(textStatus, errorThrown){
            Swal.fire({
                title: 'Error al agregar producto',
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            });
        }
    });
}


function AgregarProductoTerminadoFinal(event){
    event.preventDefault();
    // Obtener los valores de los campos
    var productoSeleccionado = $('#Select_ProductoFinal').val();
    var cantidadIngresada = $('#CantidadF').val();
    
    // Validar que se haya seleccionado un producto
    if (productoSeleccionado === "") {
        Swal.fire({
            title: 'Seleccione un producto',
            icon: 'error',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
        });
        return;
    }
    
    // Validar que la cantidad sea un número mayor a 0
    if (!(/^\d+$/.test(cantidadIngresada)) || parseInt(cantidadIngresada) <= 0) {
        Swal.fire({
            title: 'Ingrese una cantidad válida',
            text: 'La cantidad debe ser un número entero mayor a 0.',
            icon: 'error',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
        });
        document.querySelector("#CantidadF").value = ""; // limpiar el valor ingresado
        return;
    }
    
    // Crear el objeto con los datos
    var datosProductoTerminadoFinal = {
        Id_Producto: productoSeleccionado,
        Cantidad: cantidadIngresada
    };
    
    var datosProductoTerminadoFinalJson= JSON.stringify(datosProductoTerminadoFinal );

    $.ajax({
        url: UrlInsertarProductoTerminadoFinal,
        type: 'POST',
        data: datosProductoTerminadoFinalJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(response){
            console.log(response);
            Swal.fire({
                title: 'Producto Agregado',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    CargarProductosTerminadosFinal();
                    document.querySelector("#Select_ProductoFinal").value = ""; // limpiar el valor seleccionado
                    document.querySelector("#CantidadF").value = ""; // limpiar el valor ingresado
                    document.querySelector(".InsertProductoTerminadoFinal").reset(); // resetear el formulario
                }
            });
        },

        error: function(textStatus, errorThrown){
            Swal.fire({
                title: 'Error al agregar producto',
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            });
        }
    });
}


function AgregarProductoTerminadoFinalEditandoProceso(event, idProceso){
    event.preventDefault();
    // Obtener los valores de los campos
    var productoSeleccionado = $('#Select_ProductoFinal').val();
    var cantidadIngresada = $('#CantidadF').val();
    
    // Validar que se haya seleccionado un producto
    if (productoSeleccionado === "") {
        Swal.fire({
            title: 'Seleccione un producto',
            icon: 'error',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
        });
        return;
    }
    
    // Validar que la cantidad sea un número mayor a 0
    if (!(/^\d+$/.test(cantidadIngresada)) || parseInt(cantidadIngresada) <= 0) {
        Swal.fire({
            title: 'Ingrese una cantidad válida',
            text: 'La cantidad debe ser un número entero mayor a 0.',
            icon: 'error',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
        });
        document.querySelector("#CantidadF").value = ""; // limpiar el valor ingresado
        return;
    }
    
    // Crear el objeto con los datos
    var datosProductoTerminadoFinal = {
        Id_Producto: productoSeleccionado,
        Cantidad: cantidadIngresada,
        Id_Proceso_Produccion: idProceso
    };
   
    var datosProductoTerminadoFinalJson= JSON.stringify(datosProductoTerminadoFinal );

    $.ajax({
        url: UrlInsertarProductoTerminadoFinalEditandoProceso,
        type: 'POST',
        data: datosProductoTerminadoFinalJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(response){
            console.log(response);
            Swal.fire({
                title: 'Producto Agregado',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    CargarProductosTerminadosFinal();
                    document.querySelector("#Select_ProductoFinal").value = ""; // limpiar el valor seleccionado
                    document.querySelector("#CantidadF").value = ""; // limpiar el valor ingresado
                    document.querySelector(".InsertProductoTerminadoFinal").reset(); // resetear el formulario
                    CargarProductosTerminadosFinalEditandoProceso(idProceso);
                }
            });
        },

        error: function(textStatus, errorThrown){
            Swal.fire({
                title: 'Error al agregar producto',
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            });
        }
    });
}


let procesoAgregado = false;

function AgregarProcesoProduccion() {
    if (procesoAgregado) {
      return; 
    }
    
    // Establecer la variable booleana en true
    procesoAgregado = true;
  
    var datosProcesoProduccion = {
      Id_Estado_Proceso: $('#Select_Estados_Proceso').val(),
      Fecha: $('#Fecha').val()
    };
    var datosProcesoProduccionJson = JSON.stringify(datosProcesoProduccion);
  
    $.ajax({
      url: UrlInsertarProcesoProduccion,
      type: 'POST',
      data: datosProcesoProduccionJson,
      datatype: 'JSON',
      contentType: 'application/json',
      success: function (reponse) {
        console.log(reponse);
        CargarProductosTerminadosMP();
        CargarProductosTerminadosFinal();
      },
  
      error: function (textStatus, errorThrown) {
        Swal.fire({
          icon: 'error',
          title: 'Error al iniciar proceso',
        }).then(function () {
          location.reload();
        });
      }
    });
  }
  


//Función para traer los datos de otra tabla para poder ser seleccionados en una lista desplegable
function CargarProductosMP(){
    $.ajax({
        url : UrlProductosMP,
        type: 'GET',
        datatype: 'JSON',
        success: function(response){
            var MisItems = response;
            var opciones =
              '<option value="">' + "Seleccione Un Producto" + "</option>";
            
            for(i=0; i<MisItems.length; i++){ //Muestra Id y nombre
                 opciones +='<option value="' +
                  MisItems[i].Id_Producto +
                  '">' +
                  MisItems[i].Id_Producto +
                  " - " +
                  MisItems[i].Nombre +
                  "</option>";
                
                
              }

            $('#Select_ProductoMP').html(opciones);
               $("#Select_ProductoMP").select2();
        }
    });
}

function CargarProductosTerminados(){
    $.ajax({
        url : UrlProductosTerminados,
        type: 'GET',
        datatype: 'JSON',
        success: function(response){
            var MisItems = response;
            var opciones =
              '<option value="">' + "Seleccione Un Producto" + "</option>";
            
            for(i=0; i<MisItems.length; i++){ //Muestra Id y nombre
                 opciones +='<option value="' +
                  MisItems[i].Id_Producto +
                  '">' +
                  MisItems[i].Id_Producto +
                  " - " +
                  MisItems[i].Nombre +
                  "</option>";
                
                
              }

            $('#Select_ProductoFinal').html(opciones);
               $("#Select_ProductoFinal").select2();
         
            
        }
    });
}


//Función para traer los datos de otra tabla para poder ser seleccionados en una lista desplegable
function CargarEstadosProceso(){
    $.ajax({
        url : UrlEstadoProceso,
        type: 'GET',
        datatype: 'JSON',
        success: function(response){
            var MisItems = response;
            var opciones='';
            
            for(i=0; i<MisItems.length; i++){ 
                opciones += '<option value="' + MisItems[i].Id_Estado_Proceso + '">' + MisItems[i].Descripcion + '</option>';
            }
            $('#Select_Estados_Proceso').html(opciones);
            $('#Select_Estado_Proceso').html(opciones);
        }
    });
}

