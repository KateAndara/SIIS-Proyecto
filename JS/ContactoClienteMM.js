var UrlContactoClientesMM = 'http://localhost/SIIS-PROYECTO/controller/contactoClienteMM.php?opc=GetContactoClientesMM';
var UrlContactoClienteMM = 'http://localhost/SIIS-PROYECTO/controller/contactoClienteMM.php?opc=GetContactoClienteMM';
var UrlInsertarContactoClienteMM = 'http://localhost/SIIS-PROYECTO/controller/contactoClienteMM.php?opc=InsertContactoClienteMM'; // Insertrar
var UrlActualizarContactoClienteMM = 'http://localhost/SIIS-PROYECTO/controller/contactoClienteMM.php?opc=UpdateContactoClienteMM'; // Editar
var UrlEliminarContactoClienteMM = 'http://localhost/SIIS-PROYECTO/controller/contactoClienteMM.php?opc=DeleteContactoClienteMM'; // Eliminar
var UrlContactoClienteMMeditar = 'http://localhost/SIIS-PROYECTO/controller/contactoClienteMM.php?opc=GetContactoClienteMMeditar'; // Traer el dato a editar
//Si se necesita traer datos de otra tabla para una lista desplegable
var UrlContactos = 'http://localhost/SIIS-PROYECTO/controller/contactoClienteMM.php?opc=GetContactos'; 
var UrlClientes = 'http://localhost/SIIS-PROYECTO/controller/contactoClienteMM.php?opc=GetClientes'; 

$(document).ready(function(){
   CargarContactoClientesMM();
   CargarContactos();
   CargarClientes();
});

function CargarContactoClientesMM(){
    
    $.ajax({
        url : UrlContactoClientesMM,
        type: 'GET',
        datatype: 'JSON',
        success: function(reponse){
            var MisItems = reponse;
            // Si la tabla ya ha sido inicializada previamente, destruye la instancia
            if ($.fn.DataTable.isDataTable('#TablaContactoClientes')) {
                $('#TablaContactoClientes').DataTable().destroy();
               }
               $("#TablaContactoClientes").DataTable({
                 processing: true,
                 data: MisItems,
                 language: {
                   url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
                 },
                 columns: [
                   { data: "Id_Cliente_Contacto" },
                   { data: "Nombre_tipo_contacto" },
                   { data: "Nombre" },
                   { data: "Contacto" },
                   { data: "options" },
                   /*  { 
                           data: null, 
                           render: function ( data, type, row ) {
                             return '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarContactoClienteMM(\'' + row.Id_Cliente_Contacto + '\'); mostrarFormulario();">Editar</button>' +
                                    '<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarContactoClienteMM(\'' + row.Id_Cliente_Contacto + '\')">Eliminar</button>';
                           }
                        }    */
                 ],
               });
        } 

    });
}

function AgregarContactoClienteMM(){
    contactoCliente=document.querySelector("#Contacto").value;
    console.log(contactoCliente);

    if ( contactoCliente == "" ) {
         swal.fire("Atención", "Todos los campos son obligatorios.", "error");
         return false;
    }
    var datosContactoClienteMM = {
        Id_Tipo_Contacto: $('#Select_Contacto').val(),
        Id_Cliente: $('#Select_Cliente').val(),
        Contacto: $('#Contacto').val()
    };
    var datosContactoClienteMMJson=JSON.stringify(datosContactoClienteMM);

    $.ajax({
        url:UrlInsertarContactoClienteMM,
        type: 'POST',
        data: datosContactoClienteMMJson,
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
                text: "Error al guardar el contacto del cliente",
                icon: "error",
                confirmButtonText: "Aceptar",
                closeOnConfirm: false,
                timer: 4000,
               
              });
        },
    });
}

