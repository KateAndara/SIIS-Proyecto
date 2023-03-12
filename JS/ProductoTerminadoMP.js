var UrlProductosTerminadosMP = 'http://localhost/SIIS-PROYECTO/controller/productoTerminadoMP.php?opc=GetProductosTerminadosMP';
var UrlProductoTerminadoMP = 'http://localhost/SIIS-PROYECTO/controller/productoTerminadoMP.php?opc=GetProductoTerminadoMP';

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
                '<td>'+ MisItems[i].Id_Producto_Terminado_Mp +'</td>'+
                '<td>'+ MisItems[i].Nombre +'</td>'+
                '<td>'+ MisItems[i].Id_Proceso_Produccion +'</td>'+
                '<td>'+ MisItems[i].Cantidad +'</td>'+
                '<td>'+ 
                '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="BuscarProductoTerminadoMP('+MisItems[i].Id_Producto_Terminado_Mp +')">Editar</button>'+ 
                '<button class="rounded" style="background-color: #D6234A; color: white; display: inline-block; width: 67px;"  onclick="EliminarProductoTerminadoMP('+MisItems[i].Id_Producto_Terminado_Mp +')">Eliminar</button>'+
                '</td>'+
            '</tr>';
            }
            $('#DataProductosTerminadosMP').html(Valores);
        }

    });
}


function BuscarProductoTerminadoMP(idProducto){
    var datosProducto = {
        Id_Producto_Terminado_Mp:idProducto
    };
    var datosProductoJson=JSON.stringify(datosProducto);

    $.ajax({
        url: UrlProductoTerminadoMP,
        type: 'POST',
        data: datosProductoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            var Valores='';
            
            for(i=0; i<MisItems.length; i++){
                Valores+= '<tr>'+
                '<td>'+ MisItems[i].Id_Producto_Terminado_Mp +'</td>'+
                '<td>'+ MisItems[i].Nombre +'</td>'+
                '<td>'+ MisItems[i].Id_Proceso_Produccion +'</td>'+
                '<td>'+ MisItems[i].Cantidad +'</td>'+
                '<td>'+ 
                '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="BuscarProductoTerminadoMP('+MisItems[i].Id_Producto_Terminado_Mp +')">Editar</button>'+ 
                '<button class="rounded" style="background-color: #D6234A; color: white; display: inline-block; width: 67px;"  onclick="EliminarProductoTerminadoMP('+MisItems[i].Id_Producto_Terminado_Mp +')">Eliminar</button>'+
                '</td>'+
            '</tr>';
            }
            $('#DataProductosTerminadosMP').html(Valores);
        }
    });
}
