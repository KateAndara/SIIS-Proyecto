var UrlBitacoras = 'http://localhost/SIIS-PROYECTO/controller/bitacorac.php?opc=GetBitacoras';
var UrlBitacora= 'http://localhost/SIIS-PROYECTO/controller/bitacorac.php?opc=GetBitacora';




$(document).ready(function(){
   CargarBitacoras();
});

function CargarBitacoras() {
    $.ajax({
        url: UrlBitacoras,
        type: 'GET',
        datatype: 'JSON',
        success: function (response) {
            
            var MisItems = response;

            // Si la tabla ya ha sido inicializada previamente, destruye la instancia
            if ($.fn.DataTable.isDataTable('#TablaBitacoras')) {
                $('#TablaBitacoras').DataTable().destroy();
            }

            $('#TablaBitacoras').DataTable({
                processing: true,
                deferRender: true,
                data: MisItems,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                },
                columns: [
                    { data: 'Id_bitacora' },
                    { data: 'Usuario' },
                    { data: 'Objeto' },
                    { data: 'Fecha' },
                    { data: 'Accion' },
                    { data: 'Descripcion' }
                ]
            });
        }
    });
}


/*
function CargarBitacoras(){
    
    $.ajax({
        url : UrlBitacoras,
        type: 'GET',
        datatype: 'JSON',
        success: function(reponse){
            var MisItems = reponse;
            var Valores='';
            
            for(i=0; i<MisItems.length; i++){
                Valores+= '<tr>'+
                '<td>'+ MisItems[i].Id_bitacora+'</td>'+
                '<td>'+ MisItems[i].Usuario+'</td>'+
                '<td>'+ MisItems[i].Objeto +'</td>'+
                '<td>'+ MisItems[i].Fecha +'</td>'+
                '<td>'+ MisItems[i].Accion +'</td>'+
                '<td>'+ MisItems[i].Descripcion +'</td>'+
                '</tr>';
            }
            $('#DataBitacora').html(Valores);

        }
    });
}*/


function BuscarBitacora(NombreBitacora){
    var datosBitacora = {
        Nombre: isNaN(NombreBitacora) ? NombreBitacora : null,
        Id_bitacora: isNaN(NombreBitacora) ? null : parseInt(NombreBitacora),
        Id_Usuario: isNaN(NombreBitacora) ? null : parseInt(NombreBitacora),
        Id_Objeto: isNaN(NombreBitacora) ? null : parseInt(NombreBitacora),
        Fecha: isNaN(NombreBitacora) ? null : parseInt(NombreBitacora),
        Accion: isNaN(NombreBitacora) ? null : parseInt(NombreBitacora),
        Descripcion:isNaN(NombreBitacora) ? null : parseInt(NombreBitacora)
    };
    var datosBitacoraJson = JSON.stringify(datosBitacora);

    $.ajax({
        url: UrlBitacora,
        type: 'POST',
        data: datosBitacoraJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            var Valores='';
            
            for(i=0; i<MisItems.length; i++){
                Valores+= '<tr>'+
                '<td>'+ MisItems[i].Id_bitacora +'</td>'+
                '<td>'+ MisItems[i].Usuario +'</td>'+
                '<td>'+ MisItems[i].Id_Objeto +'</td>'+
                '<td>'+ MisItems[i].Fecha +'</td>'+
                '<td>'+ MisItems[i].Accion +'</td>'+
                '<td>'+ MisItems[i].Descripcion +'</td>'+
                '<td>'+ 
                '</td>'+
            '</tr>';
            }
            $('#DataBitacora').html(Valores);
        }
    });
}

