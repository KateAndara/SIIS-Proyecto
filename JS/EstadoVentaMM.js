var UrlEstadosVentaMM = 'http://localhost/SIIS-PROYECTO/controller/estadoVentaMM.php?opc=GetEstadosVentaMM';
var UrlEstadoVentaMM = 'http://localhost/SIIS-PROYECTO/controller/estadoVentaMM.php?opc=GetEstadoVentaMM';
var UrlInsertarEstadoVentaMM = 'http://localhost/SIIS-PROYECTO/controller/estadoVentaMM.php?opc=InsertEstadoVentaMM'; // Insertrar
var UrlActualizarEstadoVentaMM = 'http://localhost/SIIS-PROYECTO/controller/estadoVentaMM.php?opc=UpdateEstadoVentaMM'; // Editar
var UrlEliminarEstadoVentaMM = 'http://localhost/SIIS-PROYECTO/controller/estadoVentaMM.php?opc=DeleteEstadoVentaMM'; // Eliminar
var UrlEstadoVentaMMeditar = 'http://localhost/SIIS-PROYECTO/controller/estadoVentaMM.php?opc=GetEstadoVentaMMeditar'; // Traer el dato a editar

$(document).ready(function(){
   CargarEstadosVentaMM();
});

function CargarEstadosVentaMM(){
    
    $.ajax({
        url : UrlEstadosVentaMM,
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
            if ($.fn.DataTable.isDataTable('#TablaEstadosVenta')) {
                $('#TablaEstadosVenta').DataTable().destroy();
               }
               $("#TablaEstadosVenta").DataTable({
                 processing: true,
                 data: MisItems,
                 language: {
                   url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
                 },
                 columns: [
                  { data: 'Numero' }, // Mostrar la secuencia de números
                   { data: "Nombre_estado" },
                   { data: "options" },
                   /* {
                     data: null,
                     render: function (data, type, row) {
                       return (
                         '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarEstadoVentaMM(\'' +
                         row.Id_Estado_Venta +
                         "'); mostrarFormulario();\">Editar</button>" +
                         '<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarEstadoVentaMM(\'' +
                         row.Id_Estado_Venta +
                         "')\">Eliminar</button>"
                       );
                     },
                   }, */
                 ],
               });
        }

    });
}

function AgregarEstadoVentaMM(){
    nombreEstado=document.querySelector("#Nombre_estado").value;
    console.log(nombreEstado);

    if ( nombreEstado == "" ) {
         swal.fire("Atención", "Todos los campos son obligatorios.", "error");
         return false;
      }
    var datosEstadoVentaMM = {
        Nombre_estado: $('#Nombre_estado').val()
    };
    var datosEstadoVentaMMJson= JSON.stringify(datosEstadoVentaMM );

    $.ajax({
        url:UrlInsertarEstadoVentaMM,
        type: 'POST',
        data: datosEstadoVentaMMJson,
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
                text: "Error al guardar el Estado de Venta",
                icon: "error",
                confirmButtonText: "Aceptar",
                closeOnConfirm: false,
                timer: 4000,
               
              });
        }
    });
}

function CargarEstadoVentaMM(idEstadoVenta){ //Función que trae los campos que se eligieron editar.
    var datosEstadoVentaMM = {
        Id_Estado_Venta:idEstadoVenta
    };
    var datosEstadoVentaMMJson=JSON.stringify(datosEstadoVentaMM);

    $.ajax({
        url: UrlEstadoVentaMMeditar,
        type: 'POST',
        data: datosEstadoVentaMMJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            //Muestra el id junto con su título que se encuentra oculto en el Agregar.
            document.getElementById('Id_Estado_Venta').style.display = 'none';
            $('label[for="Id_Estado_Venta"]').removeAttr('hidden'); //Título
        
            $('#Id_Estado_Venta').val(MisItems[0].Id_Estado_Venta).prop('readonly', true);  // Propiedad para que no se pueda modificar el campo.
            $('#Nombre_estado').val(MisItems[0].Nombre_estado);

            //Usar el mismo botón de agregar con la funcionalidad de actualizar.
            var btnactualizar = '<a id="btn_actualizar" onclick="ActualizarEstadoVentaMM(' +MisItems[0].Id_Estado_Venta+')"'+
            'value="Actualizar Esatdo Del Producto" class="btn btn-primary">Actualizar Esatdo Del Producto </a> <button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button></input>';
            $('#btnagregarEstadoVenta').html(btnactualizar);
            $('#btncancelar').click(function(){ //Cancela la acción
                location.href = "http://localhost/SIIS-PROYECTO/Formularios/EstadoVentaMM.php";
             });
            //Cambiar el título del formulario.
            var titulo = '<div class="Col-12" id="titulo">'+
            '<h3 style="color: black;">Editar Estado De Venta</h3></div>';
            $('#titulo').html(titulo); 
        }
    });
}

function ActualizarEstadoVentaMM(idEstadoVenta){
    nombreEstado=document.querySelector("#Nombre_estado").value;
    console.log(nombreEstado);

    if ( nombreEstado == "" ) {
         swal.fire("Atención", "Todos los campos son obligatorios.", "error");
         return false;
      }
    var datosEstadoVentaMM={
        Id_Estado_Venta: idEstadoVenta,
        Nombre_estado: $('#Nombre_estado').val()
    };
    var datosEstadoVentaMMJson = JSON.stringify(datosEstadoVentaMM);

    $.ajax({
        url: UrlActualizarEstadoVentaMM,
        type: 'PUT',
        data: datosEstadoVentaMMJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
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

function EliminarEstadoVentaMM(idEstadoVenta) {
    Swal.fire({
      title: "¿Eliminar estao de venta?",
      text: "Estas Seguro que quieres Eliminar el estado de venta, esta acción es irreversible",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, Eliminar!",
    }).then((result) => { 
      if (result.isConfirmed) {
        var datosEstadoVentaMM = {
            Id_Estado_Venta: idEstadoVenta,
        };
        var datosEstadoVentaMM = JSON.stringify(datosEstadoVentaMM);
        $.ajax({
          url: UrlEliminarEstadoVentaMM,
          type: "DELETE",
          data: datosEstadoVentaMM,
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