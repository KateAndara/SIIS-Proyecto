var UrlClientes = 'http://localhost/SIIS-PROYECTO/controller/cliente.php?opc=GetClientes'; //Traer todos los datos
var UrlCliente = 'http://localhost/SIIS-PROYECTO/controller/cliente.php?opc=GetCliente';     //Traer los datos de búsqueda
var UrlInsertarClientes = 'http://localhost/SIIS-PROYECTO/controller/cliente.php?opc=InsertCliente'; // Insertrar
var UrlActualizarClientes = 'http://localhost/SIIS-PROYECTO/controller/cliente.php?opc=UpdateCliente'; // Editar
var UrlEliminarClientes = 'http://localhost/SIIS-PROYECTO/controller/cliente.php?opc=DeleteCliente'; // Eliminar
var UrlClienteditar = 'http://localhost/SIIS-PROYECTO/controller/cliente.php?opc=GetClienteditar'; // Traer el dato a editar
var UrlContactoCliente = 'http://localhost/SIIS-PROYECTO/Formularios/ContactoClienteMM.php?id='; //me lleva al formulario contacto cliente

$(document).ready(function(){
   CargarClientes();
   fntValidNumberDni();
});


function testEnteroDni(intCant) {
  var intCantidad = new RegExp(/^([0-9]{13})$/);
  if (intCantidad.test(intCant)) {
    return true;
  } else {
    return false;
  }
}

function testFormatoDni(inputValue) {
  // Expresión regular para validar el formato "0000-0000-00000"
  let formatoDniRegex = /^\d{4}-\d{4}-\d{5}$/;

  // Testea si el valor coincide con el formato esperado
  return formatoDniRegex.test(inputValue);
}

function fntValidNumberDni() {
  let validNumberDni = document.querySelectorAll(".validNumberDni");
  validNumberDni.forEach(function (inputElement) {
    inputElement.addEventListener("keyup", function () {
      let inputValue = this.value;
      if (!testFormatoDni(inputValue)) {
        this.classList.add("is-invalid");
      } else {
        this.classList.remove("is-invalid");
      }
    });
  });
}
function CargarClientes(){
    
    $.ajax({
        url : UrlClientes,
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
                { data: "Numero" },
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

      let DNIvalid = document.querySelector("#DNI");
      if (DNIvalid.classList.contains("is-invalid")) {
        swal.fire({
          title: "Atención",
          html: "El formato del DNI no es válido.<br>Debe ser: 0000-0000-00000",
          icon: "error"
        });  
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
        
        success: function (reponse) {
          if (reponse.status) {
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
          } else {
            swal.fire({
              title: "Error!",
              text: reponse.msg,
              icon: "error",
              confirmButtonText: "Aceptar",
              closeOnConfirm: false,
            });
          }
        },
        error: function (textStatus, errorThrown) {
          Swal.fire({
            title: "LISTO",
            text: "Cliente Agregado",
            icon: "success",
          }).then(() => {
            window.location.reload();
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
            document.getElementById('Id_Cliente').style.display = 'none';
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
            '<h3 style="color: black;">Editar Cliente</h3></div>';
            $('#titulo').html(titulo);
            
        }
    });
}

function ActualizarCliente(IdCliente){
    nombre=document.querySelector("#Nombre").value;
    fechaNacimiento=document.querySelector("#Fecha_nacimiento").value;
    dni=document.querySelector("#DNI").value;


    if ( nombre == "" ||fechaNacimiento == "" ||dni == "" ) {
         swal.fire("Atención", "Todos los campos son obligatorios.", "error");
         return false;
      }
    
    let DNIvalid = document.querySelector("#DNI");
    if (DNIvalid.classList.contains("is-invalid")) {
      swal.fire({
        title: "Atención",
        html: "El formato del DNI no es válido.<br>Debe ser: 0000-0000-00000",
        icon: "error"
      });  
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
        success: function (reponse) {
          if (reponse.status) {
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
          } else {
            swal.fire({
              title: "Error!",
              text: reponse.msg,
              icon: "error",
              confirmButtonText: "Aceptar",
              closeOnConfirm: false,
            });
          }
        },
    });
}


function EliminarCliente(idCliente) {
    Swal.fire({
      title: "¿Eliminar cliente?",
      text: "¿Está seguro que desea eliminar el cliente? Esta acción es irreversible",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Sí, eliminar",
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
              text: "Cliente eliminado correctamente.",
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
              text: "El cliente no puedo ser eliminado.",
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

 