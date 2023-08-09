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
            var secuencia = 1; // Agregar una variable para la secuencia de números
            
            // Recorrer los datos y agregar la secuencia de números
            for (i = 0; i < MisItems.length; i++) {
                MisItems[i].Numero = secuencia;
                secuencia++;
            }
            // Si la tabla ya ha sido inicializada previamente, destruye la instancia
            if ($.fn.DataTable.isDataTable('#TablaTipoMovimientos')) {
                $('#TablaTipoMovimientos').DataTable().destroy();
               }
               $("#TablaTipoMovimientos").DataTable({
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
                             return '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarTipoMovimientoMM(\'' + row.Id_Tipo_Movimiento + '\'); mostrarFormulario();">Editar</button>' +
                                    '<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarTipoMovimientoMM(\'' + row.Id_Tipo_Movimiento + '\')">Eliminar</button>';
                           }
                        }  */
                 ],
               });
        }

    });
}

function AgregarTipoMovimientoMM(){
    nombreTipo=document.querySelector("#Descripcion").value;
    console.log(nombreTipo);

    if ( nombreTipo == "" ) {
         swal.fire("Atención", "Todos los campos son obligatorios.", "error");
         return false;
      }
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
            document.getElementById('Id_Tipo_Movimiento').style.display = 'none';
            $('label[for="Id_Tipo_Movimiento"]').removeAttr('hidden'); //Título
        
            $('#Id_Tipo_Movimiento').val(MisItems[0].Id_Tipo_Movimiento).prop('readonly', true);  // Propiedad para que no se pueda modificar el campo.
            $('#Descripcion').val(MisItems[0].Descripcion);

            //Usar el mismo botón de agregar con la funcionalidad de actualizar.
            var btnactualizar = '<a id="btn_actualizar" onclick="ActualizarTipoMovimientoMM(' +MisItems[0].Id_Tipo_Movimiento+')"'+
            'value="Actualizar Tipo movimiento" class="btn btn-primary">Actualizar Tipo movimiento</a><button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button></input>';
            $('#btnagregarTipoMovimiento').html(btnactualizar);
            $('#btncancelar').click(function(){ //Cancela la acción
                location.href = "http://localhost/SIIS-PROYECTO/Formularios/TipoMovimientoMM.php";
             });
            //Cambiar el título del formulario.
            var titulo = '<div class="Col-12" id="titulo">'+
            '<h3 style="color: black;">Editar Tipo movimiento</h3></div>';
            $('#titulo').html(titulo); 
        }
    });
}

function ActualizarTipoMovimientoMM(idTipoMovimiento){
    nombreTipo=document.querySelector("#Descripcion").value;
    console.log(nombreTipo);

    if ( nombreTipo == "" ) {
         swal.fire("Atención", "Todos los campos son obligatorios.", "error");
         return false;
      }
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

function EliminarTipoMovimientoMM(idTipo) {
    Swal.fire({
      title: "¿Eliminar tipo de movimiento?",
      text: "Estas Seguro que quieres Eliminar el tipo de movimiento, esta acción es irreversible",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, Eliminar!",
    }).then((result) => { 
      if (result.isConfirmed) {
        var datosTipoMovimiento = {
            Id_Tipo_Movimiento: idTipo,
        };
        var datosTipoMovimiento = JSON.stringify(datosTipoMovimiento);
        $.ajax({
          url: UrlEliminarTipoMovimientoMM,
          type: "DELETE",
          data: datosTipoMovimiento,
          datatype: "JSON",
          success: function (response) {
            Swal.fire({
              title: "Eliminado",
              text: "Tipo de movimiento eliminado Correctamente.",
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

