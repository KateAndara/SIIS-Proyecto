var UrlTipoProductosMM = 'http://localhost/SIIS-PROYECTO/controller/tipoProductoMM.php?opc=GetTipoProductosMM';
var UrlTipoProductoMM = 'http://localhost/SIIS-PROYECTO/controller/tipoProductoMM.php?opc=GetTipoProductoMM';
var UrlInsertarTipoProductoMM = 'http://localhost/SIIS-PROYECTO/controller/tipoProductoMM.php?opc=InsertTipoProductoMM'; // Insertrar
var UrlActualizarTipoProductoMM = 'http://localhost/SIIS-PROYECTO/controller/tipoProductoMM.php?opc=UpdateTipoProductoMM'; // Editar
var UrlEliminarTipoProductoMM = 'http://localhost/SIIS-PROYECTO/controller/tipoProductoMM.php?opc=DeleteTipoProductoMM'; // Eliminar
var UrlTipoProductoMMeditar = 'http://localhost/SIIS-PROYECTO/controller/tipoProductoMM.php?opc=GetTipoProductoMMeditar'; // Traer el dato a editar

$(document).ready(function(){
   CargarTipoProductosMM();
});

function CargarTipoProductosMM(){
    
    $.ajax({
        url : UrlTipoProductosMM,
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
            if ($.fn.DataTable.isDataTable('#TablaTiposProducto')) {
                $('#TablaTiposProducto').DataTable().destroy();
               }
               $("#TablaTiposProducto").DataTable({
                 processing: true,
                 data: MisItems,
                 language: {
                   url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
                 },
                 columns: [
                   { data: 'Numero' }, // Mostrar la secuencia de números
                   { data: "Nombre_tipo" },
                   { data: "options" },
                   /*  { 
                           data: null, 
                           render: function ( data, type, row ) {
                             return '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarTipoProductoMM(\'' + row.Id_Tipo_Producto + '\'); mostrarFormulario();">Editar</button>' +
                                    '<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarTipoProductoMM(\'' + row.Id_Tipo_Producto + '\')">Eliminar</button>';
                           }
                        } */
                 ],
               });
        }

    });
}


function AgregarTipoProductoMM(){
    nombreTipo=document.querySelector("#Nombre_tipo").value;
    console.log(nombreTipo);

    if ( nombreTipo == "" ) {
         swal.fire("Atención", "Todos los campos son obligatorios.", "error");
         return false;
      }
    var datosTipoProductoMM = {
        Nombre_tipo: $('#Nombre_tipo').val()
    };
    var datosTipoProductoMMJson= JSON.stringify(datosTipoProductoMM );

    $.ajax({
        url:UrlInsertarTipoProductoMM,
        type: 'POST',
        data: datosTipoProductoMMJson,
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

function CargarTipoProductoMM(idTipo){ //Función que trae los campos que se eligieron editar.
    var datosTipoProductoMM = {
        Id_Tipo_Producto:idTipo
    };
    var datosTipoProductoMMJson=JSON.stringify(datosTipoProductoMM);

    $.ajax({
        url: UrlTipoProductoMMeditar,
        type: 'POST',
        data: datosTipoProductoMMJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            //Muestra el id junto con su título que se encuentra oculto en el Agregar.
            document.getElementById('Id_Tipo_Producto').style.display = 'none';
            $('label[for="Id_Tipo_Producto"]').removeAttr('hidden'); //Título
        
            $('#Id_Tipo_Producto').val(MisItems[0].Id_Tipo_Producto).prop('readonly', true);  // Propiedad para que no se pueda modificar el campo.
            $('#Nombre_tipo').val(MisItems[0].Nombre_tipo);

            //Usar el mismo botón de agregar con la funcionalidad de actualizar.
            var btnactualizar = '<a t id="btn_actualizar" onclick="ActualizarTipoProductoMM(' +MisItems[0].Id_Tipo_Producto+')"'+
            'value="Actualizar  Tipo De Producto" class="btn btn-primary">Actualizar  Tipo De Producto</a><button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button></input>';
            $('#btnagregarTipoProducto').html(btnactualizar);
            $('#btncancelar').click(function(){ //Cancela la acción
                location.href = "http://localhost/SIIS-PROYECTO/Formularios/TipoProductoMM.php";
             });
            //Cambiar el título del formulario.
            var titulo = '<div class="Col-12" id="titulo">'+
            '<h3 style="color: black;">Editar Tipo De Producto</h3></div>';
            $('#titulo').html(titulo); 
        }
    });
}

function ActualizarTipoProductoMM(idTipo){
    nombreTipo=document.querySelector("#Nombre_tipo").value;
    console.log(nombreTipo);

    if ( nombreTipo == "" ) {
         swal.fire("Atención", "Todos los campos son obligatorios.", "error");
         return false;
      }
    var datosTipoProductoMM={
        Id_Tipo_Producto: idTipo,
        Nombre_tipo: $('#Nombre_tipo').val()
    };
    var datosTipoProductoMMJson = JSON.stringify(datosTipoProductoMM);

    $.ajax({
        url: UrlActualizarTipoProductoMM,
        type: 'PUT',
        data: datosTipoProductoMMJson,
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

function EliminarTipoProductoMM(idTipo) {
    Swal.fire({
      title: "¿Eliminar tipo de producto?",
      text: "Estas Seguro que quieres Eliminar el tipo de producto, esta acción es irreversible",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, Eliminar!",
    }).then((result) => { 
      if (result.isConfirmed) {
        var datosTipoProductoMM = {
            Id_Tipo_Producto: idTipo,
        };
        var datosTipoProductoMM = JSON.stringify(datosTipoProductoMM);
        $.ajax({
          url: UrlEliminarTipoProductoMM,
          type: "DELETE",
          data: datosTipoProductoMM,
          datatype: "JSON",
          success: function (response) {
            Swal.fire({
              title: "Eliminado",
              text: "Tipo de producto eliminado Correctamente.",
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

