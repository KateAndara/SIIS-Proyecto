var UrlContactoProveedoresMM = 'http://localhost/SIIS-PROYECTO/controller/contactoProveedorMM.php?opc=GetContactoProveedoresMM';
var UrlContactoProveedorMM = 'http://localhost/SIIS-PROYECTO/controller/contactoProveedorMM.php?opc=GetContactoProveedorMM';
var UrlInsertarContactoProveedorMM = 'http://localhost/SIIS-PROYECTO/controller/contactoProveedorMM.php?opc=InsertContactoProveedorMM'; // Insertrar
var UrlActualizarContactoProveedorMM = 'http://localhost/SIIS-PROYECTO/controller/contactoProveedorMM.php?opc=UpdateContactoProveedorMM'; // Editar
var UrlEliminarContactoProveedorMM = 'http://localhost/SIIS-PROYECTO/controller/contactoProveedorMM.php?opc=DeleteContactoProveedorMM'; // Eliminar
var UrlContactoProveedorMMeditar = 'http://localhost/SIIS-PROYECTO/controller/contactoProveedorMM.php?opc=GetContactoProveedorMMeditar'; // Traer el dato a editar
//Si se necesita traer datos de otra tabla para una lista desplegable
var UrlContactos = 'http://localhost/SIIS-PROYECTO/controller/contactoProveedorMM.php?opc=GetContactos'; 
var UrlProveedores = 'http://localhost/SIIS-PROYECTO/controller/contactoProveedorMM.php?opc=GetProveedores'; 

$(document).ready(function(){
    CargarContactoProveedoresMM();
    CargarContactos();
    CargarProveedores();
});

function CargarContactoProveedoresMM(){
    
    $.ajax({
        url : UrlContactoProveedoresMM,
        type: 'GET',
        datatype: 'JSON',
        success: function(reponse){
            var MisItems = reponse;
            // Si la tabla ya ha sido inicializada previamente, destruye la instancia
            if ($.fn.DataTable.isDataTable('#TablaContactoProveedores')) {
                $('#TablaContactoProveedores').DataTable().destroy();
               }
               $("#TablaContactoProveedores").DataTable({
                 processing: true,
                 data: MisItems,
                 language: {
                   url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
                 },
                 columns: [
                   { data: "Id_Proveedores_Contacto" },
                   { data: "Nombre_tipo_contacto" },
                   { data: "Nombre" },
                   { data: "Contacto" },
                   { data: "options" },
                   /*  { 
                           data: null, 
                           render: function ( data, type, row ) {
                             return '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarContactoProveedorMM(\'' + row.Id_Proveedores_Contacto + '\'); mostrarFormulario();">Editar</button>' +
                                    '<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarContactoProveedorMM(\'' + row.Id_Proveedores_Contacto + '\')">Eliminar</button>';
                           }
                        }     */
                 ],
               });
        }

    });
}

