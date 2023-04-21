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
                   { data: "Id_Promocion_Producto" },
                   { data: "Nombre" },
                   { data: "Nombre_Promocion" },
                   { data: "Cantidad" },
                   

                   { 
                               data: null, 
                               render: function ( data, type, row ) {
                                 return '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarPromocionProducto(\'' + row.Id_Promocion_Producto + '\'); mostrarFormulario();">Editar</button>' +
                                        '<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarPromocionProducto(\'' + row.Id_Promocion_Producto + '\')">Eliminar</button>';
                               }
                    }       
                 ],
               });
        }

    });
}

function AgregarPromocion(event){
     // Validar que el campo Cantidad no esté vacío
     if ($('#Cantidad').val() === '') {
        Swal.fire({
            title: 'Error',
            text: 'El campo Cantidad no puede estar vacío',
            icon: 'error',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
        });
        event.preventDefault();
        return;
    }

    // Validar que el campo Cantidad solo contenga números
    if (!$.isNumeric($('#Cantidad').val())) {
        Swal.fire({
            title: 'Error',
            text: 'El campo Cantidad solo puede contener números',
            icon: 'error',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
        });
        event.preventDefault();
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
        success: function(response){
            console.log(response);
            Swal.fire({
                title: 'Promoción a Producto Agregada',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    CargarPromocionesProductos();
                    document.querySelector("#Select_ProductoFinal").value = ""; // limpiar el valor seleccionado
                    document.querySelector("#Select_Promocion").value = ""; // limpiar el valor seleccionado
                    document.querySelector("#Cantidad").value = ""; // limpiar el valor ingresado
                }
            });
        },

        error: function(textStatus, errorThrown){
            Swal.fire({
                title: 'Error al agregar promoción',
                text: textStatus + errorThrown,
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            });
        }
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
            $('#Id_Promocion_Producto').removeAttr('hidden'); // ID
            $('label[for="Id_Promocion_Producto"]').removeAttr('hidden'); //Título
        
            $('#Id_Promocion_Producto').val(MisItems[0].Id_Promocion_Producto).prop('readonly', true);  // Propiedad para que no se pueda modificar el campo.
            $('#Select_ProductoFinal').val(MisItems[0].Id_Producto).prop('readonly', true).prop('disabled', true);
            $('#Select_Promocion').val(MisItems[0].Id_Promocion).prop('readonly', true).prop('disabled', true);
            $('#Cantidad').val(MisItems[0].Cantidad);
            //Usar el mismo botón de agregar con la funcionalidad de actualizar.
            var btnactualizar = '<input type="submit" id="btn_actualizar" onclick="ActualizarPromocionProducto(' +MisItems[0].Id_Promocion_Producto+')"'+
            'value="Actualizar Promoción a Producto" class="btn btn-primary"> <button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button></input>';
            $('#btnagregarPromocion').html(btnactualizar);
            $('#btncancelar').click(function(){ //Cancela la acción
                location.href = "http://localhost/SIIS-PROYECTO/Formularios/PromocionesProductos.php";
             });
            //Cambiar el título del formulario.
            var titulo = '<div class="Col-12" id="titulo">'+
            '<h3>Editar Promoción del producto</h3></div>';
            $('#titulo').html(titulo); 

            // Agrega la clase "select2" al select de ProductoFinal y Promocion
            $('#Select_ProductoFinal, #Select_Promocion').addClass('select2');
            // Inicializa los select2
            $('.select2').select2();
        }
    });
}


function ActualizarPromocionProducto(idPromocionProducto){
    // Validar que el campo Cantidad no esté vacío
    if ($('#Cantidad').val() === '') {
        Swal.fire({
            title: 'Error',
            text: 'El campo Cantidad no puede estar vacío',
            icon: 'error',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
        });
        event.preventDefault();
        return;
    }

    // Validar que el campo Cantidad solo contenga números
    if (!$.isNumeric($('#Cantidad').val())) {
        Swal.fire({
            title: 'Error',
            text: 'El campo Cantidad solo puede contener números',
            icon: 'error',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
        });
        event.preventDefault();
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
            console.log(reponse);
            Swal.fire({
                title: 'Promoción Actualizada',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    CargarPromocionesProductos();
                    document.querySelector("#Select_ProductoFinal").value = ""; // limpiar el valor seleccionado
                    document.querySelector("#Select_Promocion").value = ""; // limpiar el valor seleccionado
                    document.querySelector("#Cantidad").value = ""; // limpiar el valor ingresado
                }
            });
        },

        error: function(textStatus, errorThrown){
            Swal.fire({
                title: 'Error',
                text: 'Error al actualizar promoción' + textStatus + errorThrown,
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            });
        }
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
                    Swal.fire({
                        title: 'Error al eliminar promoción',
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar'
                    });
                }
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