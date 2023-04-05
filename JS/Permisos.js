var UrlPermisos = 'http://localhost/SIIS-PROYECTO/controller/permisos.php?opc=GetPermisos'; //Traer todos los datos
var UrlPermiso = 'http://localhost/SIIS-PROYECTO/controller/permisos.php?opc=GetPermiso';     //Traer los datos de búsqueda
var UrlInsertarPermiso = 'http://localhost/SIIS-PROYECTO/controller/permisos.php?opc=InsertPermiso'; // Insertrar
var UrlActualizarPermiso = 'http://localhost/SIIS-PROYECTO/controller/permisos.php?opc=UpdatePermiso'; // Editar
var UrlEliminarPermiso = 'http://localhost/SIIS-PROYECTO/controller/permisos.php?opc=DeletePermiso'; // Eliminar
var UrlPermisoeditar = 'http://localhost/SIIS-PROYECTO/controller/permisos.php?opc=GetPermisoeditar'; // Traer el dato a editar
//Si se necesita traer datos de otra tabla para una lista desplegable
var UrlRoles = 'http://localhost/SIIS-PROYECTO/controller/permisos.php?opc=GetRoles'; 
var UrlObjetos = 'http://localhost/SIIS-PROYECTO/controller/permisos.php?opc=GetObjetos'; 


$(document).ready(function(){
   CargarPermisos();
   CargarRoles();
   CargarObjetos();
});

function CargarPermisos(){
    
    $.ajax({
        url : UrlPermisos,
        type: 'GET',
        datatype: 'JSON',
        success: function(reponse){
            var MisItems = reponse;
            // Si la tabla ya ha sido inicializada previamente, destruye la instancia
            if ($.fn.DataTable.isDataTable('#TablaPermisos')) {
                $('#TablaPermisos').DataTable().destroy();
               }
               $('#TablaPermisos').DataTable({
                   processing: true,
                   data: MisItems,
                   "language": {
                       "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                     },
                     columns: [
                       { data: 'Id_Permisos' },
                       { data: 'Rol' },
                       { data: 'Objeto' },
                       { data: 'Insertar' },
                       { data: 'Eliminar' },
                       { data: 'Actualizar' },
                       { data: 'Visualizar' },
                       { 
                           data: null, 
                           render: function ( data, type, row ) {
                             return '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarPermiso(\'' + row.Id_Rol + '\'); mostrarFormulario();">Editar</button>' +
                                    '<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarPermiso(\'' + row.Id_Rol + '\')">Eliminar</button>';
                           }
                         }                ]
               });
           }
       });
   }



function BuscarPermiso(NombrePermiso){
    var datosPermiso = {
        Nombre: isNaN(NombrePermiso) ? NombrePermiso : null,
        Id_Permisos: isNaN(NombrePermiso) ? null : parseInt(NombrePermiso),
        Objeto:isNaN(NombrePermiso) ? null : parseInt(NombrePermiso)
    };
    var datosPermisoJson = JSON.stringify(NombrePermiso);

    $.ajax({
        url: UrlPermiso,
        type: 'POST',
        data: datosPermisoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            var Valores='';
            
            for(i=0; i<MisItems.length; i++){
                Valores+= '<tr>'+
                '<td>'+ MisItems[i].Id_Permisos +'</td>'+
                '<td>'+ MisItems[i].Rol +'</td>'+
                '<td>'+ MisItems[i].Objeto +'</td>'+
                '<td>'+ MisItems[i].Permiso_insercion +'</td>'+
                '<td>'+ MisItems[i].Permiso_eliminacion +'</td>'+
                '<td>'+ MisItems[i].Permiso_actualizacion +'</td>'+
                '<td>'+ MisItems[i].Permiso_consultar +'</td>'+
                '<td>'+ 
                '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick=" CargarPermiso('+MisItems[i].Id_Permisos +'); mostrarFormulario();">Editar</button>'+ 
                '<button class="rounded" style="background-color: #D6234A; color: white; display: inline-block; width: 67px;"  onclick="EliminarPermiso('+MisItems[i].Id_Permisos +')">Eliminar</button>'+
                '</td>'+
            '</tr>';
            }
            $('#DataPermisos').html(Valores);
        }
    });
}



