var UrlDescuentos = 'http://localhost/SIIS-PROYECTO/controller/descuentos.php?opc=GetDescuentos'; //Traer todos los datos
var UrlDescuento = 'http://localhost/SIIS-PROYECTO/controller/descuentos.php?opc=GetDescuento';     //Traer los datos de búsqueda
var UrlInsertarDescuentos = 'http://localhost/SIIS-PROYECTO/controller/descuentos.php?opc=InsertDescuento'; // Insertrar
var UrlActualizarDescuentos = 'http://localhost/SIIS-PROYECTO/controller/descuentos.php?opc=UpdateDescuento'; // Editar
var UrlEliminarDescuentos = 'http://localhost/SIIS-PROYECTO/controller/descuentos.php?opc=DeleteDescuento'; // Eliminar
var UrlDescuentoeditar = 'http://localhost/SIIS-PROYECTO/controller/descuentos.php?opc=GetDescuentoeditar'; // Traer el dato a editar

$(document).ready(function(){
   CargarDescuentos();
});

function CargarDescuentos(){
    
    $.ajax({
        url : UrlDescuentos,
        type: 'GET',
        datatype: 'JSON',
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



function AgregarDescuento(){
    var datosDescuento = {
    Nombre_descuento: $('#Nombre_Descuento').val(),
    Porcentaje_a_descontar: $('#Porcentaje_a_descontar').val()
    };
    var datosDescuentoJson= JSON.stringify(datosDescuento );

    $.ajax({
        url:UrlInsertarDescuentos,
        type: 'POST',
        data: datosDescuentoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Descuento Agregado');
        },

        error: function(textStatus, errorThrown){
            alert('Error al agregar descuento' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
}

function CargarDescuento(IdDescuento){ //Función que trae los campos que se eligieron editar.
    var datosDescuento = {
        Id_Descuento:IdDescuento
    };
    var datosDescuentoJson=JSON.stringify(datosDescuento);

    $.ajax({
        url: UrlDescuentoeditar,
        type: 'POST',
        data: datosDescuentoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            //Muestra el id junto con su título que se encuentra oculto en el Agregar.
            $('#Id_Descuento').removeAttr('hidden'); // ID
            $('label[for="Id_Descuento"]').removeAttr('hidden'); //Título
        
            $('#Id_Descuento').val(MisItems[0].Id_Descuento).prop('readonly', true);  // Propiedad para que no se pueda modificar el campo.
            $('#Nombre_descuento').val(MisItems[0].Nombre_descuento);
            $('#Porcentaje_a_descontar').val(MisItems[0].Porcentaje_a_descontar);
            
            //Usar el mismo botón de agregar con la funcionalidad de actualizar.
            var btnactualizar = '<input type="submit" id="btn_actualizar" onclick="ActualizarDescuento(' +MisItems[0].Id_Descuento+')"'+
            'value="Actualizar Descuento" class="btn btn-primary"></input>';
            $('#btnagregarDescuento').html(btnactualizar);
            //Cambiar el título del formulario.
            var titulo = '<div class="Col-12" id="titulo">'+
            '<h3>Editar Descuento</h3></div>';
            $('#titulo').html(titulo);
            
        }
    });
}

function ActualizarDescuento(IdDescuento){
    var datosDescuento={
    Id_Descuento: IdDescuento,
    Nombre_descuento: $('#Nombre_descuento').val(),
    Porcentaje_a_descontar: $('#Porcentaje_a_descontar').val()
    };
    var datosDescuentoJson = JSON.stringify(datosDescuento);

    $.ajax({
        url: UrlActualizarDescuentos,
        type: 'PUT',
        data: datosDescuentoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Descuento Actualizado');
        },

        error: function(textStatus, errorThrown){
            alert('Error al actualizar descuento' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
}

function EliminarDescuento(IdDescuento){
    var datosDescuento={
        Id_Descuento:IdDescuento
    };

    var datosDescuentoJson= JSON.stringify(datosDescuento);

    $.ajax({
        url: UrlEliminarDescuentos,
        type: 'DELETE',
        data: datosDescuentoJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Descuento Eliminada');
        },

        error: function(textStatus, errorThrown){
            alert('Error al eliminar descuento' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
    CargarDescuentos();
}
