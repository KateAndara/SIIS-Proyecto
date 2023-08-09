var UrlInventarios = 'http://localhost/SIIS-PROYECTO/controller/inventario.php?opc=GetInventarios';
var urlMovimientos = 'http://localhost/SIIS-PROYECTO/Formularios/movimientos.php?id=';
var urlGetMovimiento = 'http://localhost/SIIS-PROYECTO/controller/inventario.php?opc=GetMovimientos';

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
            var secuencia = 1; // Agregar una variable para la secuencia de números
            
            // Recorrer los datos y agregar la secuencia de números
            for (i = 0; i < MisItems.length; i++) {
                MisItems[i].Numero = secuencia;
                secuencia++;
            }

             // Si la tabla ya ha sido inicializada previamente, destruye la instancia
             if ($.fn.DataTable.isDataTable('#TablaInventario')) {
                $('#TablaInventario').DataTable().destroy();
               }
               $("#TablaInventario").DataTable({
                 processing: true,
                 data: MisItems,
                 language: {
                   url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
                 },
                 columns: [
                   { data: 'Numero' }, // Mostrar la secuencia de números
                   { data: "Nombre" },
                   { data: "Existencia" },
                   { data: "badge" },

                   {
                     data: null,
                     render: function (data, type, row) {
                       return (
                         '<button class="rounded" style="background-color: #008000; color: white; display: inline-block; width: 90px;" onclick="CargarInventario(\'' +
                         row.Id_Producto +
                         "');\">Ver más</button>"
                       );
                     },
                   },
                 ],
               });
        }

    });
}

function CargarInventario(Id_Producto) {
  window.location.href = urlMovimientos + Id_Producto;
}

function cargarTabla(idProducto) {
  var dataProducto = {
    Id_Producto: idProducto,
  };
  var dataProducto = JSON.stringify(dataProducto);
   $.ajax({
     url: urlGetMovimiento,
     type: "POST",
     data: dataProducto,
     datatype: "JSON",
     success: function (reponse) {
       var MisItems = reponse;
       var secuencia = 1; // Agregar una variable para la secuencia de números
            
       // Recorrer los datos y agregar la secuencia de números
       for (i = 0; i < MisItems.length; i++) {
          MisItems[i].Numero = secuencia;
          secuencia++;
       }

       // Si la tabla ya ha sido inicializada previamente, destruye la instancia
       if ($.fn.DataTable.isDataTable("#tableMovimientos")) {
         $("#tableMovimientos").DataTable().destroy();
       }
       $("#tableMovimientos").DataTable({
         processing: true,
         data: MisItems,
         language: {
           url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
         },
         columns: [
          { data: 'Numero' }, // Mostrar la secuencia de números
          { data: 'Nom_Usuario'},
          { data: "badge" },
          { data: "Cantidad" },
          { data: "Fecha_hora" },
         ],
       });
       document.querySelector("#tituloPrincipal").innerHTML =
       "Movimientos del Producto " + MisItems[0]["Nombre"];     
      },     
   });
}