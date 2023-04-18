var UrlTipoProductosMM = 'http://localhost/SIIS-PROYECTO/controller/tipoProductoMM.php?opc=GetTipoProductosMM';
var UrlTipoProductoMM = 'http://localhost/SIIS-PROYECTO/controller/tipoProductoMM.php?opc=GetTipoProductoMM';
var UrlInsertarTipoProductoMM = 'http://localhost/SIIS-PROYECTO/controller/tipoProductoMM.php?opc=InsertTipoProductoMM'; // Insertrar
var UrlActualizarTipoProductoMM = 'http://localhost/SIIS-PROYECTO/controller/tipoProductoMM.php?opc=UpdateTipoProductoMM'; // Editar
var UrlEliminarTipoProductoMM = 'http://localhost/SIIS-PROYECTO/controller/tipoProductoMM.php?opc=DeleteTipoProductoMM'; // Eliminar
var UrlTipoProductoMMeditar = 'http://localhost/SIIS-PROYECTO/controller/tipoProductoMM.php?opc=GetTipoProductoMMeditar'; // Traer el dato a editar

$(document).ready(function(){
   CargarTipoProductosMM();
});

function CargarTipoProductosMM(){
    
    $.ajax({
        url : UrlTipoProductosMM,
        type: 'GET',
        datatype: 'JSON',
        success: function(reponse){
            var MisItems = reponse;
            // Si la tabla ya ha sido inicializada previamente, destruye la instancia
            if ($.fn.DataTable.isDataTable('#TablaTiposProducto')) {
                $('#TablaTiposProducto').DataTable().destroy();
               }
               $("#TablaTiposProducto").DataTable({
                 processing: true,
                 data: MisItems,
                 language: {
                   url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
                 },
                 columns: [
                   { data: "Id_Tipo_Producto" },
                   { data: "Nombre_tipo" },
                   { data: "options" },
                   /*  { 
                           data: null, 
                           render: function ( data, type, row ) {
                             return '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarTipoProductoMM(\'' + row.Id_Tipo_Producto + '\'); mostrarFormulario();">Editar</button>' +
                                    '<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarTipoProductoMM(\'' + row.Id_Tipo_Producto + '\')">Eliminar</button>';
                           }
                        } */
                 ],
               });
        }

    });
}


function AgregarTipoProductoMM(){
    var datosTipoProductoMM = {
        Nombre_tipo: $('#Nombre_tipo').val()
    };
    var datosTipoProductoMMJson= JSON.stringify(datosTipoProductoMM );

    $.ajax({
        url:UrlInsertarTipoProductoMM,
        type: 'POST',
        data: datosTipoProductoMMJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Tipo de producto Agregado');
        },

        error: function(textStatus, errorThrown){
            alert('Error al agregar el tipo de producto' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
}

function CargarTipoProductoMM(idTipo){ //Función que trae los campos que se eligieron editar.
    var datosTipoProductoMM = {
        Id_Tipo_Producto:idTipo
    };
    var datosTipoProductoMMJson=JSON.stringify(datosTipoProductoMM);

    $.ajax({
        url: UrlTipoProductoMMeditar,
        type: 'POST',
        data: datosTipoProductoMMJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            //Muestra el id junto con su título que se encuentra oculto en el Agregar.
            $('#Id_Tipo_Producto').removeAttr('hidden'); // ID
            $('label[for="Id_Tipo_Producto"]').removeAttr('hidden'); //Título
        
            $('#Id_Tipo_Producto').val(MisItems[0].Id_Tipo_Producto).prop('readonly', true);  // Propiedad para que no se pueda modificar el campo.
            $('#Nombre_tipo').val(MisItems[0].Nombre_tipo);

            //Usar el mismo botón de agregar con la funcionalidad de actualizar.
            var btnactualizar = '<input type="submit" id="btn_actualizar" onclick="ActualizarTipoProductoMM(' +MisItems[0].Id_Tipo_Producto+')"'+
            'value="Actualizar  Tipo De Producto" class="btn btn-primary"> <button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button></input>';
            $('#btnagregarTipoProducto').html(btnactualizar);
            $('#btncancelar').click(function(){ //Cancela la acción
                location.href = "http://localhost/SIIS-PROYECTO/Formularios/TipoProductoMM.php";
             });
            //Cambiar el título del formulario.
            var titulo = '<div class="Col-12" id="titulo">'+
            '<h3>Editar Tipo De Producto</h3></div>';
            $('#titulo').html(titulo); 
        }
    });
}

function ActualizarTipoProductoMM(idTipo){
    var datosTipoProductoMM={
        Id_Tipo_Producto: idTipo,
        Nombre_tipo: $('#Nombre_tipo').val()
    };
    var datosTipoProductoMMJson = JSON.stringify(datosTipoProductoMM);

    $.ajax({
        url: UrlActualizarTipoProductoMM,
        type: 'PUT',
        data: datosTipoProductoMMJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Tipo de producto Actualizado');
        },

        error: function(textStatus, errorThrown){
            alert('Error al actualizar el Tipo de producto' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
}

function EliminarTipoProductoMM(idTipo){
    var confirmacion = confirm("¿Está seguro de que desea eliminar el tipo de producto?");

    if (confirmacion == true) {
        var datosTipoProductoMM={
            Id_Tipo_Producto: idTipo, 
        };
        var datosTipoProductoMMJson = JSON.stringify(datosTipoProductoMM);
        
        $.ajax({
            url: UrlEliminarTipoProductoMM,
            type: 'DELETE',
            data: datosTipoProductoMMJson,
            datatype: 'JSON',
            contentType: 'application/json',
            success: function(reponse){
                console.log(reponse);
                alert('Tipo de producto Eliminado');
                CargarTipoProductosMM(); 
            },

            error: function(textStatus, errorThrown){
                alert('Error al eliminar el tipo de producto' + textStatus + errorThrown);
            }
        });

    } else {
        alert("La eliminación del tipo de producto ha sido cancelada.");
    }
}


