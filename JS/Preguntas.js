var UrlPreguntas = 'http://localhost/SIIS-PROYECTO/controller/preguntas.php?opc=GetPreguntas';
var UrlPregunta = 'http://localhost/SIIS-PROYECTO/controller/preguntas.php?opc=GetPregunta';
var UrlInsertarPregunta = 'http://localhost/SIIS-PROYECTO/controller/preguntas.php?opc=InsertPregunta'; // Insertrar
var UrlActualizarPregunta = 'http://localhost/SIIS-PROYECTO/controller/preguntas.php?opc=UpdatePregunta'; // Editar
var UrlEliminarPregunta = 'http://localhost/SIIS-PROYECTO/controller/preguntas.php?opc=DeletePregunta'; // Eliminar
var UrlPreguntaeditar = 'http://localhost/SIIS-PROYECTO/controller/preguntas.php?opc=GetPreguntaeditar'; // Traer el dato a editar


$(document).ready(function(){

    CargarPreguntas(); 
});
function CargarPreguntas(){
    
    $.ajax({
        url : UrlPreguntas,
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
            if ($.fn.DataTable.isDataTable('#TablaPreguntas')) {
                $('#TablaPreguntas').DataTable().destroy();
               }
               $("#TablaPreguntas").DataTable({
                 processing: true,
                 data: MisItems,
                 language: {
                   url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
                 },
                 columns: [
                   { data: 'Numero' }, // Mostrar la secuencia de números
                   { data: "Pregunta" },
                   { data: "options" },

                   /* { 
                           data: null, 
                           render: function ( data, type, row ) {
                             return '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarPregunta(\'' + row.Id_Pregunta + '\'); mostrarFormulario();">Editar</button>' +
                                    '<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarPregunta(\'' + row.Id_Pregunta + '\')">Eliminar</button>';
                           }
                         }   */
                 ],
               });
           }
       });
   }



function BuscarPregunta(NombrePregunta){
    var datosPregunta = {
        Pregunta: isNaN(NombrePregunta) ? NombrePregunta : null,
        Id_Pregunta: isNaN(NombrePregunta) ? null : parseInt(NombrePregunta),

    };
    var datosPreguntaJson = JSON.stringify(datosPregunta);

    $.ajax({
        url: UrlPregunta,
        type: 'POST',
        data: datosPreguntaJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            var Valores='';
            
            for(i=0; i<MisItems.length; i++){
                Valores+= '<tr>'+
                '<td>'+ MisItems[i].Id_Pregunta +'</td>'+
                '<td>'+ MisItems[i].Pregunta +'</td>'+
                '<td>'+ 
                '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick=" CargarPregunta('+MisItems[i].Id_Pregunta +'); mostrarFormulario();">Editar</button>'+ 
                '<button class="rounded" style="background-color: #D6234A; color: white; display: inline-block; width: 67px;"  onclick="EliminarPregunta('+MisItems[i].Id_Pregunta +')">Eliminar</button>'+
                '</td>'+
            '</tr>';
            }
            $('#DataPreguntas').html(Valores);
        }
    });
}

function AgregarPregunta(){
    var pregunta = $('#Pregunta').val();
    
    //Permitir letras y espacios
    var patron = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s?¿]+$/;
    //validar que no hayan campos vacíos 
    if (pregunta.trim() == "") {
        alert("Por favor, complete todos los campos.");
        return false;
    } else if (!patron.test(pregunta)) {
        alert("Por favor utiliza solo letras, signos de pregunta y espacios");
        return false;
    }

    
    var datosPregunta = {
        Pregunta: pregunta
    };
    var datosPreguntaJson= JSON.stringify(datosPregunta);

    $.ajax({
        url:UrlInsertarPregunta,
        type: 'POST',
        data: datosPreguntaJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(response){
            console.log(response);
            alert('Pregunta agregada correctamente.');
            CargarPreguntas();
        },

        error: function (textStatus, errorThrown) {
            alert('Error al agregar la pregunta: ' + textStatus + ' ' + errorThrown);
        }
    });
}




