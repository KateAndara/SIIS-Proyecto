var UrlClientes = 'http://localhost/SIIS-PROYECTO/controller/cliente.php?opc=GetClientes'; //Traer todos los datos
var UrlCliente = 'http://localhost/SIIS-PROYECTO/controller/cliente.php?opc=GetCliente';     //Traer los datos de búsqueda
var UrlInsertarClientes = 'http://localhost/SIIS-PROYECTO/controller/cliente.php?opc=InsertCliente'; // Insertrar
var UrlActualizarClientes = 'http://localhost/SIIS-PROYECTO/controller/cliente.php?opc=UpdateCliente'; // Editar
var UrlEliminarClientes = 'http://localhost/SIIS-PROYECTO/controller/cliente.php?opc=DeleteCliente'; // Eliminar
var UrlClienteditar = 'http://localhost/SIIS-PROYECTO/controller/cliente.php?opc=GetClienteditar'; // Traer el dato a editar
var UrlContactoCliente = 'http://localhost/SIIS-PROYECTO/Formularios/ContactoClienteMM.php?id='; //me lleva al formulario contacto cliente

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
            $("#TablaClientes").DataTable({
              processing: true,
              data: MisItems,
              language: {
                url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
              },
              columns: [
                { data: "Id_Cliente" },
                { data: "Nombre" },
                { data: "Fecha_nacimiento" },
                { data: "DNI" },
                { data: "options"},

                {
                  data: null,
                  render: function (data, type, row) {
                    return (
                      '<button class="rounded" style="background-color: #008000; color: white; display: inline-block; width: 90px;" onclick="CargarContactoCliente(\'' +
                      row.Id_Cliente +
                      "');\">Contacto</button>"
                    );
                  },
                },
                /* { 
                        data: null, 
                        render: function ( data, type, row ) {
                          return '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarCliente(\'' + row.Id_Cliente + '\'); mostrarFormulario();">Editar</button>' +
                                 '<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarCliente(\'' + row.Id_Cliente + '\')">Eliminar</button>';
                        }
                      } */ 
              ],
            });
        }
    });
}


function CargarContactoCliente(Id_Cliente) {
  window.location.href = UrlContactoCliente + Id_Cliente;
}

function AgregarCliente(){
    nombre=document.querySelector("#Nombre").value;
    fechaNacimiento=document.querySelector("#Fecha_nacimiento").value;
    dni=document.querySelector("#DNI").value;

    console.log(nombre);
    console.log(fechaNacimiento);
    console.log(dni);

    if ( nombre == "" ||fechaNacimiento == "" ||dni == "" ) {
         swal.fire("Atención", "Todos los campos son obligatorios.", "error");
         return false;
      }
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
            console.log(reponse.status);
              swal.fire({
                title: "LISTO!",
                text: reponse.msg,
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
                text: "Error al guardar el Cargo",
                icon: "error",
                confirmButtonText: "Aceptar",
                closeOnConfirm: false,
                timer: 4000,
               
              });
        },
    });
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
            var btnactualizar = '<a id="btn_actualizar" onclick="ActualizarCliente(' +MisItems[0].Id_Cliente+')"'+
            'value="Actualizar Cliente" class="btn btn-primary">Actualizar Cliente</a><button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button></input>';
            $('#btnagregarCliente').html(btnactualizar);
            $('#btncancelar').click(function(){ //Cancela la acción
                location.href = "http://localhost/SIIS-PROYECTO/Formularios/Clientes.php";
             });
            //Cambiar el título del formulario.
            var titulo = '<div class="Col-12" id="titulo">'+
            '<h3>Editar Cliente</h3></div>';
            $('#titulo').html(titulo);
            
        }
    });
}

function ActualizarCliente(IdCliente){
    nombre=document.querySelector("#Nombre").value;
    fechaNacimiento=document.querySelector("#Fecha_nacimiento").value;
    dni=document.querySelector("#DNI").value;

    console.log(nombre);
    console.log(fechaNacimiento);
    console.log(dni);

    if ( nombre == "" ||fechaNacimiento == "" ||dni == "" ) {
         swal.fire("Atención", "Todos los campos son obligatorios.", "error");
         return false;
      }
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
                swal.fire({
                  title: "LISTO!",
                  text: reponse.msg,
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
                text: reponse,
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


function EliminarCliente(idCliente) {
    Swal.fire({
      title: "¿Eliminar Cliente?",
      text: "Estas Seguro que quieres Eliminar el cliente, esta acción es irreversible",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, Eliminar!",
    }).then((result) => { 
      if (result.isConfirmed) {
        var datosCliente = {
            Id_Cliente: idCliente,
        };
        var datosCliente = JSON.stringify(datosCliente);
        $.ajax({
          url: UrlEliminarClientes,
          type: "DELETE",
          data: datosCliente,
          datatype: "JSON",
          success: function (response) {
            Swal.fire({
              title: "Eliminado",
              text: "Cliente eliminado Correctamente.",
              icon: "success",
              timer: 4000,
              willClose: () => {
                location.reload();
              },
            });
          },
          error: function(textStatus, errorThrown){
            Swal.fire({
              title: "Lo sentimos",
              text: "Los datos no pueden ser eliminados.",
              icon: "warning",
              timer: 4000,
              willClose: () => {
                location.reload();
              },
            });        
          }
  
        });
      }

    });
  }

 