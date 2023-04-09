var UrlEstadoProcesosMM = 'http://localhost/SIIS-PROYECTO/controller/estadoProcesoMM.php?opc=GetEstadoProcesosMM';
var UrlEstadoProcesoMM = 'http://localhost/SIIS-PROYECTO/controller/estadoProcesoMM.php?opc=GetEstadoProcesoMM';
var UrlInsertarEstadoProcesoMM = 'http://localhost/SIIS-PROYECTO/controller/estadoProcesoMM.php?opc=InsertEstadoProcesoMM'; // Insertrar
var UrlActualizarEstadoProcesoMM = 'http://localhost/SIIS-PROYECTO/controller/estadoProcesoMM.php?opc=UpdateEstadoProcesoMM'; // Editar
var UrlEliminarEstadoProcesoMM = 'http://localhost/SIIS-PROYECTO/controller/estadoProcesoMM.php?opc=DeleteEstadoProcesoMM'; // Eliminar
var UrlGetEstadoProcesoMMeditar = 'http://localhost/SIIS-PROYECTO/controller/estadoProcesoMM.php?opc=GetEstadoProcesoMMeditar'; // Traer el dato a editar

$(document).ready(function(){
   CargarEstadoProcesosMM();
});

function CargarEstadoProcesosMM(){
    
    $.ajax({
        url : UrlEstadoProcesosMM,
        type: 'GET',
        datatype: 'JSON',
        success: function(reponse){
            var MisItems = reponse;
            // Si la tabla ya ha sido inicializada previamente, destruye la instancia
            if ($.fn.DataTable.isDataTable('#TablaEstadoProcesos')) {
                $('#TablaEstadoProcesos').DataTable().destroy();
               }
               $('#TablaEstadoProcesos').DataTable({
                   processing: true,
                   data: MisItems,
                   "language": {
                       "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                     },
                     columns: [
                       { data: 'Id_Estado_Proceso' },
                       { data: 'Descripcion' },
                       { 
                           data: null, 
                           render: function ( data, type, row ) {
                             return '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarEstadoProcesoMM(\'' + row.Id_Estado_Proceso + '\'); mostrarFormulario();">Editar</button>' +
                                    '<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarEstadoProcesoMM(\'' + row.Id_Estado_Proceso + '\')">Eliminar</button>';
                           }
                        }                
                    ]
               });
        }

    });
}

function AgregarEstadoProcesoMM(){
    var datosEstadoProceso = {
        Descripcion: $('#Descripcion').val()
    };
    var datosEstadoProcesoJson=JSON.stringify(datosEstadoProceso);

    $.ajax({
        url:UrlInsertarEstadoProcesoMM,
        type: 'POST',
        data: datosEstadoProcesoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Estado Del Proceso Agregado');
        },

        error: function(textStatus, errorThrown){
            alert('Error al agregar el esatdo del proceso' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
}

function CargarEstadoProcesoMM(idEstadoProceso){ //Función que trae los campos que se eligieron editar.
    var datosEstadoProceso = {
        Id_Estado_Proceso:idEstadoProceso
    };
    var datosEstadoProcesoJson=JSON.stringify(datosEstadoProceso);

    $.ajax({
        url: UrlGetEstadoProcesoMMeditar,
        type: 'POST',
        data: datosEstadoProcesoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            //Muestra el id junto con su título que se encuentra oculto en el Agregar.
            $('#Id_Estado_Proceso').removeAttr('hidden'); // ID
            $('label[for="Id_Estado_Proceso"]').removeAttr('hidden'); //Título
        
            $('#Id_Estado_Proceso').val(MisItems[0].Id_Estado_Proceso).prop('readonly', true);  // Propiedad para que no se pueda modificar el campo.
            $('#Descripcion').val(MisItems[0].Descripcion);

            //Usar el mismo botón de agregar con la funcionalidad de actualizar.
            var btnactualizar = '<input type="submit" id="btn_actualizar" onclick="ActualizarEstadoProcesoMM(' +MisItems[0].Id_Estado_Proceso+')"'+
            'value="Actualizar Estado Del Proceso" class="btn btn-primary"> <button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button></input>';
            $('#btnagregarEstadoProceso').html(btnactualizar);
            $('#btncancelar').click(function(){ //Cancela la acción
                location.href = "http://localhost/SIIS-PROYECTO/Formularios/EstadoProcesoMM.php";
             });
            //Cambiar el título del formulario.
            var titulo = '<div class="Col-12" id="titulo">'+
            '<h3>Editar Estado del proceso</h3></div>';
            $('#titulo').html(titulo); 
        }
    });
}

function ActualizarEstadoProcesoMM(idEstado){
    var datosEstadoProceso={
        Id_Estado_Proceso: idEstado,
        Descripcion: $('#Descripcion').val()
    };
    var datosEstadoProcesoJson=JSON.stringify(datosEstadoProceso);

    $.ajax({
        url: UrlActualizarEstadoProcesoMM,
        type: 'PUT',
        data: datosEstadoProcesoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Estado del proceso Actualizado');
        },

        error: function(textStatus, errorThrown){
            alert('Error al actualizar el Esatdo del proceso' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
}

function EliminarEstadoProcesoMM(idEstado){
    var confirmacion = confirm("¿Está seguro de que desea eliminar el estado del proceso?");

    if (confirmacion == true) {
        var datosEstadoProceso = {
            Id_Estado_Proceso: idEstado,
        };
        var datosEstadoProcesoJson=JSON.stringify(datosEstadoProceso);
        

        $.ajax({
            url: UrlEliminarEstadoProcesoMM,
            type: 'DELETE',
            data: datosEstadoProcesoJson,
            datatype: 'JSON',
            contentType: 'application/json',
            success: function(reponse){
                console.log(reponse);
                alert('Estado del proceso Eliminado');
                CargarEstadoProcesosMM(); 
            },

            error: function(textStatus, errorThrown){
                alert('Error al eliminar el estado del proceso' + textStatus + errorThrown);
            }
        });

    } else {
        alert("La eliminación del estado del proceso ha sido cancelada.");
    }
}
