var UrlInventarios = 'http://localhost/SIIS-PROYECTO/controller/inventario.php?opc=GetInventarios';
var UrlInventario  = 'http://localhost/SIIS-PROYECTO/controller/inventario.php?opc=GetInventario';

$(document).ready(function(){
   CargarInventarios();
});

function CargarInventarios(){
    
    $.ajax({
        url : UrlInventarios,
        type: 'GET',
        datatype: 'JSON',
        success: function(reponse){
            var MisItems = reponse;
            var Valores='';
            
            for(i=0; i<MisItems.length; i++){
                Valores+= '<tr>'+
                '<td>'+ MisItems[i].Id_Inventario +'</td>'+
                '<td>'+ MisItems[i].Nombre +'</td>'+
                '<td>'+ MisItems[i].Existencia +'</td>'+                
                '<td>'+             
                '<button class="rounded" style="background-color: #008000; color: white; float: center; " onclick="BuscarInventario('+MisItems[i].Id_Inventario +')">Ver más</button>'+ 
            '</tr>';
            }
            $('#DataInventario').html(Valores);
        }

    });
}

function BuscarInventario(NombreInventario){
    var datosInventario = {
        Nombre : isNaN(NombreInventario) ? NombreInventario : null,
        Id_inventario : isNaN(NombreInventario) ? null : parseint(NombreInventario),
        Existencia:isNaN(NombreInventario) ? null : parseInt(NombreInventario)
    };
    var datosInventarioJson=JSON.stringify(datosInventario);

    $.ajax({
        url: UrlInventario,
        type: 'POST',
        data: datosInventarioJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            var Valores='';
            
            for(i=0; i<MisItems.length; i++){
                Valores+= '<tr>'+
                '<td>'+ MisItems[i].Id_Inventario +'</td>'+
                '<td>'+ MisItems[i].Nombre +'</td>'+
                '<td>'+ MisItems[i].Existencia +'</td>'+  
                '<td>'+ 
                '<button class="rounded" style="background-color: #008000; color: white; float: center; " onclick="BuscarInventario('+MisItems[i].Id_Inventario +')">Ver más</button>'+ 
            '</tr>';
            }
            $('#DataInventario').html(Valores);
        }
    });
}