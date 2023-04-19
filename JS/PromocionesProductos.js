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
        alert('El campo Cantidad no puede estar vacío');
        event.preventDefault();
        return;
    }

    // Validar que el campo Cantidad solo contenga números
    if (!$.isNumeric($('#Cantidad').val())) {
        alert('El campo Cantidad solo puede contener números');
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
            alert('Promoción a Producto Agregada');
            CargarPromocionesProductos();
        },

        error: function(textStatus, errorThrown){
            alert('Error al agregar promoción' + textStatus + errorThrown);
        }
    });
}


function CargarPromocionProducto(idPromocion){ //Función que trae los campos que se eligieron editar.
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
        }
    });
}

function ActualizarPromocionProducto(idPromocionProducto){
    // Validar que el campo Cantidad no esté vacío
    if ($('#Cantidad').val() === '') {
        alert('El campo Cantidad no puede estar vacío');
        event.preventDefault();
        return;
    }

    // Validar que el campo Cantidad solo contenga números
    if (!$.isNumeric($('#Cantidad').val())) {
        alert('El campo Cantidad solo puede contener números');
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
            alert('Promoción Actualizada');
            CargarPromocionesProductos();
        },

        error: function(textStatus, errorThrown){
            alert('Error al actualizar promoción' + textStatus + errorThrown);
        }
    });
    
}

function EliminarPromocionProducto(idPromocionProducto){
    var confirmacion = confirm("¿Está seguro de que desea eliminar esta promoción?");

    if (confirmacion == true) {
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
                alert('Promoción Eliminada');
                CargarPromocionesProductos(); 
            },

            error: function(textStatus, errorThrown){
                alert('Error al eliminar Promoción' + textStatus + errorThrown);
            }
        });

    } else {
        alert("La eliminación de la promoción ha sido cancelada.");
    }
}

function CargarProductosTerminados(){
    $.ajax({
        url : UrlProductosTerminados,
        type: 'GET',
        datatype: 'JSON',
        success: function(response){
            var MisItems = response;
            var opciones='';
            
            for(i=0; i<MisItems.length; i++){ //Muestra Id y nombre
                opciones += '<option value="' + MisItems[i].Id_Producto + '">' + ' ID ' + MisItems[i].Id_Producto + ' - ' + MisItems[i].Nombre + '</option>';
            }
            $('#Select_ProductoFinal').html(opciones);
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
            var opciones='';
            
            for(i=0; i<MisItems.length; i++){ //Muestra Id y nombre
                opciones += '<option value="' + MisItems[i].Id_Promocion + '">' + ' ID ' + MisItems[i].Id_Promocion + ' - Promoción: ' + MisItems[i].Nombre_Promocion +  ' - Precio: ' + MisItems[i].Precio_Venta +'</option>';
            }
            $('#Select_Promocion').html(opciones);
        }
    });
}