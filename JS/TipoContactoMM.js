var UrlTipoContactosMM = 'http://localhost/SIIS-PROYECTO/controller/tipoContactoMM.php?opc=GetTipoContactosMM';
var UrlTipoContactoMM = 'http://localhost/SIIS-PROYECTO/controller/tipoContactoMM.php?opc=GetTipoContactoMM';
var UrlInsertarTipoContactoMM = 'http://localhost/SIIS-PROYECTO/controller/tipoContactoMM.php?opc=InsertTipoContactoMM'; // Insertrar
var UrlActualizarTipoContactoMM = 'http://localhost/SIIS-PROYECTO/controller/tipoContactoMM.php?opc=UpdateTipoContactoMM'; // Editar
var UrlEliminarTipoContactoMM = 'http://localhost/SIIS-PROYECTO/controller/tipoContactoMM.php?opc=DeleteTipoContactoMM'; // Eliminar
var UrlTipoContactoMMeditar = 'http://localhost/SIIS-PROYECTO/controller/tipoContactoMM.php?opc=GetTipoContactoMMeditar'; // Traer el dato a editar

$(document).ready(function(){
   CargarTipoContactosMM();
});

function CargarTipoContactosMM(){
    
    $.ajax({
        url : UrlTipoContactosMM,
        type: 'GET',
        datatype: 'JSON',
        success: function(reponse){
            var MisItems = reponse;
            // Si la tabla ya ha sido inicializada previamente, destruye la instancia
            if ($.fn.DataTable.isDataTable('#TablaTipoContactos')) {
                $('#TablaTipoContactos').DataTable().destroy();
               }
               $('#TablaTipoContactos').DataTable({
                   processing: true,
                   data: MisItems,
                   "language": {
                       "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                     },
                     columns: [
                       { data: 'Id_Tipo_Contacto' },
                       { data: 'Nombre_tipo_contacto' },
                       { 
                           data: null, 
                           render: function ( data, type, row ) {
                             return '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarTipoContactoMM(\'' + row.Id_Tipo_Contacto + '\'); mostrarFormulario();">Editar</button>' +
                                    '<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarTipoContactoMM(\'' + row.Id_Tipo_Contacto + '\')">Eliminar</button>';
                           }
                        }                
                    ]
               });
        }

    });
}

function AgregarTipoContactoMM(){
    var datosTipoContactoMM = {
        Nombre_tipo_contacto: $('#Nombre_tipo_contacto').val()
    };
    var datosTipoContactoMMJson= JSON.stringify(datosTipoContactoMM );

    $.ajax({
        url:UrlInsertarTipoContactoMM,
        type: 'POST',
        data: datosTipoContactoMMJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Tipo de contacto Agregado');
        },

        error: function(textStatus, errorThrown){
            alert('Error al agregar el tipo de contacto' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
}

function CargarTipoContactoMM(idTipoContacto){ //Función que trae los campos que se eligieron editar.
    var datosTipoContactoMM = {
        Id_Tipo_Contacto:idTipoContacto
    };
    var datosTipoContactoMMJson=JSON.stringify(datosTipoContactoMM);

    $.ajax({
        url: UrlTipoContactoMMeditar,
        type: 'POST',
        data: datosTipoContactoMMJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            //Muestra el id junto con su título que se encuentra oculto en el Agregar.
            $('#Id_Tipo_Contacto').removeAttr('hidden'); // ID
            $('label[for="Id_Tipo_Contacto"]').removeAttr('hidden'); //Título
        
            $('#Id_Tipo_Contacto').val(MisItems[0].Id_Tipo_Contacto).prop('readonly', true);  // Propiedad para que no se pueda modificar el campo.
            $('#Nombre_tipo_contacto').val(MisItems[0].Nombre_tipo_contacto);

            //Usar el mismo botón de agregar con la funcionalidad de actualizar.
            var btnactualizar = '<input type="submit" id="btn_actualizar" onclick="ActualizarTipoContactoMM(' +MisItems[0].Id_Tipo_Contacto+')"'+
            'value="Actualizar Tipo Contacto" class="btn btn-primary"> <button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button></input>';
            $('#btnagregarTipoContacto').html(btnactualizar);
            $('#btncancelar').click(function(){ //Cancela la acción
                location.href = "http://localhost/SIIS-PROYECTO/Formularios/TipoContactoMM.php";
             });
            //Cambiar el título del formulario.
            var titulo = '<div class="Col-12" id="titulo">'+
            '<h3>Editar Tipo Contacto</h3></div>';
            $('#titulo').html(titulo); 
        }
    });
}

function ActualizarTipoContactoMM(idTipoContacto){
    var datosTipoContactoMM={
        Id_Tipo_Contacto:idTipoContacto,
        Nombre_tipo_contacto: $('#Nombre_tipo_contacto').val()
    };
    var datosTipoContactoMMJson=JSON.stringify(datosTipoContactoMM);

    $.ajax({
        url: UrlActualizarTipoContactoMM,
        type: 'PUT',
        data: datosTipoContactoMMJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Tipo de contacto Actualizado');
        },

        error: function(textStatus, errorThrown){
            alert('Error al actualizar el tipo de contacto' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
}

function EliminarTipoContactoMM(idTipoContacto){
    var confirmacion = confirm("¿Está seguro de que desea eliminar el tipo de contacto?");

    if (confirmacion == true) {
        var datosTipoContactoMM = {
            Id_Tipo_Contacto:idTipoContacto,
        };
        var datosTipoContactoMMJson=JSON.stringify(datosTipoContactoMM);
        

        $.ajax({
            url: UrlEliminarTipoContactoMM,
            type: 'DELETE',
            data: datosTipoContactoMMJson,
            datatype: 'JSON',
            contentType: 'application/json',
            success: function(reponse){
                console.log(reponse);
                alert('Tipo de contacto Eliminado');
                CargarTipoContactosMM(); 
            },

            error: function(textStatus, errorThrown){
                alert('Error al eliminar el tipo de contacto' + textStatus + errorThrown);
            }
        });

    } else {
        alert("La eliminación del tipo de contacto ha sido cancelada.");
    }
}
