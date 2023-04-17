var UrlParametros = 'http://localhost/SIIS-PROYECTO/controller/parametros.php?opc=GetParametros';
var UrlParametro = 'http://localhost/SIIS-PROYECTO/controller/parametros.php?opc=GetParametro';
var UrlInsertarParametro = 'http://localhost/SIIS-PROYECTO/controller/parametros.php?opc=InsertParametro'; // Insertrar
var UrlActualizarParametro = 'http://localhost/SIIS-PROYECTO/controller/parametros.php?opc=UpdateParametro'; // Editar
var UrlEliminarParametro = 'http://localhost/SIIS-PROYECTO/controller/parametros.php?opc=DeleteParametro'; // Eliminar
var UrlParametroeditar = 'http://localhost/SIIS-PROYECTO/controller/parametros.php?opc=GetParametroeditar'; // Traer el dato a editar

$(document).ready(function(){
   CargarParametros();
});

function CargarParametros(){
    
    $.ajax({
        url : UrlParametros,
        type: 'GET',
        datatype: 'JSON',
        success: function(reponse){
            var MisItems = reponse;
            // Si la tabla ya ha sido inicializada previamente, destruye la instancia
            if ($.fn.DataTable.isDataTable('#TablaParametros')) {
                $('#TablaParametros').DataTable().destroy();
               }
               $("#TablaParametros").DataTable({
                 processing: true,
                 data: MisItems,
                 language: {
                   url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
                 },
                 columns: [
                   { data: "Id_Parametro" },
                   { data: "Parametro" },
                   { data: "Valor" },
                   { data: "options" },

                   /*  { 
                           data: null, 
                           render: function ( data, type, row ) {
                             return '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarParametro(\'' + row.Id_Parametro + '\'); mostrarFormulario();">Editar</button>';
                           }
                         }   */
                 ],
               });
           }
       });
   }

/*function BuscarParametro(NombreParametro){
    var datosParametro = {
        Nombre: isNaN(NombreParametro) ? NombreParametro : null,
        Id_Parametro: isNaN(NombreParametro) ? null : parseInt(NombreParametro),
        Parametro:isNaN(NombreParametro) ? null : parseInt(NombreParametro)

    };
    var datosParametroJson = JSON.stringify(datosParametro);

    $.ajax({
        url: UrlParametro,
        type: 'POST',
        data: datosParametroJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            var Valores='';
            
            for(i=0; i<MisItems.length; i++){
                Valores+= '<tr>'+
                '<td>'+ MisItems[i].Id_Parametro +'</td>'+
                '<td>'+ MisItems[i].Parametro +'</td>'+
                '<td>'+ MisItems[i].Valor +'</td>'+
                '<td>'+ 
                '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick=" CargarParametro('+MisItems[i].Id_Parametro +'); mostrarFormulario();">Editar</button>'+ 
                '</td>'+
            '</tr>';
            }
            $('#DataParametros').html(Valores);
        }
    });
}*/

function AgregarParametro(){
    var datosParametro = {
    Parametro: $('#Parametro').val(),
    Valor: $('#Valor').val()
    };
    var datosParametroJson= JSON.stringify(datosParametro);

    $.ajax({
        url:UrlInsertarParametro,
        type: 'POST',
        data: datosParametroJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Parámetro Agregado');
        },

        error: function(textStatus, errorThrown){
            alert('Error al agregar parámetro' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
}

function CargarParametro(idParametro){ //Función que trae los campos que se eligieron editar.
    var datosParametro = {
        Id_Parametro:idParametro
    };
    var datosParametroJson=JSON.stringify(datosParametro);

    $.ajax({
        url:UrlParametroeditar,
        type: 'POST',
        data: datosParametroJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            //Muestra el id junto con su título que se encuentra oculto en el Agregar.
            $('#Id_Parametro').removeAttr('hidden'); // ID
            $('label[for="Id_Parametro"]').removeAttr('hidden'); //Título
        
            $('#Id_Parametro').val(MisItems[0].Id_Parametro).prop('readonly', true);  // Propiedad para que no se pueda modificar el campo.
            $('#Parametro').val(MisItems[0].Parametro).prop('readonly', true); ;
            $('#Valor').val(MisItems[0].Valor);
            //Usar el mismo botón de agregar con la funcionalidad de actualizar.
            var btnactualizar = '<input type="submit" id="btn_actualizar" onclick="ActualizarParametro(' +MisItems[0].Id_Parametro+')"'+
            'value="Actualizar Parámetro" class="btn btn-primary"> <button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button></input>';
            $('#btnagregarParametro').html(btnactualizar);
            $('#btncancelar').click(function(){ //Cancela la acción
                location.href = "http://localhost/SIIS-PROYECTO/Formularios/Parametros.php";
             });
            //Cambiar el título del formulario.
            var titulo = '<div class="Col-12" id="titulo">'+
            '<h3>Editar Parámetro</h3></div>';
            $('#titulo').html(titulo); 
        }
    });
}

function ActualizarParametro(idParametro){
    var datosParametro={
    Id_Parametro: idParametro,
    Parametro: $('#Parametro').val(),
    Valor: $('#Valor').val()
    };
    var datosParametroJson = JSON.stringify(datosParametro);

    $.ajax({
        url: UrlActualizarParametro,
        type: 'PUT',
        data: datosParametroJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Parámetro Actualizado');
        },

        error: function(textStatus, errorThrown){
            alert('Error al actualizar parámetro' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
}

function EliminarParametro(idParametro){
    var confirmacion = confirm("¿Está seguro de que desea eliminar el parámetro?");

    if (confirmacion == true) {
        var datosParametro={
            Id_Parametro:idParametro
        };

        var datosParametroJson= JSON.stringify(datosParametro);

        $.ajax({
            url: UrlEliminarParametro,
            type: 'DELETE',
            data: datosParametroJson,
            datatype: 'JSON',
            contentType: 'application/json',
            success: function(reponse){
                console.log(reponse);
                alert('Parámetro Eliminado');
                CargarParametros(); 
            },

            error: function(textStatus, errorThrown){
                alert('Error al eliminar Parámetro' + textStatus + errorThrown);
            }
        });

    } else {
        alert("La eliminación del parámetro ha sido cancelada.");
    }
}
