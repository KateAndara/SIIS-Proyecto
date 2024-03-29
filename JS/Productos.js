var UrlProductos = 'http://localhost/SIIS-PROYECTO/controller/productos.php?opc=GetProductos';
var UrlProducto  = 'http://localhost/SIIS-PROYECTO/controller/productos.php?opc=GetProducto';
var UrlInsertarProducto = 'http://localhost/SIIS-PROYECTO/controller/productos.php?opc=InsertProducto';
var UrlActualizarProducto = 'http://localhost/SIIS-PROYECTO/controller/productos.php?opc=UpdateProducto';
var UrlEliminarProducto = 'http://localhost/SIIS-PROYECTO/controller/productos.php?opc=DeleteProducto';
var UrlProductoEditar = 'http://localhost/SIIS-PROYECTO/controller/productos.php?opc=GetProductoeditar';
var UrlTipoProductos = 'http://localhost/SIIS-PROYECTO/controller/productos.php?opc=GetTipoProductos';

$(document).ready(function(){
   CargarProductos();
   CargarTipoProducto();
});

function CargarProductos(){
    
    $.ajax({
        url : UrlProductos,
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
            if ($.fn.DataTable.isDataTable('#TablaProductos')) {
                $('TablaProductos').DataTable().destroy();
               }
               $("#TablaProductos").DataTable({
                 processing: true,
                 data: MisItems,
                 language: {
                   url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
                 },
                 columns: [
                   { data: 'Numero' }, // Mostrar la secuencia de números
                   { data: "Nombre_tipo" },
                   { data: "Nombre" },
                   { data: "Unidad_medida" },
                   { data: "Precio" },
                   { data: "Cantidad_maxima" },
                   { data: "Cantidad_minima" },
                   { data: "options" },

                   /* { 
                           data: null, 
                           render: function ( data, type, row ) {
                             return '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarProducto(\'' + row.Id_Producto + '\'); mostrarFormulario();">Editar</button>' +
                                    '<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarProducto(\'' + row.Id_Producto + '\')">Eliminar</button>';
                           }
                         } */
                 ],
               });
        }

    });
}

/*function BuscarProducto(NombreProducto){
    var datosProducto = {
        NombreP: isNaN(NombreProducto) ? NombreProducto : null,
        Id_Producto: isNaN(NombreProducto) ? null : parseInt(NombreProducto),
        Nombre_tipo: isNaN(NombreProducto) ? null : parseInt(NombreProducto),
        Nombre: isNaN(NombreProducto) ? null : parseInt(NombreProducto),
        Unidad_medida: isNaN(NombreProducto) ? null : parseInt(NombreProducto),
        Precio: isNaN(NombreProducto) ? null : parseInt(NombreProducto),
        Cantidad_maxima:isNaN(NombreProducto) ? null : parseInt(NombreProducto),
        Cantidad_minima: isNaN(NombreProducto) ? null : parseInt(NombreProducto)
    };
    var datosProductoJson=JSON.stringify(datosProducto);

    $.ajax({
        url: UrlProducto,
        type: 'POST',
        data: datosProductoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            var Valores='';
            
            for(i=0; i<MisItems.length; i++){
                Valores+= '<tr>'+
                '<td>'+ MisItems[i].Id_Producto +'</td>'+
                '<td>'+ MisItems[i].Id_Tipo_Producto +'</td>'+
                '<td>'+ MisItems[i].Nombre +'</td>'+      
                '<td>'+ MisItems[i].Unidad_medida +'</td>'+ 
                '<td>'+ MisItems[i].Precio +'</td>'+ 
                '<td>'+ MisItems[i].Cantidad_maxima +'</td>'+ 
                '<td>'+ MisItems[i].Cantidad_minima+'</td>'+                 
                '<td>'+ 
                '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarProducto('+MisItems[i].Id_Producto +'); mostrarFormulario();">Editar</button>'+ 
                '<button class="rounded" style="background-color: #D6234A; color: white; display: inline-block; width: 67px;"  onclick="EliminarProducto('+MisItems[i].Id_Producto +')">Eliminar</button>'+                
                '</td>'+
            '</tr>';
            }
            $('#DataProductos').html(Valores);
        }
    });
}*/

