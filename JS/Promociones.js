var UrlPromociones = 'http://localhost/SIIS-PROYECTO/controller/promociones.php?opc=GetPromociones'; //Traer todos los datos
var UrlPromocion = 'http://localhost/SIIS-PROYECTO/controller/promociones.php?opc=GetPromocion';     //Traer los datos de búsqueda
var UrlInsertarPromociones = 'http://localhost/SIIS-PROYECTO/controller/promociones.php?opc=InsertPromocion'; // Insertrar
var UrlActualizarPromociones = 'http://localhost/SIIS-PROYECTO/controller/promociones.php?opc=UpdatePromocion'; // Editar
var UrlEliminarPromociones = 'http://localhost/SIIS-PROYECTO/controller/promociones.php?opc=DeletePromocion'; // Eliminar
var UrlPromocioneditar = 'http://localhost/SIIS-PROYECTO/controller/promociones.php?opc=GetPromocioneditar'; // Traer el dato a editar

var UrlProductos = 'http://localhost/SIIS-PROYECTO/controller/Ventas.php?opc=GetProductos'; 

$(document).ready(function(){
   CargarPromociones();
});

function CargarPromociones(){
    
    $.ajax({
        url : UrlPromociones,
        type: 'GET',
        datatype: 'JSON',
        success: function(reponse){
            var MisItems = reponse;
            // Si la tabla ya ha sido inicializada previamente, destruye la instancia
            if ($.fn.DataTable.isDataTable('#TablaPromociones')) {
             $('#TablaPromociones').DataTable().destroy();
            }
            $("#TablaPromociones").DataTable({
              processing: true,
              data: MisItems,
              language: {
                url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
              },
              columns: [
                { data: "Id_Promocion" },
                { data: "Nombre_Promocion" },
                { data: "Precio_Venta" },
                { data: "Fecha_inicio" },
                { data: "Fecha_final" },
                { data: "options" },

                /* { 
                        data: null, 
                        render: function ( data, type, row ) {
                          return '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarPromocion(\'' + row.Id_Promocion + '\'); mostrarFormulario();">Editar</button>' +
                                 '<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarPromocion(\'' + row.Id_Promocion + '\')">Eliminar</button>';
                        }
                      }       */
              ],
            });
        }
    });
}

/*
function BuscarPromociones(NombrePromocion){
    var datosPromocion = {
        Nombre: isNaN(NombrePromocion) ? NombrePromocion : null,
        Id_Promocion: isNaN(NombrePromocion) ? null : parseInt(NombrePromocion)
    };
    var datosPromocionJson = JSON.stringify(datosPromocion);

    $.ajax({
        url: UrlPromocion,
        type: 'POST',
        data: datosPromocionJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            var Valores='';
            
            for(i=0; i<MisItems.length; i++){
                Valores+= '<tr>'+
                '<td>'+ MisItems[i].Id_Promocion  +'</td>'+ 
                '<td>'+ MisItems[i].Nombre_Promocion +'</td>'+
                '<td>'+ MisItems[i].Precio_Venta +'</td>'+
                '<td>'+ MisItems[i].Fecha_inicio +'</td>'+
                '<td>'+ MisItems[i].Fecha_final +'</td>'+
                '<td>'+ 
                '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick=" CargarPromocion('+MisItems[i].Id_Promocion +'); mostrarFormulario();">Editar</button>'+ 
                '<button class="rounded" style="background-color: #D6234A; color: white; display: inline-block; width: 67px;"  onclick="EliminarPromocion('+MisItems[i].Id_Promocion +')">Eliminar</button>'+
                '</td>'+
            '</tr>';
            }
            $('#DataPromociones').html(Valores);
        }
    });
}
*/