function CargarContactoClienteMM(idContacto){ //Función que trae los campos que se eligieron editar.
    var datosContactoClienteMM = {
        Id_Cliente_Contacto:idContacto
    };
    var datosContactoClienteMMJson=JSON.stringify(datosContactoClienteMM);

    $.ajax({
        url: UrlContactoClienteMMeditar,
        type: 'POST',
        data: datosContactoClienteMMJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            //Muestra el id junto con su título que se encuentra oculto en el Agregar.
            $('#Id_Cliente_Contacto').removeAttr('hidden'); // ID
            $('label[for="Id_Cliente_Contacto"]').removeAttr('hidden'); //Título
        
            $('#Id_Cliente_Contacto').val(MisItems[0].Id_Cliente_Contacto).prop('readonly', true);  // Propiedad para que no se pueda modificar el campo.
            $('#Select_Contacto').val(MisItems[0].Id_Tipo_Contacto);
            $('#Select_Cliente').val(MisItems[0].Id_Cliente);
            $('#Contacto').val(MisItems[0].Contacto);
            //Usar el mismo botón de agregar con la funcionalidad de actualizar.
            var btnactualizar = '<a  id="btn_actualizar" onclick="ActualizarContactoClienteMM(' +MisItems[0].Id_Cliente_Contacto+')"'+
            'value="Actualizar contacto del cliente" class="btn btn-primary">Actualizar contacto del cliente</a> <button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button></input>';
            $('#btnagregarContactoCliente').html(btnactualizar);
            $('#btncancelar').click(function(){ //Cancela la acción
                location.href = "http://localhost/SIIS-PROYECTO/Formularios/ContactoClienteMM.php";
             });
            //Cambiar el título del formulario.
            var titulo = '<div class="Col-12" id="titulo">'+
            '<h3>Editar Contacto Del Cliente</h3></div>';
            $('#titulo').html(titulo); 
        }
    });
} 

function ActualizarContactoClienteMM(idContacto){
    contactoCliente=document.querySelector("#Contacto").value;
    console.log(contactoCliente);

    if ( contactoCliente == "" ) {
         swal.fire("Atención", "Todos los campos son obligatorios.", "error");
         return false;
    }
    var datosContactoClienteMM={
        Id_Cliente_Contacto: idContacto,
        Id_Tipo_Contacto: $('#Select_Contacto').val(),
        Id_Cliente: $('#Select_Cliente').val(),
        Contacto: $('#Contacto').val()
    };
    var datosContactoClienteMMJson=JSON.stringify(datosContactoClienteMM);

    $.ajax({
        url: UrlActualizarContactoClienteMM,
        type: 'PUT',
        data: datosContactoClienteMMJson,
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

function EliminarContactoClienteMM(idContacto) {
    Swal.fire({
      title: "¿Eliminar estado del contacto del cliente?",
      text: "Estas Seguro que quieres Eliminar el contacto del cliente, esta acción es irreversible",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, Eliminar!",
    }).then((result) => { 
      if (result.isConfirmed) {
        var datosEstadoProcesoMM = {
            Id_Cliente_Contacto: idContacto,
        };
        var datosEstadoProcesoMM = JSON.stringify(datosEstadoProcesoMM);
        $.ajax({
          url: UrlEliminarContactoClienteMM,
          type: "DELETE",
          data: datosEstadoProcesoMM,
          datatype: "JSON",
          success: function (response) {
            Swal.fire({
              title: "Eliminado",
              text: "Contacto del cliente eliminado Correctamente.",
              icon: "success",
              timer: 4000,
              willClose: () => {
                location.reload();
              },
            });
          },
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

function CargarClientes(){
    $.ajax({
        url : UrlClientes,
        type: 'GET',
        datatype: 'JSON',
        success: function(response){
            var MisItems = response;
            var opciones='';
            
            for(i=0; i<MisItems.length; i++){ //Muestra Id y nombre
                opciones += '<option value="' + MisItems[i].Id_Cliente + '">' + ' ID ' + MisItems[i].Id_Cliente + ' - ' + MisItems[i].Nombre + '</option>';
            }
            $('#Select_Cliente').html(opciones);
        }
    });
}









