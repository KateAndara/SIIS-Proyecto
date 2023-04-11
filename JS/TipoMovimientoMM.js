var UrlTipoMovimientosMM = 'http://localhost/SIIS-PROYECTO/controller/tipoMovimientoMM.php?opc=GetTipoMovimientosMM';
var UrlTipoMovimientoMM = 'http://localhost/SIIS-PROYECTO/controller/tipoMovimientoMM.php?opc=GetTipoMovimientoMM';
var UrlInsertarTipoMovimientoMM = 'http://localhost/SIIS-PROYECTO/controller/tipoMovimientoMM.php?opc=InsertTipoMovimientoMM'; // Insertrar
var UrlActualizarTipoMovimientoMM = 'http://localhost/SIIS-PROYECTO/controller/tipoMovimientoMM.php?opc=UpdateTipoMovimientoMM'; // Editar
var UrlEliminarTipoMovimientoMM = 'http://localhost/SIIS-PROYECTO/controller/tipoMovimientoMM.php?opc=DeleteTipoMovimientoMM'; // Eliminar
var UrlTipoMovimientoMMeditar = 'http://localhost/SIIS-PROYECTO/controller/tipoMovimientoMM.php?opc=GetTipoMovimientoMMeditar'; // Traer el dato a editar

$(document).ready(function(){
   CargarTipoMovimientosMM();
});

function CargarTipoMovimientosMM(){
    
    $.ajax({
        url : UrlTipoMovimientosMM,
        type: 'GET',
        datatype: 'JSON',
        success: function(reponse){
            var MisItems = reponse;
            // Si la tabla ya ha sido inicializada previamente, destruye la instancia
            if ($.fn.DataTable.isDataTable('#TablaTipoMovimientos')) {
                $('#TablaTipoMovimientos').DataTable().destroy();
               }
               $('#TablaTipoMovimientos').DataTable({
                   processing: true,
                   data: MisItems,
                   "language": {
                       "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                     },
                     columns: [
                       { data: 'Id_Tipo_Movimiento' },
                       { data: 'Descripcion' },
                       { 
                           data: null, 
                           render: function ( data, type, row ) {
                             return '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarTipoMovimientoMM(\'' + row.Id_Tipo_Movimiento + '\'); mostrarFormulario();">Editar</button>' +
                                    '<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarTipoMovimientoMM(\'' + row.Id_Tipo_Movimiento + '\')">Eliminar</button>';
                           }
                        }                
                    ]
               });
        }

    });
}

function AgregarTipoMovimientoMM(){
    var datosTipoMovimiento = {
        Descripcion: $('#Descripcion').val()
    };
    var datosTipoMovimientoJson=JSON.stringify(datosTipoMovimiento);

    $.ajax({
        url:UrlInsertarTipoMovimientoMM,
        type: 'POST',
        data: datosTipoMovimientoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Tipo de movimiento Agregado');
        },

        error: function(textStatus, errorThrown){
            alert('Error al agregar el tipo de movimiento' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
}

function CargarTipoMovimientoMM(idTipoMovimiento){ //Función que trae los campos que se eligieron editar.
    var datosTipoMovimiento = {
        Id_Tipo_Movimiento:idTipoMovimiento
    };
    var datosTipoMovimientoJson=JSON.stringify(datosTipoMovimiento);

    $.ajax({
        url: UrlTipoMovimientoMMeditar,
        type: 'POST',
        data: datosTipoMovimientoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            //Muestra el id junto con su título que se encuentra oculto en el Agregar.
            $('#Id_Tipo_Movimiento').removeAttr('hidden'); // ID
            $('label[for="Id_Tipo_Movimiento"]').removeAttr('hidden'); //Título
        
            $('#Id_Tipo_Movimiento').val(MisItems[0].Id_Tipo_Movimiento).prop('readonly', true);  // Propiedad para que no se pueda modificar el campo.
            $('#Descripcion').val(MisItems[0].Descripcion);

            //Usar el mismo botón de agregar con la funcionalidad de actualizar.
            var btnactualizar = '<input type="submit" id="btn_actualizar" onclick="ActualizarTipoMovimientoMM(' +MisItems[0].Id_Tipo_Movimiento+')"'+
            'value="Actualizar Tipo movimiento" class="btn btn-primary"> <button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button></input>';
            $('#btnagregarTipoMovimiento').html(btnactualizar);
            $('#btncancelar').click(function(){ //Cancela la acción
                location.href = "http://localhost/SIIS-PROYECTO/Formularios/TipoMovimientoMM.php";
             });
            //Cambiar el título del formulario.
            var titulo = '<div class="Col-12" id="titulo">'+
            '<h3>Editar Tipo movimiento</h3></div>';
            $('#titulo').html(titulo); 
        }
    });
}

function ActualizarTipoMovimientoMM(idTipoMovimiento){
    var datosTipoMovimiento={
        Id_Tipo_Movimiento: idTipoMovimiento,
        Descripcion: $('#Descripcion').val()
    };
    var datosTipoMovimientoJson=JSON.stringify(datosTipoMovimiento);

    $.ajax({
        url: UrlActualizarTipoMovimientoMM,
        type: 'PUT',
        data: datosTipoMovimientoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Tipo de movimiento Actualizado');
        },

        error: function(textStatus, errorThrown){
            alert('Error al actualizar el tipo de movimiento' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
}

function EliminarTipoMovimientoMM(idTipoMovimiento){
    var confirmacion = confirm("¿Está seguro de que desea eliminar el tipo de movimiento?");

    if (confirmacion == true) {
        var datosTipoMovimiento = {
            Id_Tipo_Movimiento:idTipoMovimiento
        };
        var datosTipoMovimientoJson=JSON.stringify(datosTipoMovimiento);
        

        $.ajax({
            url: UrlEliminarTipoMovimientoMM,
            type: 'DELETE',
            data: datosTipoMovimientoJson,
            datatype: 'JSON',
            contentType: 'application/json',
            success: function(reponse){
                console.log(reponse);
                alert('Tipo de movimiento Eliminado');
                CargarTipoMovimientosMM(); 
            },

            error: function(textStatus, errorThrown){
                alert('Error al eliminar el tipo de movimiento' + textStatus + errorThrown);
            }
        }); 

    } else {
        alert("La eliminación del tipo de movimiento ha sido cancelada.");
    }
}
