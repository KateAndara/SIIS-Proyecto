var UrlDescuentos = 'http://localhost/SIIS-PROYECTO/controller/descuentos.php?opc=GetDescuentos'; //Traer todos los datos
var UrlDescuento = 'http://localhost/SIIS-PROYECTO/controller/descuentos.php?opc=GetDescuento';     //Traer los datos de búsqueda
var UrlInsertarDescuentos = 'http://localhost/SIIS-PROYECTO/controller/descuentos.php?opc=InsertDescuento'; // Insertrar
var UrlActualizarDescuentos = 'http://localhost/SIIS-PROYECTO/controller/descuentos.php?opc=UpdateDescuento'; // Editar
var UrlEliminarDescuentos = 'http://localhost/SIIS-PROYECTO/controller/descuentos.php?opc=DeleteDescuento'; // Eliminar
var UrlDescuentoeditar = 'http://localhost/SIIS-PROYECTO/controller/descuentos.php?opc=GetDescuentoeditar'; // Traer el dato a editar

$(document).ready(function(){
   CargarDescuentos();
});

function CargarDescuentos(){
    
    $.ajax({
        url : UrlDescuentos,
        type: 'GET',
        datatype: 'JSON',
        success: function(reponse){
            var MisItems = reponse;
            // Si la tabla ya ha sido inicializada previamente, destruye la instancia
            if ($.fn.DataTable.isDataTable('#TablaDescuentos')) {
             $('#TablaDescuentos').DataTable().destroy();
            }
            $("#TablaDescuentos").DataTable({
              processing: true,
              data: MisItems,
              language: {
                url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
              },
              columns: [
                { data: "Id_Descuento" },
                { data: "Nombre_descuento" },
                { data: "Porcentaje" },
                { data: "options" },

                /*{ 
                        data: null, 
                        render: function ( data, type, row ) {
                          return '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarDescuento(\'' + row.Id_Descuento + '\'); mostrarFormulario();">Editar</button>' +
                                 '<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarDescuento(\'' + row.Id_Descuento + '\')">Eliminar</button>';
                        }                        
                      } */
              ],
            });
        }
    });
}
/*
function BuscarDescuentos(Nombredescuento){
    var datosDescuento = {
        Nombre_descuento: isNaN(Nombredescuento) ? Nombredescuento : null,
        Id_Descuento: isNaN(Nombredescuento) ? null : parseInt(Nombredescuento)
    };
    var datosDescuentoJson = JSON.stringify(datosDescuento);

    $.ajax({
        url: UrlDescuento,
        type: 'POST',
        data: datosDescuentoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            var Valores='';
            
            for(i=0; i<MisItems.length; i++){
                Valores+= '<tr>'+
                '<td>'+ MisItems[i].Id_Descuento  +'</td>'+ 
                '<td>'+ MisItems[i].Nombre_descuento +'</td>'+
                '<td>'+ MisItems[i].Porcentaje +'</td>'+
                '<td>'+ 
                '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick=" CargarDescuento('+MisItems[i].Id_Descuento +'); mostrarFormulario();">Editar</button>'+ 
                '<button class="rounded" style="background-color: #D6234A; color: white; display: inline-block; width: 67px;"  onclick="EliminarDescuento('+MisItems[i].Id_Descuento +')">Eliminar</button>'+
                '</td>'+
            '</tr>';
            }
            $('#DataDescuentos').html(Valores);
        }
    });
}

*/

function AgregarDescuento(){
    var datosDescuento = {
    Nombre_descuento: $('#Nombre_descuento').val(),
    Porcentaje_a_descontar: $('#Porcentaje_a_descontar').val()
    };
    var datosDescuentoJson= JSON.stringify(datosDescuento);

    $.ajax({
        url:UrlInsertarDescuentos,
        type: 'POST',
        data: datosDescuentoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Descuento Agregado');
        },

        error: function(textStatus, errorThrown){
            alert('Error al agregar descuento' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
}

function CargarDescuento(IdDescuento){ //Función que trae los campos que se eligieron editar.
    var datosDescuento = {
        Id_Descuento:IdDescuento
    };
    var datosDescuentoJson=JSON.stringify(datosDescuento);

    $.ajax({
        url: UrlDescuentoeditar,
        type: 'POST',
        data: datosDescuentoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            //Muestra el id junto con su título que se encuentra oculto en el Agregar.
            $('#Id_Descuento').removeAttr('hidden'); // ID
            $('label[for="Id_Descuento"]').removeAttr('hidden'); //Título
        
            $('#Id_Descuento').val(MisItems[0].Id_Descuento).prop('readonly', true);  // Propiedad para que no se pueda modificar el campo.
            $('#Nombre_descuento').val(MisItems[0].Nombre_descuento);
            $('#Porcentaje_a_descontar').val(MisItems[0].Porcentaje_a_descontar);
            
            //Usar el mismo botón de agregar con la funcionalidad de actualizar.
            var btnactualizar = '<input type="submit" id="btn_actualizar" onclick="ActualizarDescuento(' +MisItems[0].Id_Descuento+')"'+
            'value="Actualizar Descuento" class="btn btn-primary"> <button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button></input>';
            $('#btnagregarDescuento').html(btnactualizar);
            $('#btncancelar').click(function(){ //Cancela la acción
                location.href = "http://localhost/SIIS-PROYECTO/Formularios/Descuentos.php";
             });
            //Cambiar el título del formulario.
            var titulo = '<div class="Col-12" id="titulo">'+
            '<h3 style="color: black;">Editar Descuento</h3></div>';
            $('#titulo').html(titulo);
            
        }
    });
}

function ActualizarDescuento(IdDescuento){
    var datosDescuento={
    Id_Descuento: IdDescuento,
    Nombre_descuento: $('#Nombre_descuento').val(),
    Porcentaje_a_descontar: $('#Porcentaje_a_descontar').val()
    };
    var datosDescuentoJson = JSON.stringify(datosDescuento);

    $.ajax({
        url: UrlActualizarDescuentos,
        type: 'PUT',
        data: datosDescuentoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Descuento Actualizado');
        },

        error: function(textStatus, errorThrown){
            alert('Error al actualizar descuento' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
}

function EliminarDescuento(IdDescuento){
    Swal.fire({
        title: "¿Desea eliminar el descuento?",
        text: "Está seguro que quieres eliminar el descuento, esta acción es irreversible",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, Eliminar!",
      }).then((result) => {
        if (result.isConfirmed) {
        var datosDescuento={
            Id_Descuento:IdDescuento
        };
    var datosDescuentoJson= JSON.stringify(datosDescuento);

    $.ajax({
        url: UrlEliminarDescuentos,
        type: 'DELETE',
        data: datosDescuentoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            //Swal.fire("Cancelada!", "Compra Cancelada Correctamente.", "success");
            Swal.fire({
                title: "Cancelada",
                text: "Decuento eliminado correctamente",
                icon: "success",
                timer: 3000,
                willClose: () => {
                  location.reload();
                },
              });
            },
            error: function(textStatus, errorThrown){
              Swal.fire({
                  title: 'Este descuento no puede ser eliminado',
                  icon: 'error',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'Aceptar'
                  
            });
            CargarDescuentos();
        }
    });
  }
});
}
           