var UrlInventarios = 'http://localhost/SIIS-PROYECTO/controller/inventario.php?opc=GetInventarios';

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

             // Si la tabla ya ha sido inicializada previamente, destruye la instancia
             if ($.fn.DataTable.isDataTable('#TablaInventario')) {
                $('#TablaInventario').DataTable().destroy();
               }
               $('#TablaInventario').DataTable({
                   processing: true,
                   data: MisItems,
                   "language": {
                       "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                     },
                     columns: [
                       { data: 'Id_Inventario' },
                       { data: 'Nombre' },
                       { data: 'Existencia' },
                       { 
                           data: null, 
                           render: function ( data, type, row ) {
                             return '<button class="rounded" style="background-color: #008000; color: white; display: inline-block; width: 90px;" onclick="CargarInventario(\'' + row.Id_Inventario + '\');">Ver más</button>'
                           }
                        }                ]
               });
        }

    });
}