function CargarPregunta(idPregunta){ //Función que trae los campos que se eligieron editar.
    var datosPregunta = {
        Id_Pregunta:idPregunta
    };
    var datosPreguntaJson=JSON.stringify(datosPregunta);

    $.ajax({
        url: UrlPreguntaeditar,
        type: 'POST',
        data: datosPreguntaJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            //Muestra el id junto con su título que se encuentra oculto en el Agregar.
            $('#Id_Pregunta').removeAttr('hidden'); // ID
            $('label[for="Id_Pregunta"]').removeAttr('hidden'); //Título
        
            $('#Id_Pregunta').val(MisItems[0].Id_Pregunta).prop('readonly', true);  // Propiedad para que no se pueda modificar el campo.
            $('#Pregunta').val(MisItems[0].Pregunta);
            //Usar el mismo botón de agregar con la funcionalidad de actualizar.
            var btnactualizar = '<input type="submit" id="btn_actualizar" onclick="ActualizarPregunta(' +MisItems[0].Id_Pregunta+')"'+
            'value="Actualizar Pregunta" class="btn btn-primary"> <button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button></input>';
            $('#btnagregarPregunta').html(btnactualizar);
            $('#btncancelar').click(function(){ //Cancela la acción
                location.href = "http://localhost/SIIS-PROYECTO/Formularios/Preguntas.php";
             });
            //Cambiar el título del formulario.
            var titulo = '<div class="Col-12" id="titulo">'+
            '<h3 style="color: black;">Editar Pregunta</h3></div>';
            $('#titulo').html(titulo); 
        }
    });
}

function ActualizarPregunta(idPregunta){
    
    var pregunta = $('#Pregunta').val();
    
    //Permitir letras y espacios
    var patron = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s?¿]+$/;
    //validar que no hayan campos vacíos 
    if (pregunta.trim() == "") {
        alert("Por favor, complete todos los campos.");
        return false;
    } else if (!patron.test(pregunta)) {
        alert("Por favor utiliza solo letras, signos de pregunta y espacios");
        return false;
    }
    
    var datosPregunta={
        Id_Pregunta: idPregunta,
        Pregunta: pregunta
    };
    var datosPreguntaJson = JSON.stringify(datosPregunta);

    $.ajax({
        url: UrlActualizarPregunta,
        type: 'PUT',
        data: datosPreguntaJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Pregunta Actualizada');
        },

        error: function(textStatus, errorThrown){
            alert('Error al actualizar pregunta' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
}

function EliminarPregunta(idPregunta){
    Swal.fire({
        title: "¿Desea eliminar la pregunta?",
        text: "Estas Seguro que quieres Eliminar esta Preegunta, esta acción es irreversible",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, Eliminar!",
      }).then((result) => {
        if (result.isConfirmed) {
            var datosPregunta={
                Id_Pregunta:idPregunta
            };       

        var datosPreguntaJson= JSON.stringify(datosPregunta);

        $.ajax({
            url: UrlEliminarPregunta,
            type: 'DELETE',
            data: datosPreguntaJson,
            datatype: 'JSON',
            contentType: 'application/json',
            success: function (response) {
                //Swal.fire("Cancelada!", "Compra Cancelada Correctamente.", "success");
                Swal.fire({
                  title: "Eliminada",
                  text: "Pregunta Eliminada Correctamente",
                  icon: "success",
                  timer: 3000,
                  willClose: () => {
                    location.reload();
                  },
                });
              },
              error: function(textStatus, errorThrown){
                Swal.fire({
                    title: 'Esta Pregunta no puede ser eliminada',
                    icon: 'error',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar'
                });
            }
            });
          }
        });
     }
     

function mostrarSweetAlert(mensaje, tipo) {
    swal({
      title: "",
      text: mensaje,
      icon: tipo,
      button: false,
      timer: 2000 // tiempo en milisegundos
    }).then(function () {
      // aquí podemos agregar más acciones que queremos que sucedan después de cerrar la alerta
    });
  }
