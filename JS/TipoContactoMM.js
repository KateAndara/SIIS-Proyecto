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
            var secuencia = 1; // Agregar una variable para la secuencia de números
            
            // Recorrer los datos y agregar la secuencia de números
            for (i = 0; i < MisItems.length; i++) {
                MisItems[i].Numero = secuencia;
                secuencia++;
            }
            // Si la tabla ya ha sido inicializada previamente, destruye la instancia
            if ($.fn.DataTable.isDataTable('#TablaTipoContactos')) {
                $('#TablaTipoContactos').DataTable().destroy();
               }
               $("#TablaTipoContactos").DataTable({
                 processing: true,
                 data: MisItems,
                 language: {
                   url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
                 },
                 columns: [
                   { data: 'Numero' }, // Mostrar la secuencia de números
                   { data: "Nombre_tipo_contacto" },
                   { data: "options" },
                   /*    { 
                           data: null, 
                           render: function ( data, type, row ) {
                             return '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarTipoContactoMM(\'' + row.Id_Tipo_Contacto + '\'); mostrarFormulario();">Editar</button>' +
                                    '<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarTipoContactoMM(\'' + row.Id_Tipo_Contacto + '\')">Eliminar</button>';
                           }
                        }  */
                 ],
               });
        }

    });
}

function AgregarTipoContactoMM(){
    nombreTipo=document.querySelector("#Nombre_tipo_contacto").value;
    console.log(nombreTipo);

    if ( nombreTipo == "" ) {
         swal.fire("Atención", "Todos los campos son obligatorios.", "error");
         return false;
      }
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
            console.log(reponse.status);
            if (reponse.status) {
                swal.fire({
                title: "LISTO!",
                text: reponse.msg,
                icon: "success",
                confirmButtonText: "Aceptar",
                closeOnConfirm: false,
                timer: 3000,
                willClose: () => {
                    window.location.reload();
                },
                });
            } else {
                swal.fire({
                title: "Error!",
                text: reponse.msg,
                icon: "error",
                confirmButtonText: "Aceptar",
                closeOnConfirm: false,
                
                });
            }
        },

        error: function(textStatus, errorThrown){
            swal.fire({
                title: "Error!",
                text: "Error al guardar el Cargo",
                icon: "error",
                confirmButtonText: "Aceptar",
                closeOnConfirm: false,
                timer: 4000,
               
              });
        },
    });
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
            document.getElementById('Id_Tipo_Contacto').style.display = 'none';
            $('label[for="Id_Tipo_Contacto"]').removeAttr('hidden'); //Título
        
            $('#Id_Tipo_Contacto').val(MisItems[0].Id_Tipo_Contacto).prop('readonly', true);  // Propiedad para que no se pueda modificar el campo.
            $('#Nombre_tipo_contacto').val(MisItems[0].Nombre_tipo_contacto);

             //Usar el mismo botón de agregar con la funcionalidad de actualizar.
            var btnactualizar = '<a id="btn_actualizar" onclick="ActualizarTipoContactoMM(' +MisItems[0].Id_Tipo_Contacto+')"'+
            'value="Actualizar Tipo Contacto" class="btn btn-primary">Actualizar Tipo Contacto </a><button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button></input>';
            $('#btnagregarTipoContacto').html(btnactualizar);
            $('#btncancelar').click(function(){ //Cancela la acción
                location.href = "http://localhost/SIIS-PROYECTO/Formularios/TipoContactoMM.php";
             });
            //Cambiar el título del formulario.
            var titulo = '<div class="Col-12" id="titulo">'+
            '<h3 style="color: black;">Editar Tipo Contacto</h3></div>';
            $('#titulo').html(titulo); 
        }
    });
}

function ActualizarTipoContactoMM(idTipoContacto){
    nombreTipo=document.querySelector("#Nombre_tipo_contacto").value;
    console.log(nombreTipo);

    if ( nombreTipo == "" ) {
         swal.fire("Atención", "Todos los campos son obligatorios.", "error");
         return false;
      }
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
            if (reponse.status) {
                swal.fire({
                  title: "LISTO!",
                  text: reponse.msg,
                  icon: "success",
                  confirmButtonText: "Aceptar",
                  closeOnConfirm: false,
                  timer: 3000,
                  willClose: () => {
                    window.location.reload();
                  },
                });
              } else {
                swal.fire({
                  title: "Error!",
                  text: reponse.msg,
                  icon: "error",
                  confirmButtonText: "Aceptar",
                  closeOnConfirm: false,
                });
              }
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

function EliminarTipoContactoMM(idTipo) {
    Swal.fire({
      title: "¿Eliminar tipo de contacto?",
      text: "Estas Seguro que quieres Eliminar el tipo de contacto, esta acción es irreversible",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, Eliminar!",
    }).then((result) => { 
      if (result.isConfirmed) {
        var datosTipoContactoMM = {
            Id_Tipo_Contacto: idTipo,
        };
        var datosTipoContactoMM = JSON.stringify(datosTipoContactoMM);
        $.ajax({
          url: UrlEliminarTipoContactoMM,
          type: "DELETE",
          data: datosTipoContactoMM,
          datatype: "JSON",
          success: function (response) {
            Swal.fire({
              title: "Eliminado",
              text: "Tipo de contacto eliminado Correctamente.",
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