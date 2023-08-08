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
            var secuencia = 1; // Agregar una variable para la secuencia de números
            
            // Recorrer los datos y agregar la secuencia de números
            for (i = 0; i < MisItems.length; i++) {
                MisItems[i].Numero = secuencia;
                secuencia++;
            }
            // Si la tabla ya ha sido inicializada previamente, destruye la instancia
            if ($.fn.DataTable.isDataTable('#TablaEstadoProcesos')) {
                $('#TablaEstadoProcesos').DataTable().destroy();
               }
               $("#TablaEstadoProcesos").DataTable({
                 processing: true,
                 data: MisItems,
                 language: {
                   url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
                 },
                 columns: [
                   { data: 'Numero' }, // Mostrar la secuencia de números
                   { data: "Descripcion" },
                   { data: "options" },
                   /* { 
                           data: null, 
                           render: function ( data, type, row ) {
                             return '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarEstadoProcesoMM(\'' + row.Id_Estado_Proceso + '\'); mostrarFormulario();">Editar</button>' +
                                    '<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarEstadoProcesoMM(\'' + row.Id_Estado_Proceso + '\')">Eliminar</button>';
                           }
                        }   */
                 ],
               });
        }

    });
}

function AgregarEstadoProcesoMM(){
    nombreEstado=document.querySelector("#Descripcion").value;
    console.log(nombreEstado);

    if ( nombreEstado == "" ) {
         swal.fire("Atención", "Todos los campos son obligatorios.", "error");
         return false;
    }
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
            var btnactualizar = '<a id="btn_actualizar" onclick="ActualizarEstadoProcesoMM(' +MisItems[0].Id_Estado_Proceso+')"'+
            'value="Actualizar Estado Del Proceso" class="btn btn-primary">Actualizar Estado Del Proceso</a> <button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button></input>';
            $('#btnagregarEstadoProceso').html(btnactualizar);
            $('#btncancelar').click(function(){ //Cancela la acción
                location.href = "http://localhost/SIIS-PROYECTO/Formularios/EstadoProcesoMM.php";
             });
            //Cambiar el título del formulario.
            var titulo = '<div class="Col-12" id="titulo">'+
            '<h3 style="color: black;">Editar Estado del proceso</h3></div>';
            $('#titulo').html(titulo); 
        }
    });
}

function ActualizarEstadoProcesoMM(idEstado){ 
    nombreEstado=document.querySelector("#Descripcion").value;
    console.log(nombreEstado);

    if ( nombreEstado == "" ) {
         swal.fire("Atención", "Todos los campos son obligatorios.", "error");
         return false;
    }
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

function EliminarEstadoProcesoMM(idEstado) {
    Swal.fire({
      title: "¿Eliminar estado del proceso?",
      text: "Estas Seguro que quieres Eliminar el estado del proceso, esta acción es irreversible",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, Eliminar!",
    }).then((result) => { 
      if (result.isConfirmed) {
        var datosEstadoProcesoMM = {
            Id_Estado_Proceso: idEstado,
        };
        var datosEstadoProcesoMM = JSON.stringify(datosEstadoProcesoMM);
        $.ajax({
          url: UrlEliminarEstadoProcesoMM,
          type: "DELETE",
          data: datosEstadoProcesoMM,
          datatype: "JSON",
          success: function (response) {
            Swal.fire({
              title: "Eliminado",
              text: "Estado de venta eliminado Correctamente.",
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

