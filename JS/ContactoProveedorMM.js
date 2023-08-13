var UrlContactoProveedoresMM = 'http://localhost/SIIS-PROYECTO/controller/contactoProveedorMM.php?opc=GetContactoProveedoresMM';
var UrlContactoProveedorMM = 'http://localhost/SIIS-PROYECTO/controller/contactoProveedorMM.php?opc=GetContactoProveedorMM';
var UrlInsertarContactoProveedorMM = 'http://localhost/SIIS-PROYECTO/controller/contactoProveedorMM.php?opc=InsertContactoProveedorMM'; // Insertrar
var UrlActualizarContactoProveedorMM = 'http://localhost/SIIS-PROYECTO/controller/contactoProveedorMM.php?opc=UpdateContactoProveedorMM'; // Editar
var UrlEliminarContactoProveedorMM = 'http://localhost/SIIS-PROYECTO/controller/contactoProveedorMM.php?opc=DeleteContactoProveedorMM'; // Eliminar
var UrlContactoProveedorMMeditar = 'http://localhost/SIIS-PROYECTO/controller/contactoProveedorMM.php?opc=GetContactoProveedorMMeditar'; // Traer el dato a editar
//Si se necesita traer datos de otra tabla para una lista desplegable
var UrlContactos = 'http://localhost/SIIS-PROYECTO/controller/contactoProveedorMM.php?opc=GetContactos'; 
var UrlProveedores = 'http://localhost/SIIS-PROYECTO/controller/contactoProveedorMM.php?opc=GetProveedores'; 
//var UrlCliente = 'http://localhost/SIIS-PROYECTO/controller/contactoClienteMM.php?opc=GetProveedor'; 

$(document).ready(function(){
    CargarContactoProveedoresMM();
    CargarContactos();
    CargarProveedores();
});

function CargarContactoProveedoresMM(){
  const urlSearchParams = new URLSearchParams(window.location.search);
  const id_proveedor_parametro = urlSearchParams.get("id");

  var datosProveedor = {
    Id_Proveedor: id_proveedor_parametro,
};
var datosProveedor = JSON.stringify(datosProveedor);
console.log(datosProveedor);
    $.ajax({
        url : UrlContactoProveedoresMM,
        type: 'POST',
        data: datosProveedor,
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
    contactoProveedor=document.querySelector("#Contacto").value;
    console.log(contactoProveedor);

    if ( contactoProveedor == "" ) {
         swal.fire("Atención", "Todos los campos son obligatorios.", "error");
         return false;
    }
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
        success: function(reponse){
            console.log(reponse.status);
                swal.fire({
                title: "LISTO!",
                text: "Contacto agregado correctamente",
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
            swal.fire({
                title: "Error!",
                text: "Error al guardar el contacto del proveedor",
                icon: "error",
                confirmButtonText: "Aceptar",
                closeOnConfirm: false,
                timer: 4000,
               
              });
        },
    });
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
            var btnactualizar = '<a id="btn_actualizar" onclick="ActualizarContactoProveedorMM(' +MisItems[0].Id_Proveedores_Contacto+')"'+
            'value="Actualizar contacto del proveedor" class="btn btn-primary">Actualizar contacto del proveedor</a> <button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button></input>';
            $('#btnagregarContactoProveedor').html(btnactualizar);
            $('#btncancelar').click(function(){ //Cancela la acción
              if (Id_Proveedor) {
                CargarContactoProveedor(Id_Proveedor);
            }
             });
            //Cambiar el título del formulario.
            var titulo = '<div class="Col-12" id="titulo">'+
            '<h3 style="color: black;">Editar Contacto Del Proveedor</h3></div>';
            $('#titulo').html(titulo); 
        }
    });
}

function ActualizarContactoProveedorMM(idContacto){
    contactoProveedor=document.querySelector("#Contacto").value;
    console.log(contactoProveedor);

    if ( contactoProveedor == "" ) {
         swal.fire("Atención", "Todos los campos son obligatorios.", "error");
         return false;
    }
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
            swal.fire({
                title: "LISTO!",
                text: "Contacto actualizado correctamente",
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
            swal.fire({
                title: "Error!",
                text: reponse,
                icon: "success",
                confirmButtonText: "Aceptar",
                closeOnConfirm: false,
                timer: 3000,
                willClose: () => {
                  window.location.reload();
                },
              });       
             },
    });
}

function EliminarContactoProveedorMM(idContacto) {
    Swal.fire({
      title: "¿Eliminar el contacto del proveedor?",
      text: "¿Estás seguro que quieres eliminar el contacto del proveedor? Esta acción es irreversible.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "¡Sí, eliminar!",
    }).then((result) => { 
      if (result.isConfirmed) {
        var datosEstadoProcesoMM = {
            Id_Proveedores_Contacto: idContacto,
        };
        var datosEstadoProcesoMM = JSON.stringify(datosEstadoProcesoMM);
        $.ajax({
          url: UrlEliminarContactoProveedorMM,
          type: "DELETE",
          data: datosEstadoProcesoMM,
          datatype: "JSON",
          success: function (response) {
            Swal.fire({
              title: "Eliminado",
              text: "Contacto del proveedor eliminado Correctamente.",
              icon: "success", 
              timer: 4000,
              willClose: () => {
                location.reload();
              },
            });
          },
          error: function(textStatus, errorThrown){
            Swal.fire({
              title: "Lo sentimos",
              text: "Los datos no pueden ser eliminados.",
              icon: "warning",
              timer: 4000,
              willClose: () => {
                location.reload();
              },
            });        
          }
        });
      }
    });
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










