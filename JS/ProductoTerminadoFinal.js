var UrlProductosTerminadosFinal = 'http://localhost/SIIS-PROYECTO/controller/productoTerminadoFinal.php?opc=GetProductosTerminadosFinal'; //Traer todos los datos
var UrlEliminarProductoTerminadoFinal = 'http://localhost/SIIS-PROYECTO/controller/productoTerminadofinal.php?opc=DeleteProductoTerminadoFinal'; // Eliminar

$(document).ready(function(){
   CargarProductosTerminadosFinal();
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

function EliminarProductoTerminadoFinal(idProducto){
    var confirmacion = confirm("¿Está seguro de que desea eliminar el producto?");

    if (confirmacion == true) {
        var datosProductoTerminadoFinal={
            Id_Producto_Terminado_Final:idProducto
        };

        var datosProductoTerminadoJson= JSON.stringify(datosProductoTerminadoFinal);

        $.ajax({
            url: UrlEliminarProductoTerminadoFinal,
            type: 'DELETE',
            data: datosProductoTerminadoJson,
            datatype: 'JSON',
            contentType: 'application/json',
            success: function(reponse){
                console.log(reponse);
                alert('Producto Eliminado');
                CargarProductosTerminadosFinal(); 
            },

            error: function(textStatus, errorThrown){
                alert('Error al eliminar Producto' + textStatus + errorThrown);
            }
        });

    } else {
        alert("La eliminación del producto ha sido cancelada.");
    }
}
