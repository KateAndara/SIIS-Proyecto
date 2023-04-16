var UrlRoles = 'http://localhost/SIIS-PROYECTO/controller/roles.php?opc=GetRoles'; //Traer todos los datos
var UrlRol = 'http://localhost/SIIS-PROYECTO/controller/roles.php?opc=GetRol';     //Traer los datos de búsqueda
var UrlInsertarRol = 'http://localhost/SIIS-PROYECTO/controller/roles.php?opc=InsertRol'; // Insertrar
var UrlActualizarRol = 'http://localhost/SIIS-PROYECTO/controller/roles.php?opc=UpdateRol'; // Editar
var UrlEliminarRol = 'http://localhost/SIIS-PROYECTO/controller/roles.php?opc=DeleteRol'; // Eliminar
var UrlRoleditar = 'http://localhost/SIIS-PROYECTO/controller/roles.php?opc=GetRoleditar'; // Traer el dato a editar

$(document).ready(function(){
   CargarRoles();
});

function CargarRoles(){
    
    $.ajax({
        url : UrlRoles,
        type: 'GET',
        datatype: 'JSON',
        success: function(reponse){
            var MisItems = reponse;
            // Si la tabla ya ha sido inicializada previamente, destruye la instancia
            if ($.fn.DataTable.isDataTable('#TablaRoles')) {
                $('#TablaRoles').DataTable().destroy();
               }
               $('#TablaRoles').DataTable({
                   processing: true,
                   data: MisItems,
                   "language": {
                       "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                     },
                     columns: [
                       { data: 'Id_Rol' },
                       { data: 'Rol' },
                       { data: 'Descripcion' },
                       { 
                           data: null, 
                           render: function ( data, type, row ) {
                             return '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarRol(\'' + row.Id_Rol + '\'); mostrarFormulario();">Editar</button>' +
                                    '<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarRol(\'' + row.Id_Rol + '\')">Eliminar</button>';
                           }
                         }                ]
               });
           }
       });
   }

/*
function BuscarRol(NombreRol){
    var datosRol = {
        Nombre: isNaN(NombreRol) ? NombreRol : null,
        Id_Rol: isNaN(NombreRol) ? null : parseInt(NombreRol),
        Descripcion:isNaN(NombreRol) ? null : parseInt(NombreRol)
    };
    var datosRolJson = JSON.stringify(datosRol);

    $.ajax({
        url: UrlRol,
        type: 'POST',
        data: datosRolJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            var Valores='';
            
            for(i=0; i<MisItems.length; i++){
                Valores+= '<tr>'+
                '<td>'+ MisItems[i].Id_Rol +'</td>'+
                '<td>'+ MisItems[i].Rol +'</td>'+
                '<td>'+ MisItems[i].Descripcion +'</td>'+
                '<td>'+ 
                '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick=" CargarRol('+MisItems[i].Id_Rol +'); mostrarFormulario();">Editar</button>'+ 
                '<button class="rounded" style="background-color: #D6234A; color: white; display: inline-block; width: 67px;"  onclick="EliminarRol('+MisItems[i].Id_Rol +')">Eliminar</button>'+
                '</td>'+
            '</tr>';
            }
            $('#DataRoles').html(Valores);
        }
    });
}*/
function AgregarRol() {
    var Rol = $('#Rol').val();
    var Descripcion = $('#Descripcion').val();
    //Permitir letras y espacios
    var patron = /^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/;
    //validar que no hayan campos vacíos 
    if (Rol.trim() == "" || Descripcion.trim() == "") {
        alert("Por favor, complete todos los campos.");
        return false;
    } else if (!patron.test(Rol) || !patron.test(Descripcion)) {
        alert("Por favor, ingrese solo letras y espacios en los campos.");
        return false;
    }

    var datosRol = {
        Rol: Rol,
        Descripcion: Descripcion
    };

    var datosRolJson = JSON.stringify(datosRol);

    $.ajax({
        url: UrlInsertarRol,
        type: 'POST',
        data: datosRolJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function (reponse) {
            console.log(reponse);
            alert('Rol agregado correctamente.');
            CargarTablaRoles();
        },
        error: function (textStatus, errorThrown) {
            alert('Error al agregar el rol: ' + textStatus + ' ' + errorThrown);
        }
    });

    return false;
}

function CargarRol(idRol){ //Función que trae los campos que se eligieron editar.
    var datosRol = {
        Id_Rol:idRol
    };
    var datosRolJson=JSON.stringify(datosRol);

    $.ajax({
        url: UrlRoleditar,
        type: 'POST',
        data: datosRolJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            //Muestra el id junto con su título que se encuentra oculto en el Agregar.
            $('#Id_Rol').removeAttr('hidden'); // ID
            $('label[for="Id_Rol"]').removeAttr('hidden'); //Título
        
            $('#Id_Rol').val(MisItems[0].Id_Rol).prop('readonly', true);  // Propiedad para que no se pueda modificar el campo.
            $('#Rol').val(MisItems[0].Rol);
            $('#Descripcion').val(MisItems[0].Descripcion);
            //Usar el mismo botón de agregar con la funcionalidad de actualizar.
            var btnactualizar = '<input type="submit" id="btn_actualizar" onclick="ActualizarRol(' +MisItems[0].Id_Rol+')"'+
            'value="Actualizar Rol" class="btn btn-primary"> <button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button></input>';
            $('#btnagregarRol').html(btnactualizar);
            $('#btncancelar').click(function(){ //Cancela la acción
                location.href = "http://localhost/SIIS-PROYECTO/Formularios/Roles.php";
             });
            //Cambiar el título del formulario.
            var titulo = '<div class="Col-12" id="titulo">'+
            '<h3>Editar Rol</h3></div>';
            $('#titulo').html(titulo); 
        }
    });
}

function ActualizarRol(idRol){
    var rol = $('#Rol').val();
    var descripcion = $('#Descripcion').val();
    
    // Validar campos vacíos
    if (rol.trim() === '' || descripcion.trim() === '') {
        alert('Por favor completa todos los campos');
        return;
    }
    
    // Validar solo letras y espacios
    var regex = /^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/;
    if (!regex.test(rol) || !regex.test(descripcion)) {
        alert('Por favor utiliza solo letras y espacios');
        return;
    }
    
    var datosRol = {
        Id_Rol: idRol,
        Rol: rol,
        Descripcion: descripcion
    };
    var datosRolJson = JSON.stringify(datosRol);

    $.ajax({
        url: UrlActualizarRol,
        type: 'PUT',
        data: datosRolJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Rol Actualizado');
        },

        error: function(textStatus, errorThrown){
            alert('Error al actualizar rol' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
}


function EliminarRol(idRol){
    var confirmacion = confirm("¿Está seguro de que desea eliminar el rol?");

    if (confirmacion == true) {
        var datosRol={
            Id_Rol:idRol
        };

        var datosRolJson= JSON.stringify(datosRol);

        $.ajax({
            url: UrlEliminarRol,
            type: 'DELETE',
            data: datosRolJson,
            datatype: 'JSON',
            contentType: 'application/json',
            success: function(reponse){
                console.log(reponse);
                alert('Rol Eliminado');
                CargarRoles(); 
            },

            error: function(textStatus, errorThrown){
                alert('Error al eliminar Rol' + textStatus + errorThrown);
            }
        });

    } else {
        alert("La eliminación del rol ha sido cancelada.");
    }
}