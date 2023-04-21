var UrlProductosTerminadosFinal = 'http://localhost/SIIS-PROYECTO/controller/productoTerminadoFinal.php?opc=GetProductosTerminadosFinal'; //Traer todos los datos
var UrlEliminarProductoTerminadoFinal = 'http://localhost/SIIS-PROYECTO/controller/productoTerminadofinal.php?opc=DeleteProductoTerminadoFinal'; // Eliminar

$(document).ready(function(){
   CargarProductosTerminadosFinal();
   CargarProductosTerminadosFinalEditandoProceso(id_proceso_produccion);
});

function CargarProductosTerminadosFinal(){
    
    $.ajax({
        url : UrlProductosTerminadosFinal,
        type: 'GET',
        datatype: 'JSON',
        success: function(reponse){
            var MisItems = reponse;
            var Valores='';
            
            for(i=0; i<MisItems.length; i++){
                Valores+= '<tr>'+
                '<td style="display: none;">'+ MisItems[i].Id_Producto_Terminado_Final +'</td>'+
                '<td>'+ MisItems[i].Nombre +'</td>'+
                '<td>'+ MisItems[i].Cantidad +'</td>'+
                '<td class="text-center"><a class="link_delete" onclick="EliminarProductoTerminadoFinal('+MisItems[i].Id_Producto_Terminado_Final +');"><i class="far fa-trash-alt" style="color:red"></i></a></td>'+
            '</tr>';
            }
            $('#DataProductosTerminadosFinal').html(Valores);
        }

    });
}

function CargarProductosTerminadosFinalEditandoProceso(id_proceso_produccion){
    var UrlProductosTerminadosFinal = 'http://localhost/SIIS-PROYECTO/controller/productoTerminadoFinal.php?opc=GetProductosTerminadosFinalEditandoProceso&id_proceso_produccion=' + id_proceso_produccion; //Traer los datos correspondientes al Id_Proceso_Produccion deseado
    $.ajax({
        url : UrlProductosTerminadosFinal,
        type: 'GET',
        datatype: 'JSON',
        success: function(reponse){
            var MisItems = reponse;
            var Valores='';
            
            for(i=0; i<MisItems.length; i++){
                Valores+= '<tr>'+
                '<td style="display: none;">'+ MisItems[i].Id_Producto_Terminado_Final +'</td>'+
                '<td>'+ MisItems[i].Nombre +'</td>'+
                '<td>'+ MisItems[i].Cantidad +'</td>'+
                '<td class="text-center"><a class="link_delete" onclick="EliminarProductoTerminadoFinalEditandoProceso(' + MisItems[i].Id_Producto_Terminado_Final + ', ' + id_proceso_produccion + ');"><i class="far fa-trash-alt" style="color:red"></i></a></td>'+
            '</tr>';
            }
            $('#DataProductosTerminadosFinal').html(Valores);
        }

    });
}

function EliminarProductoTerminadoFinal(idProducto){
    Swal.fire({
        title: '¿Está seguro de que desea eliminar el producto?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            var datosProductoTerminadoFinal = {
                Id_Producto_Terminado_Final: idProducto
            };

            var datosProductoTerminadoJson = JSON.stringify(datosProductoTerminadoFinal);

            $.ajax({
                url: UrlEliminarProductoTerminadoFinal,
                type: 'DELETE',
                data: datosProductoTerminadoJson,
                datatype: 'JSON',
                contentType: 'application/json',
                success: function(reponse){
                    console.log(reponse);
                    Swal.fire({
                        title: 'Producto eliminado',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            CargarProductosTerminadosFinal(); 
                        }
                    });
                },

                error: function(textStatus, errorThrown){
                    Swal.fire({
                        title: 'Error al eliminar producto',
                        text: 'Ha ocurrido un error al intentar eliminar el producto.',
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar'
                    });
                }
            });

        } else {
            Swal.fire({
                title: 'Eliminación cancelada',
                icon: 'info',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            });
        }
    });
}


function EliminarProductoTerminadoFinalEditandoProceso(idProducto, id_proceso_produccion) {
    Swal.fire({
      title: '¿Está seguro de que desea eliminar el producto?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, eliminar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        var datosProductoTerminadoFinal = {
          Id_Producto_Terminado_Final: idProducto
        };
  
        var datosProductoTerminadoJson = JSON.stringify(datosProductoTerminadoFinal);
  
        $.ajax({
          url: UrlEliminarProductoTerminadoFinal,
          type: 'DELETE',
          data: datosProductoTerminadoJson,
          datatype: 'JSON',
          contentType: 'application/json',
          success: function (reponse) {
            console.log(reponse);
            Swal.fire({
              title: 'Producto eliminado',
              icon: 'success',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Aceptar'
            }).then((result) => {
              if (result.isConfirmed) {
                // Llamar a la función "CargarProductosTerminadosMPEditandoProceso" con el id_proceso_produccion
                CargarProductosTerminadosFinalEditandoProceso(id_proceso_produccion);
              }
            });
          },
  
          error: function (textStatus, errorThrown) {
            Swal.fire({
              title: 'Error al eliminar producto',
              text: 'Por favor, inténtelo de nuevo.',
              icon: 'error',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Aceptar'
            });
          }
        });
      } else {
        Swal.fire({
          title: 'Eliminación cancelada',
          icon: 'info',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Aceptar'
        });
      }
    });
  }
  
