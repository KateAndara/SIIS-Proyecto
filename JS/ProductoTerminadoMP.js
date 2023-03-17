var UrlProductosTerminadosMP = 'http://localhost/SIIS-PROYECTO/controller/productoTerminadoMP.php?opc=GetProductosTerminadosMP'; //Traer todos los datos
var UrlProductoTerminadoMP = 'http://localhost/SIIS-PROYECTO/controller/productoTerminadoMP.php?opc=GetProductoTerminadoMP';     //Traer los datos de búsqueda
var UrlInsertarProductoTerminadoMP = 'http://localhost/SIIS-PROYECTO/controller/productoTerminadoMP.php?opc=InsertProductoTerminadoMP'; // Insertrar
var UrlActualizarProductoTerminadoMP = 'http://localhost/SIIS-PROYECTO/controller/productoTerminadoMP.php?opc=UpdateProductoTerminadoMP'; // Editar
var UrlEliminarProductoTerminadoMP = 'http://localhost/SIIS-PROYECTO/controller/productoTerminadoMP.php?opc=DeleteProductoTerminadoMP'; // Eliminar
var UrlProductoTerminadoMPeditar = 'http://localhost/SIIS-PROYECTO/controller/productoTerminadoMP.php?opc=GetProductoTerminadoMPeditar'; // Traer el dato a editar

$(document).ready(function(){
   CargarProductosTerminadosMP();
});

function CargarProductosTerminadosMP(){
    
    $.ajax({
        url : UrlProductosTerminadosMP,
        type: 'GET',
        datatype: 'JSON',
        success: function(reponse){
            var MisItems = reponse;
            var Valores='';
            
            for(i=0; i<MisItems.length; i++){
                Valores+= '<tr>'+
                '<td>'+ MisItems[i].Id_Producto_Terminado_Mp  +'</td>'+ 
                '<td>'+ MisItems[i].Nombre +'</td>'+
                '<td>'+ MisItems[i].Id_Proceso_Produccion +'</td>'+
                '<td>'+ MisItems[i].Cantidad +'</td>'+
                '<td>'+ 
                '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick=" CargarProductoTerminadoMP('+MisItems[i].Id_Producto_Terminado_Mp +'); mostrarFormulario();">Editar</button>'+ 
                '<button class="rounded" style="background-color: #D6234A; color: white; display: inline-block; width: 67px;"  onclick="EliminarProductoTerminadoMP('+MisItems[i].Id_Producto_Terminado_Mp +')">Eliminar</button>'+
                '</td>'+
            '</tr>';
            }
            $('#DataProductosTerminadosMP').html(Valores);
        }

    });
}


function BuscarProductoTerminadoMP(NombreProducto){
    var datosProducto = {
        Nombre: isNaN(NombreProducto) ? NombreProducto : null,
        Id_Producto_Terminado_Mp: isNaN(NombreProducto) ? null : parseInt(NombreProducto)
    };
    var datosProductoJson = JSON.stringify(datosProducto);

    $.ajax({
        url: UrlProductoTerminadoMP,
        type: 'POST',
        data: datosProductoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            var Valores='';
            
            for(i=0; i<MisItems.length; i++){
                Valores+= '<tr>'+
                '<td>'+ MisItems[i].Id_Producto_Terminado_Mp  +'</td>'+ 
                '<td>'+ MisItems[i].Nombre +'</td>'+
                '<td>'+ MisItems[i].Id_Proceso_Produccion +'</td>'+
                '<td>'+ MisItems[i].Cantidad +'</td>'+
                '<td>'+ 
                '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick=" CargarProductoTerminadoMP('+MisItems[i].Id_Producto_Terminado_Mp +'); mostrarFormulario();">Editar</button>'+ 
                '<button class="rounded" style="background-color: #D6234A; color: white; display: inline-block; width: 67px;"  onclick="EliminarProductoTerminadoMP('+MisItems[i].Id_Producto_Terminado_Mp +')">Eliminar</button>'+
                '</td>'+
            '</tr>';
            }
            $('#DataProductosTerminadosMP').html(Valores);
        }
    });
}



function AgregarProductoTerminadoMP(){
    var datosProductoTerminadoMP = {
    Id_Producto: $('#Id_Producto').val(),
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

function CargarProductoTerminadoMP(idProducto){ //Función que trae los campos que se eligieron editar.
    var datosProductoTerminadoMP = {
        Id_Producto_Terminado_Mp:idProducto
    };
    var datosProductoTerminadoJson=JSON.stringify(datosProductoTerminadoMP);

    $.ajax({
        url: UrlProductoTerminadoMPeditar,
        type: 'POST',
        data: datosProductoTerminadoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            //Muestra el id junto con su título que se encuentra oculto en el Agregar.
            $('#Id_Producto_Terminado_Mp').removeAttr('hidden'); // ID
            $('label[for="Id_Producto_Terminado_Mp"]').removeAttr('hidden'); //Título
        
            $('#Id_Producto_Terminado_Mp').val(MisItems[0].Id_Producto_Terminado_Mp).prop('readonly', true);  // Propiedad para que no se pueda modificar el campo.
            $('#Id_Producto').val(MisItems[0].Id_Producto);
            $('#Id_Proceso_Produccion').val(MisItems[0].Id_Proceso_Produccion);
            $('#Cantidad').val(MisItems[0].Cantidad);
            //Usar el mismo botón de agregar con la funcionalidad de actualizar.
            var btnactualizar = '<input type="submit" id="btn_actualizar" onclick="ActualizarProductoTerminadoMP(' +MisItems[0].Id_Producto_Terminado_Mp+')"'+
            'value="Actualizar Producto" class="btn btn-primary"></input>';
            $('#btnagregarProductoTerminado').html(btnactualizar);
            //Cambiar el título del formulario.
            var titulo = '<div class="Col-12" id="titulo">'+
            '<h3>Editar Producto Terminado</h3></div>';
            $('#titulo').html(titulo);
            
        }
    });
}

function ActualizarProductoTerminadoMP(idProducto){
    var datosProductoTerminadoMP={
    Id_Producto_Terminado_Mp: idProducto,
    Id_Producto: $('#Id_Producto').val(),
    Id_Proceso_Produccion: $('#Id_Proceso_Produccion').val(),
    Cantidad: $('#Cantidad').val()
    };
    var datosProductoTerminadoJson = JSON.stringify(datosProductoTerminadoMP);

    $.ajax({
        url: UrlActualizarProductoTerminadoMP,
        type: 'PUT',
        data: datosProductoTerminadoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Producto Actualizado');
        },

        error: function(textStatus, errorThrown){
            alert('Error al actualizar producto' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
}

function EliminarProductoTerminadoMP(idProducto){
    var datosProductoTerminadoMP={
        Id_Producto_Terminado_Mp:idProducto
    };

    var datosProductoTerminadoJson= JSON.stringify(datosProductoTerminadoMP);

    $.ajax({
        url: UrlEliminarProductoTerminadoMP,
        type: 'DELETE',
        data: datosProductoTerminadoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Producto Eliminado');
        },

        error: function(textStatus, errorThrown){
            alert('Error al eliminar Producto' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
    CargarProductosTerminadosMP();
}




