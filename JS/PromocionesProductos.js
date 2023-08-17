var UrlPromocionesProductos = 'http://localhost/SIIS-PROYECTO/controller/promocionesProductos.php?opc=GetPromocionesProductos';
var UrlProductosTerminados =  'http://localhost/SIIS-PROYECTO/controller/promocionesProductos.php?opc=GetProductosTerminados'; 
var UrlPromociones =  'http://localhost/SIIS-PROYECTO/controller/promocionesProductos.php?opc=GetPromociones'; 
var UrlInsertarPromocionProducto = 'http://localhost/SIIS-PROYECTO/controller/promocionesProductos.php?opc=InsertPromocionProducto';
var UrlPromocionProductoeditar = 'http://localhost/SIIS-PROYECTO/controller/promocionesProductos.php?opc=GetPromocionProductoeditar';
var UrlActualizarPromocionproducto = 'http://localhost/SIIS-PROYECTO/controller/promocionesProductos.php?opc=UpdatePromocionProducto'; 
var UrlEliminarPromocionProducto = 'http://localhost/SIIS-PROYECTO/controller/promocionesProductos.php?opc=DeletePromocionProducto'; 

$(document).ready(function(){
    CargarPromocionesProductos();
    CargarProductosTerminados();
    CargarPromociones();
 });

 function CargarPromocionesProductos(){
    
    $.ajax({
        url : UrlPromocionesProductos,
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
            if ($.fn.DataTable.isDataTable('#TablaPromocionesProductos')) {
                $('#TablaPromocionesProductos').DataTable().destroy();
               }
               $("#TablaPromocionesProductos").DataTable({
                 processing: true,
                 data: MisItems,
                 language: {
                   url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
                 },
                 columns: [
                   { data: "Numero" },
                   { data: "NombreProducto" },
                   { data: "Nombre_Promocion" },
                   { data: "Cantidad" },
                   { data: "options" },
                   
                    /* 
                   { 
                               data: null, 
                               render: function ( data, type, row ) {
                                 return '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarPromocionProducto(\'' + row.Id_Promocion_Producto + '\'); mostrarFormulario();">Editar</button>' +
                                        '<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarPromocionProducto(\'' + row.Id_Promocion_Producto + '\')">Eliminar</button>';
                               }
                    }    */    
                 ],
               });
        }

    });
}

function AgregarPromocion(event){
    event.preventDefault();
    // Validar que se haya seleccionado un producto
    if ($('#Select_ProductoFinal').val() === "") {
        Swal.fire({
            title: 'No ha seleccionado un producto',
            icon: 'error',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
        });
        return;
    }

    // Validar que se haya seleccionado un producto
    if ($('#Select_Promocion').val() === "") {
        Swal.fire({
            title: 'No ha seleccionado una promoción',
            icon: 'error',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
        });
        return;
    }

     // Validar que la cantidad sea un número mayor a 0
     if (!(/^\d+$/.test($('#Cantidad').val())) || parseInt($('#Cantidad').val()) <= 0) {
        Swal.fire({
            title: 'Ingrese una cantidad de promoción válida',
            text: 'La cantidad debe ser un número entero mayor a 0.',
            icon: 'error',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
        });
        document.querySelector("#Cantidad").value = ""; // limpiar el valor ingresado
        return;
    }
   

    var datosPromocionProducto = {
        Id_Producto: $('#Select_ProductoFinal').val(),
        Id_Promocion: $('#Select_Promocion').val(),
        Cantidad: $('#Cantidad').val()
    };
    var datosPromocionProductoJson= JSON.stringify(datosPromocionProducto);

    $.ajax({
        url:UrlInsertarPromocionProducto,
        type: 'POST',
        data: datosPromocionProductoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse.status);
              swal.fire({
                title: "LISTO",
                text: "Promoción a producto agregada",
                icon: "success",
                confirmButtonText: "Aceptar",
                closeOnConfirm: false,
                timer: 3000,
                willClose: () => {
                  window.location.reload();
                },
              });
        },
        error: function(textStatus, errorThrown){
            swal.fire({
                title: "LISTO",
                text: "Promoción a producto agregada",
                icon: "success",
                confirmButtonText: "Aceptar",
                closeOnConfirm: false,
                timer: 3000,
                willClose: () => {
                  window.location.reload();
                },
              });
        },
    });
}


function CargarPromocionProducto(idPromocion){
    var datosPromocionProducto = {
        Id_Promocion_Producto:idPromocion
    };
    var datosPromocionProductoJson=JSON.stringify(datosPromocionProducto);

    $.ajax({
        url: UrlPromocionProductoeditar,
        type: 'POST',
        data: datosPromocionProductoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            //Muestra el id junto con su título que se encuentra oculto en el Agregar.
          
            document.getElementById('Id_Promocion_Producto').style.display = 'none';

            $('label[for="Id_Promocion_Producto"]').removeAttr('hidden'); //Título
        
            $('#Id_Promocion_Producto').val(MisItems[0].Id_Promocion_Producto).prop('readonly', true);  // Propiedad para que no se pueda modificar el campo.
           
            // Configurar el valor seleccionado en el select2 #Select_ProductoFinal
            $('#Select_ProductoFinal').val(MisItems[0].Id_Producto).trigger('change');

            // Configurar el valor seleccionado en el select2 #Select_Promocion
            $('#Select_Promocion').val(MisItems[0].Id_Promocion);

            // Mantener la deshabilitación de la edición para #Select_ProductoFinal y #Select_Promocion
            $('#Select_ProductoFinal, #Select_Promocion').prop('readonly', true).prop('disabled', true);

            // Reinicializar ambos select2 después de aplicar las configuraciones
            $("#Select_ProductoFinal, #Select_Promocion").select2();

            $('#Cantidad').val(MisItems[0].Cantidad);
            //Usar el mismo botón de agregar con la funcionalidad de actualizar.
            var btnactualizar = '<input type="submit" id="btn_actualizar" onclick="ActualizarPromocionProducto(' +MisItems[0].Id_Promocion_Producto+ ', event)"' +
            'value="Actualizar Promoción a Producto" class="btn btn-primary"> <button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button></input>';
            $('#btnagregarPromocion').html(btnactualizar);
            $('#btncancelar').click(function(){ //Cancela la acción
                location.href = "http://localhost/SIIS-PROYECTO/Formularios/PromocionesProductos.php";
             });
            //Cambiar el título del formulario.
            var titulo = '<div class="Col-12" id="titulo">'+
            '<h3 style="color: black;">Editar Promoción del producto</h3></div>';
            $('#titulo').html(titulo); 
            // Cambiar el título del label con el ID "producto".
            var nuevoTituloProducto = 'Producto';
            $('#producto').text(nuevoTituloProducto);

            // Cambiar el título del label con el ID "promocion".
            var nuevoTituloPromocion = 'Promoción';
            $('#promocion').text(nuevoTituloPromocion);
        }
    });
}


