var UrlProductosTerminadosMP = 'http://localhost/SIIS-PROYECTO/controller/productoTerminadoMP.php?opc=GetProductosTerminadosMP'; //Traer todos los datos
var UrlEliminarProductoTerminadoMP = 'http://localhost/SIIS-PROYECTO/controller/productoTerminadoMP.php?opc=DeleteProductoTerminadoMP'; // Eliminar

$(document).ready(function(){
   CargarProductosTerminadosMP();
   CargarProductosTerminadosMPEditandoProceso(id_proceso_produccion);
});

function CargarProductosTerminadosMP(){
    
    $.ajax({
        url : UrlProductosTerminadosMP,
        type: 'GET',
        datatype: 'JSON',
        success: function(reponse){
            var MisItems = reponse;
            var Valores='';
            
            for(i=0; i<MisItems.length; i++){
                Valores+= '<tr>'+
                '<td style="display: none;">'+ MisItems[i].Id_Producto_Terminado_Mp +'</td>'+
                '<td>'+ MisItems[i].Nombre +'</td>'+
                '<td>'+ MisItems[i].Cantidad +'</td>'+ 
                '<td class="text-center"><a class="link_delete" onclick="EliminarProductoTerminadoMP('+MisItems[i].Id_Producto_Terminado_Mp +');"><i class="far fa-trash-alt" style="color:red"></i></a></td>'+
            '</tr>';
            }
            $('#DataProductosTerminadosMP').html(Valores);
        }

    });
}

function CargarProductosTerminadosMPEditandoProceso(id_proceso_produccion){    
    var UrlProductosTerminadosMP = 'http://localhost/SIIS-PROYECTO/controller/productoTerminadoMP.php?opc=GetProductosTerminadosMPEditandoProceso&id_proceso_produccion=' + id_proceso_produccion; //Traer los datos correspondientes al Id_Proceso_Produccion deseado

    $.ajax({
        url : UrlProductosTerminadosMP,
        type: 'GET',
        datatype: 'JSON',
        success: function(reponse){
            var MisItems = reponse;
            var Valores='';
            
            for(i=0; i<MisItems.length; i++){
                Valores+= '<tr>'+
                '<td style="display: none;">'+ MisItems[i].Id_Producto_Terminado_Mp +'</td>'+
                '<td>'+ MisItems[i].Nombre +'</td>'+
                '<td>'+ MisItems[i].Cantidad +'</td>'+ 
                '<td class="text-center"><a class="link_delete" onclick="EliminarProductoTerminadoMPEditandoProceso(' + MisItems[i].Id_Producto_Terminado_Mp + ', ' + id_proceso_produccion + ');"><i class="far fa-trash-alt" style="color:red"></i></a></td>'+
            '</tr>';
            }
            $('#DataProductosTerminadosMP').html(Valores);
        }

    });
}

function EliminarProductoTerminadoMP(idProducto) {
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
            var datosProductoTerminadoMP = {
                Id_Producto_Terminado_Mp: idProducto
            };

            var datosProductoTerminadoJson = JSON.stringify(datosProductoTerminadoMP);

            $.ajax({
                url: UrlEliminarProductoTerminadoMP,
                type: 'DELETE',
                data: datosProductoTerminadoJson,
                datatype: 'JSON',
                contentType: 'application/json',
                success: function(reponse) {
                    console.log(reponse);
                    Swal.fire({
                        title: 'Producto eliminado',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            CargarProductosTerminadosMP();
                        }
                    });
                },

                error: function(textStatus, errorThrown) {
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



function EliminarProductoTerminadoMPEditandoProceso(idProducto, id_proceso_produccion) {
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
            var datosProductoTerminadoMP = {
                Id_Producto_Terminado_Mp: idProducto
            };

            var datosProductoTerminadoJson = JSON.stringify(datosProductoTerminadoMP);

            $.ajax({
                url: UrlEliminarProductoTerminadoMP,
                type: 'DELETE',
                data: datosProductoTerminadoJson,
                datatype: 'JSON',
                contentType: 'application/json',
                success: function(reponse) {
                    console.log(reponse);
                    Swal.fire({
                        title: 'Producto eliminado',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            CargarProductosTerminadosMPEditandoProceso(id_proceso_produccion);
                        }
                    });
                },

                error: function(textStatus, errorThrown) {
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