function AgregarContactoProveedorMM(){
    var datosContactoProveedorMM = {
        Id_Tipo_Contacto: $('#Select_Contacto').val(),
        Id_Proveedor: $('#Select_Proveedor').val(),
        Contacto: $('#Contacto').val()
    };
    var datosContactoProveedorMMJson=JSON.stringify(datosContactoProveedorMM);

    $.ajax({
        url:UrlInsertarContactoProveedorMM,
        type: 'POST',
        data: datosContactoProveedorMMJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(response){
            var MisItems = response;

            swal.fire({
                title: "LISTO! ",
                text:"LISTO! Contacto del proveedor Agregado" ,
                icon: "success",
                confirmButtonText: "Aceptar",
                closeOnConfirm: false,
                timer: 3000,
                willClose: () => {
                  window.location.reload();
                },
              });
        },

        error: function(textStatus, errorThrown){
            alert('Error al agregar el contacto del proveedor' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
}

function CargarContactoProveedorMM(idContacto){ //Función que trae los campos que se eligieron editar.
    var datosContactoProveedorMM = {
        Id_Proveedores_Contacto:idContacto
    };
    var datosContactoProveedorMMJson=JSON.stringify(datosContactoProveedorMM);

    $.ajax({
        url: UrlContactoProveedorMMeditar,
        type: 'POST',
        data: datosContactoProveedorMMJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            //Muestra el id junto con su título que se encuentra oculto en el Agregar.
            $('#Id_Proveedores_Contacto').removeAttr('hidden'); // ID
            $('label[for="Id_Proveedores_Contacto"]').removeAttr('hidden'); //Título
        
            $('#Id_Proveedores_Contacto').val(MisItems[0].Id_Proveedores_Contacto).prop('readonly', true);  // Propiedad para que no se pueda modificar el campo.
            $('#Select_Contacto').val(MisItems[0].Id_Tipo_Contacto);
            $('#Select_Proveedor').val(MisItems[0].Id_Proveedor);
            $('#Contacto').val(MisItems[0].Contacto);
            //Usar el mismo botón de agregar con la funcionalidad de actualizar.
            var btnactualizar = '<input type="submit" id="btn_actualizar" onclick="ActualizarContactoProveedorMM(' +MisItems[0].Id_Proveedores_Contacto+')"'+
            'value="Actualizar contacto del proveedor" class="btn btn-primary"> <button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button></input>';
            $('#btnagregarContactoProveedor').html(btnactualizar);
            $('#btncancelar').click(function(){ //Cancela la acción
                location.href = "http://localhost/SIIS-PROYECTO/Formularios/ContactoProveedorMM.php";
             });
            //Cambiar el título del formulario.
            var titulo = '<div class="Col-12" id="titulo">'+
            '<h3>Editar Contacto Del Proveedor</h3></div>';
            $('#titulo').html(titulo); 
        }
    });
}

function ActualizarContactoProveedorMM(idContacto){
    var datosContactoProveedorMM={
        Id_Proveedores_Contacto: idContacto,
        Id_Tipo_Contacto: $('#Select_Contacto').val(),
        Id_Proveedor: $('#Select_Proveedor').val(),
        Contacto: $('#Contacto').val()
    };
    var datosContactoProveedorMMJson=JSON.stringify(datosContactoProveedorMM);

    $.ajax({
        url: UrlActualizarContactoProveedorMM,
        type: 'PUT',
        data: datosContactoProveedorMMJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Contacto del proveedor Actualizado');
        },

        error: function(textStatus, errorThrown){
            alert('Error al actualizar el contacto del proveedor' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
}

function EliminarContactoProveedorMM(idContacto){
    var confirmacion = confirm("¿Está seguro de que desea eliminar el contacto del proveedor?");

    if (confirmacion == true) {
        var datosContactoProveedorMM={
            Id_Proveedores_Contacto: idContacto
        };

        var datosContactoProveedorMMJson=JSON.stringify(datosContactoProveedorMM);

        $.ajax({
            url: UrlEliminarContactoProveedorMM,
            type: 'DELETE',
            data: datosContactoProveedorMMJson,
            datatype: 'JSON',
            contentType: 'application/json',
            success: function(reponse){
                console.log(reponse);
                alert('Contacto del proveedor Eliminado');
                CargarContactoProveedoresMM();
            },

            error: function(textStatus, errorThrown){
                alert('Error al eliminar contacto del proveedor' + textStatus + errorThrown);
            }
        });

    } else {
        alert("La eliminación del proveedor ha sido cancelada.");
    }
}

//Función para traer los datos de otra tabla para poder ser seleccionados en una lista desplegable
function CargarContactos(){
    $.ajax({
        url : UrlContactos,
        type: 'GET',
        datatype: 'JSON',
        success: function(response){
            var MisItems = response;
            var opciones='';
            
            for(i=0; i<MisItems.length; i++){ //Muestra Id y nombre
                opciones += '<option value="' + MisItems[i].Id_Tipo_Contacto + '">' + ' ID ' + MisItems[i].Id_Tipo_Contacto + ' - ' + MisItems[i].Nombre_tipo_contacto + '</option>';
            }
            $('#Select_Contacto').html(opciones);
        }
    });
}

function CargarProveedores(){
    $.ajax({
        url : UrlProveedores,
        type: 'GET',
        datatype: 'JSON',
        success: function(response){
            var MisItems = response;
            var opciones='';
            
            for(i=0; i<MisItems.length; i++){ //Muestra Id y nombre
                opciones += '<option value="' + MisItems[i].Id_Proveedor + '">' + ' ID ' + MisItems[i].Id_Proveedor + ' - ' + MisItems[i].Nombre + '</option>';
            }
            $('#Select_Proveedor').html(opciones);
        }
    });
}