function ActualizarPromocionProducto(idPromocionProducto, event){
    event.preventDefault();
    // Validar que la cantidad sea un número mayor a 0
    if (!(/^\d+$/.test($('#Cantidad').val())) || parseInt($('#Cantidad').val()) <= 0) {
        Swal.fire({
            title: 'Ingrese una cantidad de promoción válida',
            text: 'La cantidad debe ser un número entero mayor a 0.',
            icon: 'error',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
        });
        document.querySelector("#Cantidad").value = ""; // limpiar el valor ingresado
        return;
    }
    
    var Id_Producto = $('#Select_ProductoFinal').val();
    var Id_Promocion = $('#Select_Promocion').val();
    var cantidad = $('#Cantidad').val();
    
    var datosPromocionProducto = {
        Id_Promocion_Producto: idPromocionProducto,
        Id_Producto: Id_Producto,
        Id_Promocion:Id_Promocion,
        Cantidad: cantidad
    };
    var datosPromocionProductoJson = JSON.stringify(datosPromocionProducto);

    $.ajax({
        url: UrlActualizarPromocionproducto,
        type: 'PUT',
        data: datosPromocionProductoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse.status);
              swal.fire({
                title: "LISTO",
                text: "Promoción actualizada",
                icon: "success",
                confirmButtonText: "Aceptar",
                closeOnConfirm: false,
                timer: 3000,
                willClose: () => {
                  window.location.reload();
                },
              });
        },
        error: function(textStatus, errorThrown){
            swal.fire({
                title: "LISTO",
                text: "Promoción actualizada",
                icon: "success",
                confirmButtonText: "Aceptar",
                closeOnConfirm: false,
                timer: 3000,
                willClose: () => {
                  window.location.reload();
                },
              });
        },
    });
}


function EliminarPromocionProducto(idPromocionProducto){
    Swal.fire({
        title: '¿Está seguro de que desea eliminar esta promoción?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            var datosPromocionProducto={
                Id_Promocion_Producto:idPromocionProducto
            };
            var datosPromocionProductoJson= JSON.stringify(datosPromocionProducto);

            $.ajax({
                url: UrlEliminarPromocionProducto,
                type: 'DELETE',
                data: datosPromocionProductoJson,
                datatype: 'JSON',
                contentType: 'application/json',
                success: function(reponse){
                    console.log(reponse);
                    Swal.fire({
                        title: 'Promoción Eliminada',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            CargarPromocionesProductos();
                        }
                    });
                },
                error: function(textStatus, errorThrown){
                    swal.fire({
                        title: "LISTO",
                        text: "Promoción eliminada",
                        icon: "success",
                        confirmButtonText: "Aceptar",
                        closeOnConfirm: false,
                        timer: 3000,
                        willClose: () => {
                          window.location.reload();
                        },
                      });
                },
            });
        } else {
            Swal.fire({
                title: 'La eliminación de la promoción ha sido cancelada.',
                icon: 'info',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            });
        }
    });
}


function CargarProductosTerminados(){
    $.ajax({
        url : UrlProductosTerminados,
        type: 'GET',
        datatype: 'JSON',
        success: function(response){
            var MisItems = response;
            var opciones =
              '<option value="">' + "Seleccione Un Producto" + "</option>";
            
            for(i=0; i<MisItems.length; i++){ //Muestra Id y nombre
                 opciones +='<option value="' +
                  MisItems[i].Id_Producto +
                  '">' +
                  MisItems[i].Id_Producto +
                  " - " +
                  MisItems[i].Nombre +
                  "</option>";
                
                
              }

            $('#Select_ProductoFinal').html(opciones);
               $("#Select_ProductoFinal").select2();
         
            
        }
    });
}

function CargarPromociones(){
    $.ajax({
        url : UrlPromociones,
        type: 'GET',
        datatype: 'JSON',
        success: function(response){
            var MisItems = response;
            var opciones =
              '<option value="">' + "Seleccione una promoción" + "</option>";
            
            for(i=0; i<MisItems.length; i++){ //Muestra Id y nombre
                 opciones +='<option value="' +
                  MisItems[i].Id_Promocion +
                  '">' +
                  MisItems[i].Id_Promocion +
                  " - " +
                  MisItems[i].Nombre_Promocion +
                  "</option>";
                
                
              }

            $('#Select_Promocion').html(opciones);
               $("#Select_Promocion").select2();
         
            
        }
    });
}