function AgregarPermiso(){
    var datosPermiso = {
    Id_Rol: $('#Select_Rol').val(),
    Id_Objeto: $('#Select_Objeto').val(),
    Permiso_insercion: $('#Permiso_insercion').prop('checked') ? 1 : 0,
    Permiso_eliminacion: $('#Permiso_eliminacion').prop('checked') ? 1 : 0,
    Permiso_actualizacion: $('#Permiso_actualizacion').prop('checked') ? 1 : 0,
    Permiso_consultar: $('#Permiso_consultar').prop('checked') ? 1 : 0,
};
    var datosPermisoJson= JSON.stringify(datosPermiso);

    $.ajax({
        url:UrlInsertarPermiso,
        type: 'POST',
        data: datosPermisoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Permisos Agregado');
        },

        error: function(textStatus, errorThrown){
            alert('Error al agregar permisos' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
}

function CargarPermiso(idPermiso){ //Función que trae los campos que se eligieron editar.
    var datosPermiso = {
        Id_Permisos:idPermiso
    };
    var datosPermisoJson=JSON.stringify(datosPermiso);

    $.ajax({
        url: UrlPermisoeditar,
        type: 'POST',
        data: datosPermisoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            //Muestra el id junto con su título que se encuentra oculto en el Agregar.
            $('#Id_Permisos').removeAttr('hidden'); // ID
            $('label[for="Id_Permisos"]').removeAttr('hidden'); //Título
            $('#Id_Permisos').val(MisItems[0].Id_Permisos).prop('readonly', true);  // Propiedad para que no se pueda modificar el campo.
            $('#Select_Rol').val(MisItems[0].Id_Rol).prop('disabled', true);
            $('#Select_Objeto').val(MisItems[0].Id_Objeto);
            $('#Permiso_insercion').prop('checked', MisItems[0].Permiso_insercion == 1);
            $('#Permiso_eliminacion').prop('checked', MisItems[0].Permiso_eliminacion == 1);
            $('#Permiso_actualizacion').prop('checked', MisItems[0].Permiso_actualizacion == 1);
            $('#Permiso_consultar').prop('checked', MisItems[0].Permiso_consultar == 1);
            //Usar el mismo botón de agregar con la funcionalidad de actualizar.
            var btnactualizar = '<input type="submit" id="btn_actualizar" onclick="ActualizarPermiso(' +MisItems[0].Id_Permisos+')"'+
            'value="Actualizar Permisos" class="btn btn-primary"> <button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button></input>';
            $('#btnagregarPermiso').html(btnactualizar);
            $('#btncancelar').click(function(){ //Cancela la acción
                location.href = "http://localhost/SIIS-PROYECTO/Formularios/Permisos.php";
             });
            //Cambiar el título del formulario.
            var titulo = '<div class="Col-12" id="titulo">'+
            '<h3>Editar Permisos</h3></div>';
            $('#titulo').html(titulo); 
        }
    });
}

function ActualizarPermiso(idPermiso){
    
    var datosPermiso={
    Id_Permisos: idPermiso,
    Id_Rol: $('#Select_Rol').val(),
    Id_Objeto: $('#Select_Objeto').val(),
    Permiso_insercion: $('#Permiso_insercion').prop('checked') ? 1 : 0,
    Permiso_eliminacion: $('#Permiso_eliminacion').prop('checked') ? 1 : 0,
    Permiso_actualizacion: $('#Permiso_actualizacion').prop('checked') ? 1 : 0,
    Permiso_consultar: $('#Permiso_consultar').prop('checked') ? 1 : 0,
    };
    var datosPermisoJson = JSON.stringify(datosPermiso);

    $.ajax({
        url: UrlActualizarPermiso,
        type: 'PUT',
        data: datosPermisoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Permisos Actualizados');
        },

        error: function(textStatus, errorThrown){
            alert('Error al actualizar permisos' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
}

function EliminarPermiso(idPermiso){
    var confirmacion = confirm("¿Está seguro de que desea eliminar los permisos?");

    if (confirmacion == true) {
        var datosPermiso={
            Id_Permisos:idPermiso
        };

        var datosPermisoJson= JSON.stringify(datosPermiso);

        $.ajax({
            url: UrlEliminarPermiso,
            type: 'DELETE',
            data: datosPermisoJson,
            datatype: 'JSON',
            contentType: 'application/json',
            success: function(reponse){
                console.log(reponse);
                alert('Permisos Eliminados');
                CargarPermisos(); 
            },

            error: function(textStatus, errorThrown){
                alert('Error al eliminar Permisos' + textStatus + errorThrown);
            }
        });

    } else {
        alert("La eliminación de los permisos ha sido cancelada.");
    }
}

//Función para traer los datos de otra tabla para poder ser seleccionados en una lista desplegable
function CargarRoles(){
    $.ajax({
        url : UrlRoles,
        type: 'GET',
        datatype: 'JSON',
        success: function(response){
            var MisItems = response;
            var opciones='';
            
            for(i=0; i<MisItems.length; i++){ //Muestra Id y nombre
                opciones += '<option value="' + MisItems[i].Id_Rol + '">' + ' ID ' + MisItems[i].Id_Rol + ' - ' + MisItems[i].Rol + '</option>';
            }
            $('#Select_Rol').html(opciones);
        }
    });
}

function CargarObjetos(){
    $.ajax({
        url : UrlObjetos,
        type: 'GET',
        datatype: 'JSON',
        success: function(response){
            var MisItems = response;
            var opciones='';
            
            for(i=0; i<MisItems.length; i++){ //Muestra Id y nombre
                opciones += '<option value="' + MisItems[i].Id_Objeto + '">' + ' ID ' + MisItems[i].Id_Objeto + ' - ' + MisItems[i].Objeto + '</option>';
            }
            $('#Select_Objeto').html(opciones);
        }
    });
}