function AgregarProducto() {
    var nombre = $('#Nombre').val();
    var unidad_medida = $('#Unidad_medida').val();
    var precio = $('#Precio').val();
    var cantidad_maxima = $('#Cantidad_maxima').val();
    var cantidad_minima = $('#Cantidad_minima').val();

    // Patrones de validación
    var patronNombre = /^[a-zA-Z0-9\s]+$/; // Letras, espacios y números
    var patronUnidadMedida = /^[a-zA-Z0-9\s]+$/; // Letras, espacios y números en unidad de medida
    var patronCantidad = /^\d+$/; // Solo números enteros positivos

    // Validaciones
    if (nombre.trim() === "" || unidad_medida.trim() === "" || precio.trim() === "" || cantidad_maxima.trim() === "" || cantidad_minima.trim() === "") {
        swal.fire("Campos incompletos", "Por favor complete todos los campos.", "warning");
        return false;
    } else if (!patronNombre.test(nombre)) {
        swal.fire("Nombre inválido", "El nombre solo debe contener letras, espacios y números.", "warning");
        return false;
    } else if (!patronUnidadMedida.test(unidad_medida)) {
        swal.fire("Unidad de medida inválida", "La unidad de medida solo debe contener letras, espacios y números.", "warning");
        return false;
    } else if (isNaN(parseFloat(precio)) || parseFloat(precio) <= 0) {
        swal.fire("Precio inválido", "El precio debe ser un número decimal mayor que cero.", "warning");
        return false;
    } else if (!patronCantidad.test(cantidad_maxima) || parseInt(cantidad_maxima) <= 0) {
        swal.fire("Cantidad máxima inválida", "La cantidad máxima debe ser un número entero mayor que cero.", "warning");
        return false;
    } else if (!patronCantidad.test(cantidad_minima) || parseInt(cantidad_minima) <= 0) {
        swal.fire("Cantidad mínima inválida", "La cantidad mínima debe ser un número entero mayor que cero.", "warning");
        return false;
    }

    var datosProducto = {
        Id_Tipo_Producto: $('#Select_TipoProducto').val(),
        Nombre: nombre,
        Unidad_medida: unidad_medida,
        Precio: precio,
        Cantidad_maxima: cantidad_maxima,
        Cantidad_minima: cantidad_minima
    };

    var datosProductoJson = JSON.stringify(datosProducto);

    $.ajax({
        url: UrlInsertarProducto,
        type: 'POST',
        data: datosProductoJson,
        dataType: 'json',
        contentType: 'application/json',
        success: function(response) {
            console.log(response);
            swal.fire({
                title: "LISTO!",
                text: "Producto agregado con éxito",
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
                title: "Error!",
                text: "Error al guardar el producto",
                icon: "error",
                confirmButtonText: "Aceptar",
                closeOnConfirm: false,
                timer: 4000,
               
              });
        },
    });
}

function CargarProducto(idProducto){ //Función que trae los campos que se eligieron editar.
    var datosProducto = {
        Id_Producto:idProducto
    };
    var datosProductoJson=JSON.stringify(datosProducto);

    $.ajax({
        url: UrlProductoEditar,
        type: 'POST',
        data: datosProductoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            //Muestra el id junto con su título que se encuentra oculto en el Agregar.
            $('label[for="Id_Producto"]').removeAttr('hidden'); //Título
        
            $('#Id_Producto').val(MisItems[0].Id_Producto).prop('readonly', true);  // Propiedad para que no se pueda modificar el campo.
            $('#Select_TipoProducto').val(MisItems[0].Id_Tipo_Producto);
            $('#Nombre').val(MisItems[0].Nombre);
            $('#Unidad_medida').val(MisItems[0].Unidad_medida);
            $('#Precio').val(MisItems[0].Precio);
            $('#Cantidad_maxima').val(MisItems[0].Cantidad_maxima);
            $('#Cantidad_minima').val(MisItems[0].Cantidad_minima);
            //Usar el mismo botón de agregar con la funcionalidad de actualizar.
            var btnactualizar = '<a id="btn_actualizar" onclick="ActualizarProducto(' +MisItems[0].Id_Producto+')"'+
            'value="Actualizar Producto" class="btn btn-primary">Actualizar Producto</a> <button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button></input>';
            $('#btnagregarProducto').html(btnactualizar);
            $('#btncancelar').click(function(){ //Cancela la acción
                location.href = "http://localhost/SIIS-PROYECTO/Formularios/Productos.php";
             });
            //Cambiar el título del formulario.
            var titulo = '<div class="Col-12" id="titulo">'+
            '<h3 style="color: black;">Editar Producto</h3></div>';
            $('#titulo').html(titulo); 
        }
    });
}

