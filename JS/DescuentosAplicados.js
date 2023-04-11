var UrlDescuentosApli = 'http://localhost/SIIS-PROYECTO/controller/descuentosaplicados.php?opc=GetDescuentosApli';

$(document).ready(function(){
    CargarDescuentosApli();
 });

 function CargarDescuentosApli(){
    
    $.ajax({
        url : UrlDescuentosApli,
        type: 'GET',
        datatype: 'JSON',
        success: function(reponse){
            var MisItems = reponse;
            // Si la tabla ya ha sido inicializada previamente, destruye la instancia
            if ($.fn.DataTable.isDataTable('#TablaDescuentosApli')) {
             $('#TablaDescuentosApli').DataTable().destroy();
            }
            $('#TablaDescuentosApli').DataTable({
                processing: true,
                data: MisItems,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                  },
                  columns: [
                    { data: 'Id_Ventas_Descuento' },
                    { data: 'Id_Venta' },
                    { data: 'Nombre_descuento' },
                    { data: 'Porcentaje' },
                    { data: 'Total_descuento' },
                    
                                   ]
            });
        }
    });
}