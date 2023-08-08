var UrlCargosMM = 'http://localhost/SIIS-PROYECTO/controller/cargosMM.php?opc=GetCargosMM';
var UrlCargoMM = 'http://localhost/SIIS-PROYECTO/controller/cargosMM.php?opc=GetCargoMM';
var UrlInsertarCargoMM = 'http://localhost/SIIS-PROYECTO/controller/cargosMM.php?opc=InsertCargoMM'; // Insertrar
var UrlActualizarCargoMM = 'http://localhost/SIIS-PROYECTO/controller/cargosMM.php?opc=UpdateCargoMM'; // Editar
var UrlEliminarCargoMM = 'http://localhost/SIIS-PROYECTO/controller/cargosMM.php?opc=DeleteCargoMM'; // Eliminar
var UrlCargoMMeditar = 'http://localhost/SIIS-PROYECTO/controller/cargosMM.php?opc=GetCargoMMeditar'; // Traer el dato a editar

$(document).ready(function(){
   CargarCargosMM();
});

function CargarCargosMM(){
    
    $.ajax({
        url : UrlCargosMM,
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
            if ($.fn.DataTable.isDataTable('#TablaCargos')) {
                $('#TablaCargos').DataTable().destroy();
               }
               $("#TablaCargos").DataTable({
                 processing: true,
                 data: MisItems,
                 language: {
                   url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
                 },
                 columns: [
                  { data: 'Numero' }, // Mostrar la secuencia de números
                  { data: "Nombre_cargo" },
                   { data: "options" },
                   /* { 
                           data: null, 
                           render: function ( data, type, row ) {
                             return '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarCargoMM(\'' + row.Id_Cargo + '\'); mostrarFormulario();">Editar</button>' +
                                    '<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarCargoMM(\'' + row.Id_Cargo + '\')">Eliminar</button>';
                           }
                        }     */
                 ],
               });
        }

    });
}

function AgregarCargoMM(){

    nombreCargo=document.querySelector("#Nombre_cargo").value;
    console.log(nombreCargo);

    if ( nombreCargo == "" ) {
         swal.fire("Atención", "Todos los campos son obligatorios.", "error");
         return false;
      }

    var datosCargoMM = {
        Nombre_cargo: $('#Nombre_cargo').val()
    };
    var datosCargoMMJson= JSON.stringify(datosCargoMM );

    $.ajax({
        url:UrlInsertarCargoMM,
        type: 'POST',
        data: datosCargoMMJson,
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

function CargarCargoMM(idCargo){ //Función que trae los campos que se eligieron editar.
    var datosCargoMM = {
        Id_Cargo:idCargo
    };
    var datosCargoMMJson=JSON.stringify(datosCargoMM);

    $.ajax({
        url: UrlCargoMMeditar,
        type: 'POST',
        data: datosCargoMMJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            //Muestra el id junto con su título que se encuentra oculto en el Agregar.
            $('#Id_Cargo').removeAttr('hidden'); // ID
            $('label[for="Id_Cargo"]').removeAttr('hidden'); //Título
        
            $('#Id_Cargo').val(MisItems[0].Id_Cargo).prop('readonly', true);  // Propiedad para que no se pueda modificar el campo.
            $('#Nombre_cargo').val(MisItems[0].Nombre_cargo);

            //Usar el mismo botón de agregar con la funcionalidad de actualizar.
            var btnactualizar = '<a  id="btn_actualizar" onclick="ActualizarCargoMM(' +MisItems[0].Id_Cargo+')"'+
            'value="Actualizar Cargo" class="btn btn-primary">Actualizar Cargo </a> <button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button></input>';
            $('#btnagregarCargo').html(btnactualizar);
            $('#btncancelar').click(function(){ //Cancela la acción
                location.href = "http://localhost/SIIS-PROYECTO/Formularios/CargosMM.php";
             });
            //Cambiar el título del formulario.
            var titulo = '<div class="Col-12" id="titulo">'+
            '<h3 style="color: black;">Editar Cargo</h3></div>';
            $('#titulo').html(titulo); 
        }
    });
}

function ActualizarCargoMM(idCargo){
    nombreCargo=document.querySelector("#Nombre_cargo").value;
    console.log(nombreCargo);

    if ( nombreCargo == "" ) {
         swal.fire("Atención", "Todos los campos son obligatorios.", "error");
         return false;
      }

    var datosCargoMM={
    Id_Cargo: idCargo,
    Nombre_cargo: $('#Nombre_cargo').val()
    };
    var datosCargoMMJson = JSON.stringify(datosCargoMM);

    $.ajax({
        url: UrlActualizarCargoMM,
        type: 'PUT',
        data: datosCargoMMJson,
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


function EliminarCargoMM(idCargo) {
    Swal.fire({
      title: "¿Eliminar cargo?",
      text: "Estas Seguro que quieres Eliminar el Cargo, esta acción es irreversible",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, Eliminar!",
    }).then((result) => { 
      if (result.isConfirmed) {
        var datosCargo = {
            Id_Cargo: idCargo,
        };
        var datosCargo = JSON.stringify(datosCargo);
        $.ajax({
          url: UrlEliminarCargoMM,
          type: "DELETE",
          data: datosCargo,
          datatype: "JSON",
          success: function (response) {
            Swal.fire({
              title: "Eliminado",
              text: "Cargo eliminado Correctamente.",
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