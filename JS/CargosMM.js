var UrlCargosMM = 'http://localhost/SIIS-PROYECTO/controller/cargosMM.php?opc=GetCargosMM';
var UrlCargoMM = 'http://localhost/SIIS-PROYECTO/controller/cargosMM.php?opc=GetCargoMM';
var UrlInsertarCargoMM = 'http://localhost/SIIS-PROYECTO/controller/cargosMM.php?opc=InsertCargoMM'; // Insertrar
var UrlActualizarCargoMM = 'http://localhost/SIIS-PROYECTO/controller/cargosMM.php?opc=UpdateCargoMM'; // Editar
var UrlEliminarCargoMM = 'http://localhost/SIIS-PROYECTO/controller/cargosMM.php?opc=DeleteCargoMM'; // Eliminar
var UrlCargoMMeditar = 'http://localhost/SIIS-PROYECTO/controller/cargosMM.php?opc=GetCargoMMeditar'; // Traer el dato a editar

$(document).ready(function(){
   CargarCargosMM();
});

function CargarCargosMM(){
    
    $.ajax({
        url : UrlCargosMM,
        type: 'GET', 
        datatype: 'JSON',
        success: function(reponse){
            var MisItems = reponse;
            // Si la tabla ya ha sido inicializada previamente, destruye la instancia
            if ($.fn.DataTable.isDataTable('#TablaCargos')) {
                $('#TablaCargos').DataTable().destroy();
               }
               $('#TablaCargos').DataTable({
                   processing: true,
                   data: MisItems,
                   "language": {
                       "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                     },
                     columns: [
                       { data: 'Id_Cargo' },
                       { data: 'Nombre_cargo' },
                       { 
                           data: null, 
                           render: function ( data, type, row ) {
                             return '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarCargoMM(\'' + row.Id_Cargo + '\'); mostrarFormulario();">Editar</button>' +
                                    '<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarCargoMM(\'' + row.Id_Cargo + '\')">Eliminar</button>';
                           }
                        }                
                    ]
               });
        }

    });
}

function AgregarCargoMM(){
    var datosCargoMM = {
        Nombre_cargo: $('#Nombre_cargo').val()
    };
    var datosCargoMMJson= JSON.stringify(datosCargoMM );

    $.ajax({
        url:UrlInsertarCargoMM,
        type: 'POST',
        data: datosCargoMMJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Cargo Agregado');
        },

        error: function(textStatus, errorThrown){
            alert('Error al agregar el cargo' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
}

function CargarCargoMM(idCargo){ //Función que trae los campos que se eligieron editar.
    var datosCargoMM = {
        Id_Cargo:idCargo
    };
    var datosCargoMMJson=JSON.stringify(datosCargoMM);

    $.ajax({
        url: UrlCargoMMeditar,
        type: 'POST',
        data: datosCargoMMJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            //Muestra el id junto con su título que se encuentra oculto en el Agregar.
            $('#Id_Cargo').removeAttr('hidden'); // ID
            $('label[for="Id_Cargo"]').removeAttr('hidden'); //Título
        
            $('#Id_Cargo').val(MisItems[0].Id_Cargo).prop('readonly', true);  // Propiedad para que no se pueda modificar el campo.
            $('#Nombre_cargo').val(MisItems[0].Nombre_cargo);

            //Usar el mismo botón de agregar con la funcionalidad de actualizar.
            var btnactualizar = '<input type="submit" id="btn_actualizar" onclick="ActualizarCargoMM(' +MisItems[0].Id_Cargo+')"'+
            'value="Actualizar Cargo" class="btn btn-primary"> <button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button></input>';
            $('#btnagregarCargo').html(btnactualizar);
            $('#btncancelar').click(function(){ //Cancela la acción
                location.href = "http://localhost/SIIS-PROYECTO/Formularios/CargosMM.php";
             });
            //Cambiar el título del formulario.
            var titulo = '<div class="Col-12" id="titulo">'+
            '<h3>Editar Cargo</h3></div>';
            $('#titulo').html(titulo); 
        }
    });
}

function ActualizarCargoMM(idCargo){
    var datosCargoMM={
    Id_Cargo: idCargo,
    Nombre_cargo: $('#Nombre_cargo').val()
    };
    var datosCargoMMJson = JSON.stringify(datosCargoMM);

    $.ajax({
        url: UrlActualizarCargoMM,
        type: 'PUT',
        data: datosCargoMMJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse);
            alert('Cargo Actualizado');
        },

        error: function(textStatus, errorThrown){
            alert('Error al actualizar el cargo' + textStatus + errorThrown);
        }
    });
    alert('Aviso');
}

function EliminarCargoMM(idCargo){
    var confirmacion = confirm("¿Está seguro de que desea eliminar el cargo?");

    if (confirmacion == true) {
        var datosCargoMM = {
            Id_Cargo:idCargo
        };
        var datosCargoMMJson=JSON.stringify(datosCargoMM);
        

        $.ajax({
            url: UrlEliminarCargoMM,
            type: 'DELETE',
            data: datosCargoMMJson,
            datatype: 'JSON',
            contentType: 'application/json',
            success: function(reponse){
                console.log(reponse);
                alert('Cargo Eliminado');
                CargarCargosMM(); 
            },

            error: function(textStatus, errorThrown){
                alert('Error al eliminar el cargo' + textStatus + errorThrown);
            }
        });

    } else {
        alert("La eliminación del cargo ha sido cancelada.");
    }
}
