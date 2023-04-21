var UrlProcesosProduccion = 'http://localhost/SIIS-PROYECTO/controller/gestionProcesoProduccion.php?opc=GetProcesosProduccion'; //Traer todos los datos
var UrlActualizarProcesoProduccion = 'http://localhost/SIIS-PROYECTO/controller/gestionProcesoProduccion.php?opc=GetProcesoProduccionEditar'; //Traer el dato a editar
var UrlProcesoProduccionEditar = 'http://localhost/SIIS-PROYECTO/controller/gestionProcesoProduccion.php?opc=UpdateProcesoProduccion'; //Actualizar el dato traído
var UrlCancelarProcesoProduccion = 'http://localhost/SIIS-PROYECTO/controller/productoTerminadoFinal.php?opc=CancelarProcesoProduccion';

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
                            '<button class="rounded" style="background-color: #2D7AC0; color: white; width: 73px; margin-right: 4px;" onclick= "CargarProcesoProduccion(\'' + row.Id_Proceso_Produccion + '\'); CargarProductosTerminadosMPEditandoProceso(\'' + row.Id_Proceso_Produccion + '\'); mostrarDiv();">Editar</button>'+ 
                            '<button class="rounded" style="background-color: #FF0000; color: white; width: 80px; margin-right: 4px;" onclick="procesoProduccionPDF(\'' +
                            row.Id_Proceso_Produccion +
                            "')\">PDF "+'<i class="fa-regular fa-file-pdf"></i>'+"</button>"+'<button class="rounded" style="background-color: #FF0000; color: white; width: 80px; margin-right: 4px;" onclick="CancelarProcesoProduccion(\'' +
                            row.Id_Proceso_Produccion +
                            "')\">Cancelar</button>"+"</div>"
                   
                           }
                         }     */
                 ],
               });
        }

    });
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

            //-----------------------------------------------------Botones del tab "Inico de proceso"-------------------------------------------------
            // Crear el botón de actualización
            var btnactualizar = '<input type="submit" id="btnagregarNuevo" onclick="ActualizarProcesoProduccion(' +MisItems[0].Id_Proceso_Produccion+'); document.querySelector(\'.nav-tabs li:nth-child(2) a\').click(); return false;" value="Siguiente" class="btn btn-dark">';

            // Crear el botón de cancelar
            var btncancelar = '<button class="btn btn-secondary" type="button" onclick="location.href=\'../Formularios/GestionProcesoProduccion.php\'">Cancelar</button>';

            // Reemplazar el contenido del elemento <div> de agregar proceso con los botones "Actualizar" y "Cancelar"
            $('#btnagregarProcesoProduccion').html(btnactualizar + ' ' + btncancelar);

            //-----------------------------------------------------Botones del tab "Materia prima"-------------------------------------------------

            // Crear el botón de agregar producto terminado MP
            var btnagregarMP = '<input type="submit" id="btnagregarMP" value="Agregar" class="btn btn-success" style="margin-right:300px;">';

            // Crear el botón de anterior
            var btnanteriorMP = '<input type="submit" id="btnanterior" onclick="document.querySelector(\'.nav-tabs li:nth-child(1) a\').click(); return false;" value="Anterior" class="btn btn-dark" style="margin-right:5px;">';
            
            // Crear el botón de siguiente
             var btnsiguienteMP = '<input type="submit" id="btnsiguiente" onclick="document.querySelector(\'.nav-tabs li:nth-child(3) a\').click(); return false;" value="Siguiente" class="btn btn-dark" style="margin-right:20px;">'; 
                
             // Crear el botón de finalizar proceso
            var btnfinalizarProcesoMP = '<button type="button" id="btnfinalizarProceso" class="btn btn-info" onclick="ActualizarProcesoProduccion(' +MisItems[0].Id_Proceso_Produccion+');Swal.fire({ title: \'¿Desea imprimir ficha del proceso?\', icon: \'question\', showCancelButton: true, confirmButtonColor: \'#3085d6\', cancelButtonColor: \'#d33\', confirmButtonText: \'Sí\', cancelButtonText: \'No\' }).then((result) => { if (result.isConfirmed) { procesoProduccionPDF(' +MisItems[0].Id_Proceso_Produccion+'); } else { mostrarMensaje(); } });" style="margin-left:auto;">Finalizar proceso</button>';

            // Reemplazar el contenido del elemento <div> de agregar producto final con los botones "Agregar", "Anterior" y "Finalizar proceso"
            $('#btnagregarProductoTerminadoMP').html(btnagregarMP + ' ' + btnanteriorMP + ' ' + btnsiguienteMP + ' ' + btnfinalizarProcesoMP);

            // Agregar evento al botón de agregar producto MP
            var btnagregarMP = document.getElementById('btnagregarMP');
            btnagregarMP.addEventListener('click', function() {
                AgregarProductoTerminadoMPEditandoProceso(event, MisItems[0].Id_Proceso_Produccion);
            });

            //-----------------------------------------------------Botones del tab "Producto terminado"-------------------------------------------------

            // Crear el botón de agregar producto terminado final
            var btnagregarPF = '<input type="submit" id="btnagregarPF" value="Agregar" class="btn btn-success" style="margin-right:350px;">';

            // Crear el botón de anterior
            var btnanteriorPF = '<input type="submit" id="btnanterior" onclick="document.querySelector(\'.nav-tabs li:nth-child(2) a\').click(); return false;" value="Anterior" class="btn btn-dark" style="margin-right:5px;">';

            // Crear el botón de finalizar proceso
            var btnfinalizarProcesoPF = '<button type="button" id="btnfinalizarProceso" class="btn btn-info" onclick="ActualizarProcesoProduccion(' +MisItems[0].Id_Proceso_Produccion+');Swal.fire({ title: \'¿Desea imprimir ficha del proceso?\', icon: \'question\', showCancelButton: true, confirmButtonColor: \'#3085d6\', cancelButtonColor: \'#d33\', confirmButtonText: \'Sí\', cancelButtonText: \'No\' }).then((result) => { if (result.isConfirmed) { procesoProduccionPDF(' +MisItems[0].Id_Proceso_Produccion+'); } else { mostrarMensaje(); } });" style="margin-left:auto;">Finalizar proceso</button>';

            // Reemplazar el contenido del elemento <div> de agregar producto final con los botones "Agregar", "Anterior" y "Finalizar proceso"
            $('#btnagregarProductoFinal').html(btnagregarPF + ' ' + btnanteriorPF + ' ' + btnfinalizarProcesoPF);

            // Agregar evento al botón de agregar producto final
            var btnAgregarPF = document.getElementById('btnagregarPF');
            btnAgregarPF.addEventListener('click', function() {
                AgregarProductoTerminadoFinalEditandoProceso(event, MisItems[0].Id_Proceso_Produccion);
            });

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

