var UrlPromocionesApli = 'http://localhost/SIIS-PROYECTO/controller/promocionesaplicadas.php?opc=GetPromocionesApli';

$(document).ready(function(){
    CargarPromocionesApli();
 });

 function CargarPromocionesApli(){
    
    $.ajax({
        url : UrlPromocionesApli,
        type: 'GET',
        datatype: 'JSON',
        success: function(reponse){
            var MisItems = reponse;
            // Si la tabla ya ha sido inicializada previamente, destruye la instancia
            if ($.fn.DataTable.isDataTable('#TablaPromocionesApli')) {
             $('#TablaPromocionesApli').DataTable().destroy();
            }
            $('#TablaPromocionesApli').DataTable({
                processing: true,
                data: MisItems,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                  },
                  columns: [
                    { data: 'Id_Venta_Promocion' },
                    { data: 'Nombre_Promocion' },
                    { data: 'Id_Venta' },
                    { data: 'Precio_venta' },
                    { data: 'Cantidad' },
                                   ]
            });
        }
    });
}