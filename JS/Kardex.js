var UrlKardexs = 'http://localhost/SIIS-PROYECTO/controller/kardex.php?opc=GetKardexs';

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
             // Si la tabla ya ha sido inicializada previamente, destruye la instancia
             if ($.fn.DataTable.isDataTable('#TablaKardex')) {
                $('#TablaKardex').DataTable().destroy();
             }
             $('#TablaKardex').DataTable({
                processing: true,
                data: MisItems,
                "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                },
                columns: [
                  { data: 'Id_Kardex' },
                  { data: 'Usuario' },
                  { data: 'Nombre' },
                  { data: 'Descripcion' },
                  { data: 'Cantidad' },
                  { data: 'Fecha_hora' },
                ]
            });
        }

    });
}