function AgregarPromocion(){
    var datosPromocion = {
    Nombre_Promocion: $('#Nombre_Promocion').val(),
    Cantidad: $('#Cantidad').val(),
    Precio_Venta: $('#Precio_Venta').val(),
    Fecha_inicio: $('#Fecha_inicio').val(),
    Fecha_final: $('#Fecha_final').val(),
    
    };
    var datosPromocionJson= JSON.stringify(datosPromocion );

    $.ajax({
        url:UrlInsertarPromociones,
        type: 'POST',
        data: datosPromocionJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Promoción Agregada');
        },

        error: function(textStatus, errorThrown){
            alert('Error al agregar promoción' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
}

function CargarPromocion(idPromocion){ //Función que trae los campos que se eligieron editar.
    var datosPromocion = {
        Id_Promocion:idPromocion
    };
    var datosPromocionJson=JSON.stringify(datosPromocion);

    $.ajax({
        url: UrlPromocioneditar,
        type: 'POST',
        data: datosPromocionJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            //Muestra el id junto con su título que se encuentra oculto en el Agregar.
            $('#Id_Promocion').removeAttr('hidden'); // ID
            $('label[for="Id_Promocion"]').removeAttr('hidden');            
            $('#Id_Promocion').val(MisItems[0].Id_Promocion).prop('readonly', true);  // Propiedad para que no se pueda modificar el campo.
            $('#Nombre_Promocion').val(MisItems[0].Nombre_Promocion);
            $('#Precio_Venta').val(MisItems[0].Precio_Venta);
            $('#Fecha_inicio').val(MisItems[0].Fecha_inicio);
            $('#Fecha_final').val(MisItems[0].Fecha_final);
            //Usar el mismo botón de agregar con la funcionalidad de actualizar.
            var btnactualizar = '<input type="submit" id="btn_actualizar" onclick="ActualizarPromocion(' +MisItems[0].Id_Promocion+')"'+
            'value="Actualizar Promoción" class="btn btn-primary"> <button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button></input>';
            $('#btnagregarPromocion').html(btnactualizar);
            $('#btncancelar').click(function(){ //Cancela la acción
                location.href = "http://localhost/SIIS-PROYECTO/Formularios/PromocionesVentas.php";
             });
            //Cambiar el título del formulario.
            var titulo = '<div class="Col-12" id="titulo">'+
            '<h3 style="color: black;">Editar Promocion</h3></div>';
            $('#titulo').html(titulo);
        }
    });
}

function ActualizarPromocion(idPromocion){
    var datosPromocion={
    Id_Promocion: idPromocion,
    Nombre_Promocion: $('#Nombre_Promocion').val(),
    Precio_Venta: $('#Precio_Venta').val(),
    Fecha_inicio: $('#Fecha_inicio').val(),
    Fecha_final: $('#Fecha_final').val()
    };
    var datosPromocionJson = JSON.stringify(datosPromocion);

    $.ajax({
        url: UrlActualizarPromociones,
        type: 'PUT',
        data: datosPromocionJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Promoción Actualizada');
        },

        error: function(textStatus, errorThrown){
            alert('Error al actualizar promoción' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
}

function EliminarPromocion(idPromocion){
    Swal.fire({
        title: "¿Desea eliminar la promoción?",
        text: "Está seguro que quieres eliminar la promoción, esta acción es irreversible",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, Eliminar!",
      }).then((result) => {
        if (result.isConfirmed) {
        var datosPromocion={
            Id_Promocion:idPromocion
        };
        var datosPromocionJson= JSON.stringify(datosPromocion);

    $.ajax({
        url: UrlEliminarPromociones,
        type: 'DELETE',
        data: datosPromocionJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            //Swal.fire("Cancelada!", "Compra Cancelada Correctamente.", "success");
            Swal.fire({
                title: "Cancelada",
                text: "Promoción eliminado correctamente",
                icon: "success",
                timer: 3000,
                willClose: () => {
                  location.reload();
                },
              });
            },
            error: function(textStatus, errorThrown){
              Swal.fire({
                  title: 'Esta promoción no puede ser eliminada',
                  icon: 'error',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'Aceptar'
                  
            });
            CargarPromociones();
        }
    });
  }
});
}
