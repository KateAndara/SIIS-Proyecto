var UrlEstadosVentaMM = 'http://localhost/SIIS-PROYECTO/controller/estadoVentaMM.php?opc=GetEstadosVentaMM';
var UrlEstadoVentaMM = 'http://localhost/SIIS-PROYECTO/controller/estadoVentaMM.php?opc=GetEstadoVentaMM';
var UrlInsertarEstadoVentaMM = 'http://localhost/SIIS-PROYECTO/controller/estadoVentaMM.php?opc=InsertEstadoVentaMM'; // Insertrar
var UrlActualizarEstadoVentaMM = 'http://localhost/SIIS-PROYECTO/controller/estadoVentaMM.php?opc=UpdateEstadoVentaMM'; // Editar
var UrlEliminarEstadoVentaMM = 'http://localhost/SIIS-PROYECTO/controller/estadoVentaMM.php?opc=DeleteEstadoVentaMM'; // Eliminar
var UrlEstadoVentaMMeditar = 'http://localhost/SIIS-PROYECTO/controller/estadoVentaMM.php?opc=GetEstadoVentaMMeditar'; // Traer el dato a editar

$(document).ready(function(){
   CargarEstadosVentaMM();
});

function CargarEstadosVentaMM(){
    
    $.ajax({
        url : UrlEstadosVentaMM,
        type: 'GET',
        datatype: 'JSON',
        success: function(reponse){
            var MisItems = reponse;
            // Si la tabla ya ha sido inicializada previamente, destruye la instancia
            if ($.fn.DataTable.isDataTable('#TablaEstadosVenta')) {
                $('#TablaEstadosVenta').DataTable().destroy();
               }
               $('#TablaEstadosVenta').DataTable({
                   processing: true,
                   data: MisItems,
                   "language": {
                       "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                     },
                     columns: [
                       { data: 'Id_Estado_Venta' },
                       { data: 'Nombre_estado' },
                       { 
                           data: null, 
                           render: function ( data, type, row ) {
                             return '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarEstadoVentaMM(\'' + row.Id_Estado_Venta + '\'); mostrarFormulario();">Editar</button>' +
                                    '<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarEstadoVentaMM(\'' + row.Id_Estado_Venta + '\')">Eliminar</button>';
                           }
                        }                
                    ]
               });
        }

    });
}

function AgregarEstadoVentaMM(){
    var datosEstadoVentaMM = {
        Nombre_estado: $('#Nombre_estado').val()
    };
    var datosEstadoVentaMMJson= JSON.stringify(datosEstadoVentaMM );

    $.ajax({
        url:UrlInsertarEstadoVentaMM,
        type: 'POST',
        data: datosEstadoVentaMMJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Estado de Agregado');
        },

        error: function(textStatus, errorThrown){
            alert('Error al agregar el estado de venta' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
}

function CargarEstadoVentaMM(idEstadoVenta){ //Función que trae los campos que se eligieron editar.
    var datosEstadoVentaMM = {
        Id_Estado_Venta:idEstadoVenta
    };
    var datosEstadoVentaMMJson=JSON.stringify(datosEstadoVentaMM);

    $.ajax({
        url: UrlEstadoVentaMMeditar,
        type: 'POST',
        data: datosEstadoVentaMMJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            //Muestra el id junto con su título que se encuentra oculto en el Agregar.
            $('#Id_Estado_Venta').removeAttr('hidden'); // ID
            $('label[for="Id_Estado_Venta"]').removeAttr('hidden'); //Título
        
            $('#Id_Estado_Venta').val(MisItems[0].Id_Estado_Venta).prop('readonly', true);  // Propiedad para que no se pueda modificar el campo.
            $('#Nombre_estado').val(MisItems[0].Nombre_estado);

            //Usar el mismo botón de agregar con la funcionalidad de actualizar.
            var btnactualizar = '<input type="submit" id="btn_actualizar" onclick="ActualizarEstadoVentaMM(' +MisItems[0].Id_Estado_Venta+')"'+
            'value="Actualizar Esatdo Del Producto" class="btn btn-primary"> <button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button></input>';
            $('#btnagregarEstadoVenta').html(btnactualizar);
            $('#btncancelar').click(function(){ //Cancela la acción
                location.href = "http://localhost/SIIS-PROYECTO/Formularios/EstadoVentaMM.php";
             });
            //Cambiar el título del formulario.
            var titulo = '<div class="Col-12" id="titulo">'+
            '<h3>Editar Estado De Venta</h3></div>';
            $('#titulo').html(titulo); 
        }
    });
}

function ActualizarEstadoVentaMM(idEstadoVenta){
    var datosEstadoVentaMM={
        Id_Estado_Venta: idEstadoVenta,
        Nombre_estado: $('#Nombre_estado').val()
    };
    var datosEstadoVentaMMJson = JSON.stringify(datosEstadoVentaMM);

    $.ajax({
        url: UrlActualizarEstadoVentaMM,
        type: 'PUT',
        data: datosEstadoVentaMMJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Estado de venta Actualizado');
        },

        error: function(textStatus, errorThrown){
            alert('Error al actualizar el estado de venta' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
}

function EliminarEstadoVentaMM(idEstadoVenta){
    var confirmacion = confirm("¿Está seguro de que desea eliminar el estado de venta?");

    if (confirmacion == true) {
        var datosEstadoVentaMM={
            Id_Estado_Venta: idEstadoVenta,
        };
        var datosEstadoVentaMMJson = JSON.stringify(datosEstadoVentaMM);
        
        $.ajax({
            url: UrlEliminarEstadoVentaMM,
            type: 'DELETE',
            data: datosEstadoVentaMMJson,
            datatype: 'JSON',
            contentType: 'application/json',
            success: function(reponse){
                console.log(reponse);
                alert('Estado de venta Eliminado');
                CargarEstadosVentaMM(); 
            },

            error: function(textStatus, errorThrown){
                alert('Error al eliminar el etado de venta' + textStatus + errorThrown);
            }
        });

    } else {
        alert("La eliminación del estado de venta ha sido cancelada.");
    }
}

