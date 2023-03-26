var UrlInsertarProductoTerminadoMP = 'http://localhost/SIIS-PROYECTO/controller/procesoProduccion.php?opc=InsertProductoTerminadoMP'; // Insertar
var UrlInsertarProductoTerminadoFinal = 'http://localhost/SIIS-PROYECTO/controller/procesoProduccion.php?opc=InsertProductoTerminadoFinal'; // Insertar
var UrlInsertarProcesoProduccion = 'http://localhost/SIIS-PROYECTO/controller/procesoProduccion.php?opc=InsertProcesoProduccion'; // Insertar
//Si se necesita traer datos de otra tabla para una lista desplegable
var UrlProductos = 'http://localhost/SIIS-PROYECTO/controller/procesoProduccion.php?opc=GetProductos'; 
var UrlEstadoProceso = 'http://localhost/SIIS-PROYECTO/controller/procesoProduccion.php?opc=GetEstadoProceso'; 


$(document).ready(function(){
   CargarProductos();
   CargarEstadosProceso();
});


function AgregarProductoTerminadoMP(){
    var datosProductoTerminadoMP = {
    Id_Producto: $('#Select_Producto').val(),
    Id_Proceso_Produccion: $('#Id_Proceso_Produccion').val(),
    Cantidad: $('#Cantidad').val()
    };
    var datosProductoTerminadoJson= JSON.stringify(datosProductoTerminadoMP );

    $.ajax({
        url:UrlInsertarProductoTerminadoMP,
        type: 'POST',
        data: datosProductoTerminadoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Producto Agregado');
        },

        error: function(textStatus, errorThrown){
            alert('Error al agregar producto' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
}

function AgregarProductoTerminadoFinal(){
    var datosProductoTerminadoFinal = {
    Id_Producto: $('#Select_ProductoF').val(),
    Id_Proceso_Produccion: $('#Id_Proceso_ProduccionF').val(),
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
        },

        error: function(textStatus, errorThrown){
            alert('Error al agregar producto' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
}

function AgregarProcesoProduccion(){
    var datosProcesoProduccion = {
    Id_Estado_Proceso: $('#Select_Estados_Proceso').val(),
    Fecha: $('#Fecha').val()
    };
    var datosProcesoProduccionJson= JSON.stringify(datosProcesoProduccion);

    $.ajax({
        url: UrlInsertarProcesoProduccion,
        type: 'POST',
        data: datosProcesoProduccionJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Proceso Agregado');
        },

        error: function(textStatus, errorThrown){
            alert('Error al agregar proceso' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
}

//Función para traer los datos de otra tabla para poder ser seleccionados en una lista desplegable
function CargarProductos(){
    $.ajax({
        url : UrlProductos,
        type: 'GET',
        datatype: 'JSON',
        success: function(response){
            var MisItems = response;
            var opciones='';
            
            for(i=0; i<MisItems.length; i++){ //Muestra Id y nombre
                opciones += '<option value="' + MisItems[i].Id_Producto + '">' + ' ID ' + MisItems[i].Id_Producto + ' - ' + MisItems[i].Nombre + '</option>';
            }
            $('#Select_Producto').html(opciones);
            $('#Select_ProductoF').html(opciones);
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
        }
    });
}