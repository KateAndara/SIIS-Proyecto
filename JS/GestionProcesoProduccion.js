var UrlProcesosProduccion = 'http://localhost/SIIS-PROYECTO/controller/gestionProcesoProduccion.php?opc=GetProcesosProduccion'; //Traer todos los datos
var UrlActualizarProcesoProduccion = 'http://localhost/SIIS-PROYECTO/controller/gestionProcesoProduccion.php?opc=GetProcesoProduccionEditar'; //Traer el dato a editar
var UrlProcesoProduccionEditar = 'http://localhost/SIIS-PROYECTO/controller/gestionProcesoProduccion.php?opc=UpdateProcesoProduccion'; //Actualizar el dato traído


$(document).ready(function(){
   CargarProcesos();
});

function CargarProcesos(){
    
    $.ajax({
        url : UrlProcesosProduccion,
        type: 'GET',
        datatype: 'JSON',
        
        success: function(reponse){
            var MisItems = reponse;
            // Si la tabla ya ha sido inicializada previamente, destruye la instancia
            if ($.fn.DataTable.isDataTable('#TablaProcesosProduccion')) {
                $('#TablaProcesosProduccion').DataTable().destroy();
               }
               $("#TablaProcesosProduccion").DataTable({
                 processing: true,
                 data: MisItems,
                 language: {
                   url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
                 },
                 columns: [
                   { data: "Id_Proceso_Produccion" },
                   { data: "Descripcion" },
                   { data: "Fecha" },
                   { data: "options" },

                   /* { 
                           data: null, 
                           render: function ( data, type, row ) {
                            return '<div style="display: flex; align-items: center;">' + 
                            '<button class="rounded" style="background-color: #2D7AC0; color: white; width: 73px; margin-right: 4px;" onclick= "CargarProcesoProduccion(\'' + row.Id_Proceso_Produccion + '\'); mostrarDiv();">Editar</button>'+ 
                            '<button class="rounded" style="background-color: #FF0000; color: white; width: 80px; margin-right: 4px;" onclick="procesoProduccionPDF(\'' +
                            row.Id_Proceso_Produccion +
                            "')\">PDF "+'<i class="fa-regular fa-file-pdf"></i>'+"</button>"+'<button class="rounded" style="background-color: #FF0000; color: white; width: 80px; margin-right: 4px;" onclick="cancelarCompra(\'' +
                            row.Id_Proceso_Produccion +
                            "')\">Cancelar</button>"+"</div>"
                   
                           }
                         }     */
                 ],
               });
        }

    });
}

function procesoProduccionPDF(idProceso) {
    location.href =
      "http://localhost/SIIS-PROYECTO/Reportes/reporteProcesoProduccion.php?id=" + idProceso;
  }

function CargarProcesoProduccion(idProceso) { 
    var datosProcesoProduccion = {
        Id_Proceso_Produccion:idProceso
    };
    var datosProcesoProduccionJson=JSON.stringify(datosProcesoProduccion);

    $.ajax({
        url: UrlActualizarProcesoProduccion,
        type: 'POST',
        data: datosProcesoProduccionJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse) {
            var MisItems = reponse;
            $('#Id_Proceso_Produccion').removeAttr('hidden');
            $('#Id_Proceso_Produccion').val(MisItems[0].Id_Proceso_Produccion).prop('readonly', true);
            $('#Select_Estados_Proceso').val(MisItems[0].Id_Estado_Proceso);
            $('#Select_Estado_Proceso').val(MisItems[0].Id_Estado_Proceso); // añade esta línea para actualizar el otro select
            $('#Fecha').val(MisItems[0].Fecha);
        
            // Crear el botón de actualización
            var btnactualizar = '<input type="submit" id="btnagregarNuevo" onclick="ActualizarProcesoProduccion(' +MisItems[0].Id_Proceso_Produccion+'); document.querySelector(\'.nav-tabs li:nth-child(2) a\').click(); return false;" value="Siguiente" class="btn btn-dark">';

            // Crear el botón de cancelar
            var btncancelar = '<button class="btn btn-secondary" type="button" onclick="location.href=\'../Formularios/GestionProcesoProduccion.php\'">Cancelar</button>';

            // Reemplazar el contenido del elemento <div> de agregar proceso con los botones "Actualizar" y "Cancelar"
            $('#btnagregarProcesoProduccion').html(btnactualizar + ' ' + btncancelar);

            // Crear el botón de agregar producto terminado final
            var btnagregarPF = '<input type="submit" id="btnagregarPF" onclick="AgregarProductoTerminadoFinal(event)" value="Agregar" class="btn btn-success" style="margin-right:450px;">';

            // Crear el botón de anterior
            var btnanteriorPF = '<input type="submit" id="btnanterior" onclick="document.querySelector(\'.nav-tabs li:nth-child(2) a\').click(); return false;" value="Anterior" class="btn btn-dark" style="margin-right:5px;">';

            // Crear el botón de finalizar proceso
            var btnfinalizarProcesoPF = '<button type="button" id="btnfinalizarProceso" class="btn btn-info" onclick=" ActualizarProcesoProduccion(' +MisItems[0].Id_Proceso_Produccion+'); mostrarMensaje()" style="margin-left:auto;">Finalizar proceso</button>';

            // Reemplazar el contenido del elemento <div> de agregar producto final con los botones "Agregar", "Anterior" y "Finalizar proceso"
            $('#btnagregarProductoTerminadoFinal').html(btnagregarPF + ' ' + btnanteriorPF + ' ' + btnfinalizarProcesoPF);

            // Actualizar el valor del segundo select cuando se seleccione una opción en el primer select
            $('#Select_Estados_Proceso').change(function() {
                var valorSeleccionado = $(this).val();
                $('#Select_Estado_Proceso').val(valorSeleccionado);
            });

            // Actualizar el valor del primer select cuando se seleccione una opción en el segundo select
            $('#Select_Estado_Proceso').change(function() {
                var valorSeleccionado = $(this).val();
                $('#Select_Estados_Proceso').val(valorSeleccionado);
            });
        }
    });
}


function ActualizarProcesoProduccion(idProceso){
    var datosProcesoProduccion={
    Id_Proceso_Produccion: idProceso,
    Id_Estado_Proceso: $('#Select_Estado_Proceso').val(),
    Fecha: $('#Fecha').val()
    };
    var datosProcesoProduccionJson = JSON.stringify(datosProcesoProduccion);

    $.ajax({
        url: UrlProcesoProduccionEditar,
        type: 'PUT',
        data: datosProcesoProduccionJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
        },

        error: function(textStatus, errorThrown){
            alert('Error al actualizar proceso' + textStatus + errorThrown);
        }
    });
}