function ActualizarProducto(idProducto){
    var nombre = $('#Nombre').val();
    var unidad_medida = $('#Unidad_medida').val();
    var precio = $('#Precio').val();
    var cantidad_maxima = $('#Cantidad_maxima').val();
    var cantidad_minima = $('#Cantidad_minima').val();

    // Patrones de validación
    var patronNombre = /^[a-zA-Z0-9\s]+$/; // Letras, espacios y números
    var patronUnidadMedida = /^[a-zA-Z0-9\s]+$/; // Letras, espacios y números en unidad de medida
    var patronCantidad = /^\d+$/; // Solo números enteros positivos

    // Validaciones
    if (nombre.trim() === "" || unidad_medida.trim() === "" || precio.trim() === "" || cantidad_maxima.trim() === "" || cantidad_minima.trim() === "") {
        swal.fire("Campos incompletos", "Por favor complete todos los campos.", "warning");
        return false;
    } else if (!patronNombre.test(nombre)) {
        swal.fire("Nombre inválido", "El nombre solo debe contener letras, espacios y números.", "warning");
        return false;
    } else if (!patronUnidadMedida.test(unidad_medida)) {
        swal.fire("Unidad de medida inválida", "La unidad de medida solo debe contener letras, espacios y números.", "warning");
        return false;
    } else if (isNaN(parseFloat(precio)) || parseFloat(precio) <= 0) {
        swal.fire("Precio inválido", "El precio debe ser un número decimal mayor que cero.", "warning");
        return false;
    } else if (!patronCantidad.test(cantidad_maxima) || parseInt(cantidad_maxima) <= 0) {
        swal.fire("Cantidad máxima inválida", "La cantidad máxima debe ser un número entero mayor que cero.", "warning");
        return false;
    } else if (!patronCantidad.test(cantidad_minima) || parseInt(cantidad_minima) <= 0) {
        swal.fire("Cantidad mínima inválida", "La cantidad mínima debe ser un número entero mayor que cero.", "warning");
        return false;
    }
    var datosProducto={
        Id_Producto: idProducto,
        Id_Tipo_Producto: $('#Select_TipoProducto').val(),
        Nombre: nombre,
        Unidad_medida: unidad_medida,
        Precio: precio,
        Cantidad_maxima: $('#Cantidad_maxima').val(),
        Cantidad_minima: $('#Cantidad_minima').val()
    };
    var datosProductoJson = JSON.stringify(datosProducto);
    
    $.ajax({
        url: UrlActualizarProducto,
        type: 'PUT',
        data: datosProductoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(response) {
            console.log(response);
            swal.fire({
                title: "LISTO!",
                text: "Producto actualizado con éxito",
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
                title: "Error!",
                text: "Error al actualizar el producto",
                icon: "error",
                confirmButtonText: "Aceptar",
                closeOnConfirm: false,
                timer: 4000,
               
              });
        },
    });
}

function EliminarProducto(idProducto){
    Swal.fire({
        title: "¿Desea eliminar el producto?",
        text: "Está seguro que quieres eliminar el producto, esta acción es irreversible",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, Eliminar!",
      }).then((result) => {
        if (result.isConfirmed) {
        var datosProducto={
            Id_Producto:idProducto
        };

        var datosProductoJson= JSON.stringify(datosProducto);

        $.ajax({
            url: UrlEliminarProducto,
            type: 'DELETE',
            data: datosProductoJson,
            datatype: 'JSON',
            contentType: 'application/json',
            success: function (response) {
                //Swal.fire("Cancelada!", "Compra Cancelada Correctamente.", "success");
                Swal.fire({
                  title: "LISTO",
                  text: "Producto eliminado correctamente",
                  icon: "success",
                  timer: 3000,
                  willClose: () => {
                    location.reload();
                  },
                });
              },
              error: function(textStatus, errorThrown){
                Swal.fire({
                    title: "LISTO",
                    text: "Producto eliminado correctamente",
                    icon: "success",
                    timer: 3000,
                    willClose: () => {
                      location.reload();
                    },
                  });
            }
            });
          }
        });
     }

//Función para traer los datos de otra tabla para poder ser seleccionados en una lista desplegable
function CargarTipoProducto(){
    $.ajax({
        url : UrlTipoProductos,
        type: 'GET',
        datatype: 'JSON',
        success: function(response){
            var MisItems = response;
            var opciones='';
            
            for(i=0; i<MisItems.length; i++){ //Muestra Id y nombre
                opciones += '<option value="' + MisItems[i].Id_Tipo_Producto + '">'  + MisItems[i].Id_Tipo_Producto + ' - ' + MisItems[i].Nombre_tipo + '</option>';
            }
            $('#Select_TipoProducto').html(opciones);
        }
    });
}

