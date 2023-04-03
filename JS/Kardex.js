var UrlKardexs = 'http://localhost/SIIS-PROYECTO/controller/kardex.php?opc=GetKardexs';
var UrlKardex  = 'http://localhost/SIIS-PROYECTO/controller/kardex.php?opc=GetKardex';

$(document).ready(function(){
   CargarKardexs();
});

function CargarKardexs(){
    
    $.ajax({
        url : UrlKardexs,
        type: 'GET',
        datatype: 'JSON',
        success: function(reponse){
            var MisItems = reponse;
            var Valores='';
            
            for(i=0; i<MisItems.length; i++){
                Valores+= '<tr>'+
                '<td>'+ MisItems[i].Id_Kardex+'</td>'+   
                '<td>'+ MisItems[i].Nombre +'</td>'+
                '<td>'+ MisItems[i].Descripcion+'</td>'+  
                '<td>'+ MisItems[i].Cantidad +'</td>'+ 
                '<td>'+ MisItems[i].Fecha_hora +'</td>'+                         
                '<td>'+ 
            '</tr>';
            }
            $('#DataKardex').html(Valores);
        }

    });
}

function BuscarKardex(idKardex){
    var datosKardex= {
        Id_Kardex:idKardex
    };
    var datosKardexJson=JSON.stringify(datosKardex);

    $.ajax({
        url: UrlKardex,
        type: 'POST',
        data: datosKardexJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            var Valores='';
            
            for(i=0; i<MisItems.length; i++){
                Valores+= '<tr>'+
                '<td>'+ MisItems[i].Id_Kardex+'</td>'+                     
                '<td>'+ MisItems[i].Nombre +'</td>'+
                '<td>'+ MisItems[i].Descripcion+'</td>'+ 
                '<td>'+ MisItems[i].Cantidad +'</td>'+ 
                '<td>'+ MisItems[i].Fecha_hora +'</td>'+                         
                '<td>'+ 
            '</tr>';            
            }
            $('#DataKardex').html(Valores);
        }
    });
}