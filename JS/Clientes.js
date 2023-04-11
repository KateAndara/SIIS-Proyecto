var UrlClientes = 'http://localhost/SIIS-PROYECTO/controller/cliente.php?opc=GetClientes'; //Traer todos los datos
var UrlCliente = 'http://localhost/SIIS-PROYECTO/controller/cliente.php?opc=GetCliente';     //Traer los datos de búsqueda
var UrlInsertarClientes = 'http://localhost/SIIS-PROYECTO/controller/cliente.php?opc=InsertCliente'; // Insertrar
var UrlActualizarClientes = 'http://localhost/SIIS-PROYECTO/controller/cliente.php?opc=UpdateCliente'; // Editar
var UrlEliminarClientes = 'http://localhost/SIIS-PROYECTO/controller/cliente.php?opc=DeleteCliente'; // Eliminar
var UrlClienteditar = 'http://localhost/SIIS-PROYECTO/controller/cliente.php?opc=GetClienteditar'; // Traer el dato a editar

$(document).ready(function(){
   CargarClientes();
});

function CargarClientes(){
    
    $.ajax({
        url : UrlClientes,
        type: 'GET',
        datatype: 'JSON',
        success: function(reponse){
            var MisItems = reponse;
            // Si la tabla ya ha sido inicializada previamente, destruye la instancia
            if ($.fn.DataTable.isDataTable('#TablaClientes')) {
             $('#TablaClientes').DataTable().destroy();
            }
            $('#TablaClientes').DataTable({
                processing: true,
                data: MisItems,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                  },
                  columns: [
                    { data: 'Id_Cliente' },
                    { data: 'Nombre' },
                    { data: 'Fecha_nacimiento' },
                    { data: 'DNI' },
                    { 
                        data: null, 
                        render: function ( data, type, row ) {
                          return '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarCliente(\'' + row.Id_Cliente + '\'); mostrarFormulario();">Editar</button>' +
                                 '<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarCliente(\'' + row.Id_Cliente + '\')">Eliminar</button>';
                        }
                      }                ]
            });
        }
    });
}
/*
function BuscarDescuentos(Nombredescuento){
    var datosDescuento = {
        Nombre_descuento: isNaN(Nombredescuento) ? Nombredescuento : null,
        Id_Descuento: isNaN(Nombredescuento) ? null : parseInt(Nombredescuento)
    };
    var datosDescuentoJson = JSON.stringify(datosDescuento);

    $.ajax({
        url: UrlDescuento,
        type: 'POST',
        data: datosDescuentoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            var Valores='';
            
            for(i=0; i<MisItems.length; i++){
                Valores+= '<tr>'+
                '<td>'+ MisItems[i].Id_Descuento  +'</td>'+ 
                '<td>'+ MisItems[i].Nombre_descuento +'</td>'+
                '<td>'+ MisItems[i].Porcentaje +'</td>'+
                '<td>'+ 
                '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick=" CargarDescuento('+MisItems[i].Id_Descuento +'); mostrarFormulario();">Editar</button>'+ 
                '<button class="rounded" style="background-color: #D6234A; color: white; display: inline-block; width: 67px;"  onclick="EliminarDescuento('+MisItems[i].Id_Descuento +')">Eliminar</button>'+
                '</td>'+
            '</tr>';
            }
            $('#DataDescuentos').html(Valores);
        }
    });
}

*/

function AgregarCliente(){
    var datosCliente = {
    Nombre: $('#Nombre').val(),
    Fecha_nacimiento: $('#Fecha_nacimiento').val(),
    DNI: $('#DNI').val()
    };
    var datosClienteJson= JSON.stringify(datosCliente);

    $.ajax({
        url:UrlInsertarClientes,
        type: 'POST',
        data: datosClienteJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Cliente Agregado');
        },

        error: function(textStatus, errorThrown){
            alert('Error al agregar cliente' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
}

function CargarCliente(IdCliente){ //Función que trae los campos que se eligieron editar.
    var datosCliente = {
        Id_Cliente:IdCliente
    };
    var datosClienteJson=JSON.stringify(datosCliente);

    $.ajax({
        url: UrlClienteditar,
        type: 'POST',
        data: datosClienteJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            //Muestra el id junto con su título que se encuentra oculto en el Agregar.
            $('#Id_Cliente').removeAttr('hidden'); // ID
            $('label[for="Id_Cliente"]').removeAttr('hidden'); //Título
        
            $('#Id_Cliente').val(MisItems[0].Id_Cliente).prop('readonly', true);  // Propiedad para que no se pueda modificar el campo.
            $('#Nombre').val(MisItems[0].Nombre);
            $('#Fecha_nacimiento').val(MisItems[0].Fecha_nacimiento);
            $('#DNI').val(MisItems[0].DNI);
            
            //Usar el mismo botón de agregar con la funcionalidad de actualizar.
            var btnactualizar = '<input type="submit" id="btn_actualizar" onclick="ActualizarCliente(' +MisItems[0].Id_Cliente+')"'+
            'value="Actualizar Cliente" class="btn btn-primary"></input>';
            $('#btnagregarCliente').html(btnactualizar);
            //Cambiar el título del formulario.
            var titulo = '<div class="Col-12" id="titulo">'+
            '<h3>Editar Cliente</h3></div>';
            $('#titulo').html(titulo);
            
        }
    });
}

function ActualizarCliente(IdCliente){
    var datosCliente={
    Id_Cliente: IdCliente,
    Nombre: $('#Nombre').val(),
    Fecha_nacimiento: $('#Fecha_nacimiento').val(),
    DNI: $('#DNI').val(),
    };
    var datosClienteJson = JSON.stringify(datosCliente);

    $.ajax({
        url: UrlActualizarClientes,
        type: 'PUT',
        data: datosClienteJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Cliente Actualizado');
        },

        error: function(textStatus, errorThrown){
            alert('Error al actualizar Cliente' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
}

function EliminarCliente(IdCliente){
    var datosCliente={
        Id_Cliente:IdCliente
    };

    var datosClienteJson= JSON.stringify(datosCliente);

    $.ajax({
        url: UrlEliminarClientes,
        type: 'DELETE',
        data: datosClienteJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Cliente Eliminada');
        },

        error: function(textStatus, errorThrown){
            alert('Error al eliminar cliente' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
    CargarClientes();
}
