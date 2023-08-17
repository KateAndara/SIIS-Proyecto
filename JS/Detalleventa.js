var UrlDetalles = 'http://localhost/SIIS-PROYECTO/controller/detalleventa.php?opc=GetDetalles'; //Traer todos los datos

var UrlDetalleditar = 'http://localhost/SIIS-PROYECTO/controller/detalleventa.php?opc=GetDetalleditar'; // Traer el dato a editar

$(document).ready(function(){
   CargarDetalles();
});

function CargarDetalles(){
    
    $.ajax({
        url : UrlDetalles,
        type: 'GET',
        datatype: 'JSON',
        success: function(reponse){
            var MisItems = reponse;
            var secuencia = 1; // Agregar una variable para la secuencia de números
            
            // Recorrer los datos y agregar la secuencia de números
            for (i = 0; i < MisItems.length; i++) {
                MisItems[i].Numero = secuencia;
                secuencia++;
            }
            // Si la tabla ya ha sido inicializada previamente, destruye la instancia
            if ($.fn.DataTable.isDataTable('#TablaDetalles')) {
             $('#TablaDetalles').DataTable().destroy();
            }
            $('#TablaDetalles').DataTable({
                processing: true,
                data: MisItems,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                  },
                  columns: [
                    { data: "Numero" },
                    { data: 'Nombre' },
                    { data: 'Id_Venta' },
                    { data: 'Cantidad' },
                    { data: 'Precio' },
                        ]
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






