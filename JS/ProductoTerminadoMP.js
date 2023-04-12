var UrlProductosTerminadosMP = 'http://localhost/SIIS-PROYECTO/controller/productoTerminadoMP.php?opc=GetProductosTerminadosMP'; //Traer todos los datos
var UrlEliminarProductoTerminadoMP = 'http://localhost/SIIS-PROYECTO/controller/productoTerminadoMP.php?opc=DeleteProductoTerminadoMP'; // Eliminar

$(document).ready(function(){
   CargarProductosTerminadosMP();
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

function EliminarProductoTerminadoMP(idProducto){
    var confirmacion = confirm("¿Está seguro de que desea eliminar el producto?");

    if (confirmacion == true) {
        var datosProductoTerminadoMP={
            Id_Producto_Terminado_Mp:idProducto
        };

        var datosProductoTerminadoJson= JSON.stringify(datosProductoTerminadoMP);

        $.ajax({
            url: UrlEliminarProductoTerminadoMP,
            type: 'DELETE',
            data: datosProductoTerminadoJson,
            datatype: 'JSON',
            contentType: 'application/json',
            success: function(reponse){
                console.log(reponse);
                alert('Producto Eliminado');
                CargarProductosTerminadosMP(); 
            },

            error: function(textStatus, errorThrown){
                alert('Error al eliminar Producto' + textStatus + errorThrown);
            }
        });

    } else {
        alert("La eliminación del producto ha sido cancelada.");
    }
}












