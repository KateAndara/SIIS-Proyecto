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
            var secuencia = 1; // Agregar una variable para la secuencia de números
            
            // Recorrer los datos y agregar la secuencia de números
            for (i = 0; i < MisItems.length; i++) {
                MisItems[i].Numero = secuencia;
                secuencia++;
            }
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
                    { data: "Numero" },
                    { data: 'Nombre_Promocion' },
                    { data: 'Id_Venta' },
                    { data: 'Precio_venta' },
                    { data: 'Cantidad' },
                                   ]
            });
        }
    });
}