var UrlObjetos = 'http://localhost/SIIS-PROYECTO/controller/objetos.php?opc=GetObjetos';
var UrlObjeto = 'http://localhost/SIIS-PROYECTO/controller/objetos.php?opc=GetObjeto';
var UrlInsertarObjeto = 'http://localhost/SIIS-PROYECTO/controller/objetos.php?opc=InsertObjeto'; // Insertrar
var UrlActualizarObjeto = 'http://localhost/SIIS-PROYECTO/controller/objetos.php?opc=UpdateObjeto'; // Editar
var UrlEliminarObjeto = 'http://localhost/SIIS-PROYECTO/controller/objetos.php?opc=DeleteObjeto'; // Eliminar
var UrlObjetoeditar = 'http://localhost/SIIS-PROYECTO/controller/objetos.php?opc=GetObjetoeditar'; // Traer el dato a editar

$(document).ready(function(){
   CargarObjetos();
});

function CargarObjetos(){
    
    $.ajax({
        url : UrlObjetos,
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
            if ($.fn.DataTable.isDataTable('#TablaObjetos')) {
             $('#TablaObjetos').DataTable().destroy();
            }
            $("#TablaObjetos").DataTable({
              processing: true,
              data: MisItems,
              language: {
                url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
              },
              columns: [
                { data: 'Numero' }, // Mostrar la secuencia de números
                { data: "Objeto" },
                { data: "Descripcion" },
                { data: "Tipo_objeto" },
                { data: "options" },
                /* { 
                        data: null, 
                        render: function ( data, type, row ) {
                          return '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarObjeto(\'' + row.Id_Objeto + '\'); mostrarFormulario();">Editar</button>' +
                                 '<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarObjeto(\'' + row.Id_Objeto + '\')">Eliminar</button>';
                        }
                      }  */
              ],
            });
        }
    });
}

/*
function BuscarObjeto(NombreObjeto){
    var datosObjeto = {
        Objeto: isNaN(NombreObjeto) ? NombreObjeto : null,
        Id_Objeto: isNaN(NombreObjeto) ? null : parseInt(NombreObjeto),

    };
    var datosObjetoJson = JSON.stringify(datosObjeto);

    $.ajax({
        url: UrlObjeto,
        type: 'POST',
        data: datosObjetoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            var Valores='';
            
            for(i=0; i<MisItems.length; i++){
                Valores+= '<tr>'+
                '<td>'+ MisItems[i].Id_Objeto +'</td>'+
                '<td>'+ MisItems[i].Objeto +'</td>'+
                '<td>'+ MisItems[i].Descripcion +'</td>'+
                '<td>'+ MisItems[i].Tipo_objeto +'</td>'+
                '<td>'+ 
                '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick=" CargarObjeto('+MisItems[i].Id_Objeto +'); mostrarFormulario();">Editar</button>'+ 
                '<button class="rounded" style="background-color: #D6234A; color: white; display: inline-block; width: 67px;"  onclick="EliminarObjeto('+MisItems[i].Id_Objeto +')">Eliminar</button>'+
                '</td>'+
            '</tr>';
            }
            $('#DataObjetos').html(Valores);
        }
    });
}
*/
function AgregarObjeto() {
    var objeto = $('#Objeto').val();
    var descripcion = $('#Descripcion').val();
    var tipoObjeto = $('#Tipo_objeto').val();
    
    // validar que no haya campos vacíos 
    if (objeto.trim() == "" || descripcion.trim() == "" || tipoObjeto.trim() == "") {
        alert("Por favor, complete todos los campos.");
        return false;
    }

    var datosObjeto = {
        Objeto: objeto,
        Descripcion: descripcion,
        Tipo_objeto: tipoObjeto
    };
    var datosObjetoJson= JSON.stringify(datosObjeto );

    $.ajax({
        url:UrlInsertarObjeto,
        type: 'POST',
        data: datosObjetoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Objeto Agregado');
        },

        error: function(textStatus, errorThrown){
            alert('Error al agregar objeto' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
}

function CargarObjeto(idObjeto){ //Función que trae los campos que se eligieron editar.
    var datosObjeto = {
        Id_Objeto:idObjeto
    };
    var datosObjetoJson=JSON.stringify(datosObjeto);

    $.ajax({
        url:UrlObjetoeditar,
        type: 'POST',
        data: datosObjetoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            //Muestra el id junto con su título que se encuentra oculto en el Agregar.
            $('#Id_Objeto').removeAttr('hidden'); // ID
            $('label[for="Id_Objeto"]').removeAttr('hidden'); //Título
        
            //$('#Id_Objeto').val(MisItems[0].Id_Objeto).prop('readonly', true);  // Propiedad para que no se pueda modificar el campo.
            document.getElementById('Id_Objeto').display = 'none';
            $('#Objeto').val(MisItems[0].Objeto).prop('readonly', true); ;
            $('#Descripcion').val(MisItems[0].Descripcion);
            $('#Tipo_objeto').val(MisItems[0].Tipo_objeto).prop('readonly', true); ;
            //Usar el mismo botón de agregar con la funcionalidad de actualizar.
            var btnactualizar = '<input type="submit" id="btn_actualizar" onclick="ActualizarObjeto(' +MisItems[0].Id_Objeto+')"'+
            'value="Actualizar Objeto" class="btn btn-primary"> <button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button></input>';
            $('#btnagregarObjeto').html(btnactualizar);
            $('#btncancelar').click(function(){ //Cancela la acción
                location.href = "http://localhost/SIIS-PROYECTO/Formularios/Objetos.php";
             });
            //Cambiar el título del formulario.
            var titulo = '<div class="Col-12" id="titulo">'+
            '<h3 style="color: black;">Editar Objeto</h3></div>';
            $('#titulo').html(titulo); 
        }
    });
}

function ActualizarObjeto(idObjeto){
    var objeto = $('#Objeto').val().trim();
    var descripcion = $('#Descripcion').val().trim();
    var tipoObjeto = $('#Tipo_objeto').val().trim();

    // validar que no hayan campos vacíos 
    if (objeto === "" || descripcion === "" || tipoObjeto === "") {
        alert("Por favor, complete todos los campos.");
        return false;
    }

    var datosObjeto={
        Id_Objeto: idObjeto,
        Objeto: objeto,
        Descripcion: descripcion,
        Tipo_objeto: tipoObjeto
    };

    var datosObjetoJson = JSON.stringify(datosObjeto);

    $.ajax({
        url: UrlActualizarObjeto,
        type: 'PUT',
        data: datosObjetoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Objeto Actualizado');
        },

        error: function(textStatus, errorThrown){
            alert('Error al actualizar objeto' + textStatus + errorThrown);
        }
    });

    alert('Aviso');
}


function EliminarObjeto(idObjeto){
    var confirmacion = confirm("¿Está seguro de que desea eliminar el objeto?");

    if (confirmacion == true) {
        var datosObjeto={
            Id_Objeto:idObjeto
        };

        var datosObjetoJson= JSON.stringify(datosObjeto);

        $.ajax({
            url: UrlEliminarObjeto,
            type: 'DELETE',
            data: datosObjetoJson,
            datatype: 'JSON',
            contentType: 'application/json',
            success: function(reponse){
                console.log(reponse);
                alert('Objeto Eliminado');
                CargarObjetos(); 
            },

            error: function(textStatus, errorThrown){
                alert('Error al eliminar Objeto' + textStatus + errorThrown);
            }
        });

    } else {
        alert("La eliminación del objeto ha sido cancelada.");
    }
}