function procesoProduccionPDF(idProceso) {
    var urlPDF =
      "http://localhost/SIIS-PROYECTO/Reportes/reporteProcesoProduccion.php?id=" + idProceso;
      // Abrir el PDF en una nueva ventana del navegador
    window.open(urlPDF, "_blank");

    // Redirigir al usuario después de cerrar el PDF
    window.location.href = "../Formularios/GestionProcesoProduccion.php";
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
            Swal.fire({
                icon: 'error',
                title: 'Error al actualizar proceso',
              }); 
        }
    });
}

function CancelarProcesoProduccion(idProceso) {
    Swal.fire({
        title: '¿Está seguro de que desea cancelar el proceso?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, cancelar',
        cancelButtonText: 'No, volver'
    }).then((result) => {
        if (result.isConfirmed) {
            var datoProceso = {
                idProceso: idProceso,
            };

            var datosProcesoJson = JSON.stringify(datoProceso);
            $.ajax({
                url: UrlCancelarProcesoProduccion,
                type: 'DELETE',
                data: datosProcesoJson,
                datatype: 'JSON',
                contentType: 'application/json',
                success: function(reponse){
                    console.log(reponse);
                    Swal.fire({
                        title: 'Proceso Cancelado',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            CargarProcesos();
                        }
                    });
                },

                error: function(textStatus, errorThrown){
                    Swal.fire({
                        title: 'Error al cancelar proceso',
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar'
                    });
                }
            });
        } else {
            Swal.fire({
                title: 'Acción cancelada',
                icon: 'info',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            });
        }
    });
}

