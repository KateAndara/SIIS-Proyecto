var UrlEspeciesMM = 'http://localhost/SIIS-PROYECTO/controller/especiesMM.php?opc=GetEspeciesMM';
var UrlEspecieMM = 'http://localhost/SIIS-PROYECTO/controller/especiesMM.php?opc=GetEspecieMM';
var UrlInsertarEspecieMM = 'http://localhost/SIIS-PROYECTO/controller/especiesMM.php?opc=InsertEspecieMM'; // Insertrar
var UrlActualizarEspecieMM = 'http://localhost/SIIS-PROYECTO/controller/especiesMM.php?opc=UpdateEspecieMM'; // Editar
var UrlEliminarEspecieMM = 'http://localhost/SIIS-PROYECTO/controller/especiesMM.php?opc=DeleteEspecieMM'; // Eliminar
var UrlEspecieMMeditar = 'http://localhost/SIIS-PROYECTO/controller/especiesMM.php?opc=GetEspecieMMeditar'; // Traer el dato a editar

$(document).ready(function(){
   CargarEspeciesMM();
});

function CargarEspeciesMM(){
    
    $.ajax({
        url : UrlEspeciesMM,
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
            if ($.fn.DataTable.isDataTable('#TablaEspecies')) {
                $('#TablaEspecies').DataTable().destroy();
               }
               $("#TablaEspecies").DataTable({
                 processing: true,
                 data: MisItems,
                 language: {
                   url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
                 },
                 columns: [
                   { data: "Numero" },
                   { data: "Nombre_Especie" },
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

function AgregarEspecieMM(){

    nombreEspecie=document.querySelector("#Nombre_Especie").value;
    console.log(nombreEspecie);

    if ( nombreEspecie == "" ) {
         swal.fire("Atención", "Todos los campos son obligatorios.", "error");
         return false;
      }

    var datosEspecieMM = {
        Nombre_Especie: $('#Nombre_Especie').val()
    };
    var datosEspecieMMJson= JSON.stringify(datosEspecieMM );

    $.ajax({
        url:UrlInsertarEspecieMM,
        type: 'POST',
        data: datosEspecieMMJson,
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
                text: "Error al guardar el Especie",
                icon: "error",
                confirmButtonText: "Aceptar",
                closeOnConfirm: false,
                timer: 4000,
               
              });
        },
    });
}

function CargarEspecieMM(idEspecie){ //Función que trae los campos que se eligieron editar.
    var datosEspecieMM = {
        Id_Especie:idEspecie
    };
    var datosEspecieMMJson=JSON.stringify(datosEspecieMM);

    $.ajax({
        url: UrlEspecieMMeditar,
        type: 'POST',
        data: datosEspecieMMJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            //Muestra el id junto con su título que se encuentra oculto en el Agregar.
            document.getElementById('Id_Especie').style.display = 'none';
            $('label[for="Id_Especie"]').removeAttr('hidden'); //Título
        
            $('#Id_Especie').val(MisItems[0].Id_Especie).prop('readonly', true);  // Propiedad para que no se pueda modificar el campo.
            $('#Nombre_Especie').val(MisItems[0].Nombre_Especie);

            //Usar el mismo botón de agregar con la funcionalidad de actualizar.
            var btnactualizar = '<a  id="btn_actualizar" onclick="ActualizarEspecieMM(' +MisItems[0].Id_Especie+')"'+
            'value="Actualizar Especie" class="btn btn-primary">Actualizar Especie </a> <button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button></input>';
            $('#btnagregarEspecie').html(btnactualizar);
            $('#btncancelar').click(function(){ //Cancela la acción
                location.href = "http://localhost/SIIS-PROYECTO/Formularios/EspeciesMM.php";
             });
            //Cambiar el título del formulario.
            var titulo = '<div class="Col-12" id="titulo">'+
            '<h3 style="color: black;">Editar Especie</h3></div>';
            $('#titulo').html(titulo); 
        }
    });
}
 
function ActualizarEspecieMM(idEspecie){
    nombreEspecie=document.querySelector("#Nombre_Especie").value;
    console.log(nombreEspecie);

    if ( nombreEspecie == "" ) {
         swal.fire("Atención", "Todos los campos son obligatorios.", "error");
         return false;
      }

    var datosEspecieMM={
    Id_Especie: idEspecie,
    Nombre_Especie: $('#Nombre_Especie').val()
    };
    var datosEspecieMMJson = JSON.stringify(datosEspecieMM);

    $.ajax({
        url: UrlActualizarEspecieMM,
        type: 'PUT',
        data: datosEspecieMMJson,
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


function EliminarEspecieMM(idEspecie) {
    Swal.fire({
      title: "¿Eliminar Especie?",
      text: "Estas Seguro que quieres Eliminar la Especie, esta acción es irreversible",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, Eliminar!",
    }).then((result) => { 
      if (result.isConfirmed) {
        var datosEspecie = {
            Id_Especie: idEspecie,
        };
        var datosEspecie = JSON.stringify(datosEspecie);
        $.ajax({
          url: UrlEliminarEspecieMM,
          type: "DELETE",
          data: datosEspecie,
          datatype: "JSON",
          success: function (response) {
            Swal.fire({
              title: "Eliminado",
              text: "Especie eliminada Correctamente.",
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