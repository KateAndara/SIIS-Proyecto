var UrlPromociones = 'http://localhost/SIIS-PROYECTO/controller/promociones.php?opc=GetPromocionesP'; //Traer todos los datos
var UrlPromocion = 'http://localhost/SIIS-PROYECTO/controller/promociones.php?opc=GetPromocion';     //Traer los datos de búsqueda
var UrlInsertarPromociones = 'http://localhost/SIIS-PROYECTO/controller/promocionesP.php?opc=InsertPromocion'; // Insertrar
var UrlActualizarPromociones = 'http://localhost/SIIS-PROYECTO/controller/promociones.php?opc=UpdatePromocion'; // Editar
var UrlEliminarPromociones = 'http://localhost/SIIS-PROYECTO/controller/promociones.php?opc=DeletePromocion'; // Eliminar
var UrlPromocioneditar = 'http://localhost/SIIS-PROYECTO/controller/promociones.php?opc=GetPromocioneditar'; // Traer el dato a editar

$(document).ready(function(){
   CargarPromociones();
});

function CargarPromociones(){
    
    $.ajax({
        url : UrlPromociones,
        type: 'GET',
        datatype: 'JSON',
        success: function(reponse){
            var MisItems = reponse;
            var Valores='';
            
            for(i=0; i<MisItems.length; i++){
                Valores+= '<tr>'+
                '<td>'+ MisItems[i].Id_Promocion  +'</td>'+ 
                '<td>'+ MisItems[i].Nombre_Promocion +'</td>'+
                '<td>'+ MisItems[i].Precio_Venta +'</td>'+
                '<td>'+ MisItems[i].Fecha_inicio +'</td>'+
                '<td>'+ MisItems[i].Fecha_final +'</td>'+
                '<td>'+ 
                '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick=" CargarPromocion('+MisItems[i].Id_Promocion +'); mostrarFormulario();">Editar</button>'+ 
                '<button class="rounded" style="background-color: #D6234A; color: white; display: inline-block; width: 67px;"  onclick="EliminarPromocion('+MisItems[i].Id_Promocion +')">Eliminar</button>'+
                '</td>'+
            '</tr>';
            }
            $('#DataPromociones').html(Valores);
        }

    });
}


function BuscarPromociones(NombrePromocion){
    var datosPromocion = {
        Nombre: isNaN(NombrePromocion) ? NombrePromocion : null,
        Id_Promocion: isNaN(NombrePromocion) ? null : parseInt(NombrePromocion)
    };
    var datosPromocionJson = JSON.stringify(datosPromocion);

    $.ajax({
        url: UrlPromocion,
        type: 'POST',
        data: datosPromocionJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            var Valores='';
            
            for(i=0; i<MisItems.length; i++){
                Valores+= '<tr>'+
                '<td>'+ MisItems[i].Id_Promocion  +'</td>'+ 
                '<td>'+ MisItems[i].Nombre_Promocion +'</td>'+
                '<td>'+ MisItems[i].Precio_Venta +'</td>'+
                '<td>'+ MisItems[i].Fecha_inicio +'</td>'+
                '<td>'+ MisItems[i].Fecha_final +'</td>'+
                '<td>'+ 
                '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick=" CargarPromocion('+MisItems[i].Id_Promocion +'); mostrarFormulario();">Editar</button>'+ 
                '<button class="rounded" style="background-color: #D6234A; color: white; display: inline-block; width: 67px;"  onclick="EliminarPromocion('+MisItems[i].Id_Promocion +')">Eliminar</button>'+
                '</td>'+
            '</tr>';
            }
            $('#DataPromociones').html(Valores);
        }
    });
}



function AgregarPromocion(){
    var datosPromocion = {
    Nombre_Promocion: $('#Nombre_Promocion').val(),
    Precio_Venta: $('#Precio_Venta').val(),
    Fecha_inicio: $('#Fecha_inicio').val(),
    Fecha_final: $('#Fecha_final').val()
    };
    var datosPromocionJson= JSON.stringify(datosPromocion );

    $.ajax({
        url:UrlInsertarPromociones,
        type: 'POST',
        data: datosPromocionJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Promoción Agregada');
        },

        error: function(textStatus, errorThrown){
            alert('Error al agregar promoción' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
}

function CargarPromocion(idPromocion){ //Función que trae los campos que se eligieron editar.
    var datosPromocion = {
        Id_Promocion:idPromocion
    };
    var datosPromocionJson=JSON.stringify(datosPromocion);

    $.ajax({
        url: UrlPromocioneditar,
        type: 'POST',
        data: datosPromocionJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            //Muestra el id junto con su título que se encuentra oculto en el Agregar.
            $('#Id_Promocion').removeAttr('hidden'); // ID
            $('label[for="Id_Promocion"]').removeAttr('hidden'); //Título
        
            $('#Id_Promocion').val(MisItems[0].Id_Promocion).prop('readonly', true);  // Propiedad para que no se pueda modificar el campo.
            $('#Nombre_Promocion').val(MisItems[0].Nombre_Promocion);
            $('#Precio_Venta').val(MisItems[0].Precio_Venta);
            $('#Fecha_inicio').val(MisItems[0].Fecha_inicio);
            $('#Fecha_final').val(MisItems[0].Fecha_final);
            //Usar el mismo botón de agregar con la funcionalidad de actualizar.
            var btnactualizar = '<input type="submit" id="btn_actualizar" onclick="ActualizarPromocion(' +MisItems[0].Id_Promocion+')"'+
            'value="Actualizar Promocion" class="btn btn-primary"></input>';
            $('#btnagregarPromocion').html(btnactualizar);
            //Cambiar el título del formulario.
            var titulo = '<div class="Col-12" id="titulo">'+
            '<h3>Editar Promocion</h3></div>';
            $('#titulo').html(titulo);
            
        }
    });
}

function ActualizarPromocion(idPromocion){
    var datosPromocion={
    Id_Promocion: idPromocion,
    Nombre_Promocion: $('#Nombre_Promocion').val(),
    Precio_Venta: $('#Precio_Venta').val(),
    Fecha_inicio: $('#Fecha_inicio').val(),
    Fecha_final: $('#Fecha_final').val()
    };
    var datosPromocionJson = JSON.stringify(datosPromocion);

    $.ajax({
        url: UrlActualizarPromociones,
        type: 'PUT',
        data: datosPromocionJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Promoción Actualizada');
        },

        error: function(textStatus, errorThrown){
            alert('Error al actualizar promoción' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
}

function EliminarPromocion(idPromocion){
    var datosPromocion={
        Id_Promocion:idPromocion
    };

    var datosPromocionJson= JSON.stringify(datosPromocion);

    $.ajax({
        url: UrlEliminarPromociones,
        type: 'DELETE',
        data: datosPromocionJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Promoción Eliminada');
        },

        error: function(textStatus, errorThrown){
            alert('Error al eliminar Promoción' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
    CargarPromociones();
}