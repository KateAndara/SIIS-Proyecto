var UrlInsertarProductoTerminadoMP = 'http://localhost/SIIS-PROYECTO/controller/nuevoProcesoProduccion.php?opc=InsertProductoTerminadoMP'; // Insertar
var UrlInsertarProductoTerminadoFinal = 'http://localhost/SIIS-PROYECTO/controller/nuevoProcesoProduccion.php?opc=InsertProductoTerminadoFinal'; // Insertar
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
    var datosProductoTerminadoMP = {
        Id_Producto: $('#Select_ProductoMP').val(),
        Cantidad: $('#Cantidad').val()
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
            alert('Producto Agregado');
            CargarProductosTerminadosMP();
            document.querySelector("#Select_ProductoMP").value = ""; // limpiar el valor seleccionado
            document.querySelector("#Cantidad").value = ""; // limpiar el valor ingresado
            document.querySelector(".InsertProductoTerminado").reset(); // resetear el formulario
        },

        error: function(textStatus, errorThrown){
            alert('Error al agregar producto' + textStatus + errorThrown);
        }
    });
}

function AgregarProductoTerminadoFinal(event){
    event.preventDefault();
    var datosProductoTerminadoFinal = {
    Id_Producto: $('#Select_ProductoFinal').val(),
    Cantidad: $('#CantidadF').val()
    };
    var datosProductoTerminadoFinalJson= JSON.stringify(datosProductoTerminadoFinal );

    $.ajax({
        url: UrlInsertarProductoTerminadoFinal,
        type: 'POST',
        data: datosProductoTerminadoFinalJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Producto Agregado');
            CargarProductosTerminadosFinal();
            document.querySelector("#Select_ProductoFinal").value = ""; // limpiar el valor seleccionado
            document.querySelector("#CantidadF").value = ""; // limpiar el valor ingresado
            document.querySelector(".InsertProductoTerminadoFinal").reset(); // resetear el formulario
        },

        error: function(textStatus, errorThrown){
            alert('Error al agregar producto' + textStatus + errorThrown);
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
      alert('Error al agregar proceso' + textStatus + errorThrown);
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
            var opciones='';
            
            for(i=0; i<MisItems.length; i++){ //Muestra Id y nombre
                opciones += '<option value="' + MisItems[i].Id_Producto + '">' + ' ID ' + MisItems[i].Id_Producto + ' - ' + MisItems[i].Nombre + '</option>';
            }
            $('#Select_ProductoMP').html(opciones);
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
            var opciones='';
            
            for(i=0; i<MisItems.length; i++){ //Muestra Id y nombre
                opciones += '<option value="' + MisItems[i].Id_Producto + '">' + ' ID ' + MisItems[i].Id_Producto + ' - ' + MisItems[i].Nombre + '</option>';
            }
            $('#Select_ProductoFinal').html(opciones);
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

