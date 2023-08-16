var UrlProveedores = 'http://localhost/SIIS-PROYECTO/controller/proveedores.php?opc=GetProveedores'; //Traer todos los datos
var UrlProveedor = 'http://localhost/SIIS-PROYECTO/controller/proveedores.php?opc=GetProveedor';     //Traer los datos de búsqueda
var UrlInsertarProveedor = 'http://localhost/SIIS-PROYECTO/controller/proveedores.php?opc=InsertProveedor'; // Insertrar
var UrlActualizarProveedor = 'http://localhost/SIIS-PROYECTO/controller/proveedores.php?opc=UpdateProveedor'; // Editar
var UrlEliminarProveedor = 'http://localhost/SIIS-PROYECTO/controller/proveedores.php?opc=DeleteProveedor'; // Eliminar
var UrlProveedoreditar = 'http://localhost/SIIS-PROYECTO/controller/proveedores.php?opc=GetProveedoreditar'; // Traer el dato a editar
var UrlContactoProveedor = 'http://localhost/SIIS-PROYECTO/Formularios/ContactoProveedorMM.php?id='; //me lleva al formulario contacto proveedor

$(document).ready(function(){
   CargarProveedores();
   fntValidNumberDni();
});

function testEnteroDni(intCant) {
  var intCantidad = new RegExp(/^([0-9]{14})$/);
  if (intCantidad.test(intCant)) {
    return true;
  } else {
    return false;
  }
}

function testFormatoDni(inputValue) {
  // Expresión regular para validar el formato "0000-0000-00000"
  let formatoDniRegex = /^\d{4}-\d{4}-\d{6}$/;

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

function CargarProveedores(){
    
    $.ajax({
        url : UrlProveedores,
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
            if ($.fn.DataTable.isDataTable('#TablaProveedores')) {
                $('#TablaProveedores').DataTable().destroy();
               }
               $('#TablaProveedores').DataTable({
                   processing: true,
                   data: MisItems,
                   "language": {
                       "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                     },
                     columns: [
                       { data: 'Numero' }, // Mostrar la secuencia de números
                       { data: 'Nombre' },
                       { data: 'RTN' },
                       { data: "options" },

                       {
                        data: null,
                        render: function (data, type, row) {
                          return (
                            '<button class="rounded" style="background-color: #008000; color: white; display: inline-block; width: 90px;" onclick="CargarContactoProveedor(\'' +
                            row.Id_Proveedor +
                            "');\">Contacto</button>"
                          );
                        },
                      },
                       /* { 
                               data: null, 
                               render: function ( data, type, row ) {
                                 return '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarObjeto(\'' + row.Id_Objeto + '\'); mostrarFormulario();">Editar</button>' +
                                        '<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarObjeto(\'' + row.Id_Objeto + '\')">Eliminar</button>';
                               }
                             }  */    
                    ]
               });
           }
       });
   }

function CargarContactoProveedor(Id_Proveedor) {
    window.location.href = UrlContactoProveedor + Id_Proveedor;
}
  

function AgregarProveedor() {
    nombre=document.querySelector("#Nombre").value;
    rtn=document.querySelector("#RTN").value;
   
    console.log(nombre);
    console.log(rtn);

    //validar que no hayan campos vacíos 

    if ( nombre == "" ||rtn == "") {
      swal.fire("Atención", "Todos los campos son obligatorios.", "error");
      return false;
    } 
    let DNIvalid = document.querySelector("#RTN");
      if (DNIvalid.classList.contains("is-invalid")) {
        swal.fire({
          title: "Atención",
          html: "El formato del RTN no es válido.<br>Debe ser: 0000-0000-000000",
          icon: "error"
        });  
         return false;
       }

    var datosProveedor = {
      Nombre: $('#Nombre').val(),
      RTN: $('#RTN').val()
      };

    var datosProveedorJson = JSON.stringify(datosProveedor);

    $.ajax({
        url:UrlInsertarProveedor,
        type: 'POST',
        data: datosProveedorJson,
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
            text: "Proveedor Agregado",
            icon: "success",
          }).then(() => {
            window.location.reload();
          });
          
        },
    });
}

function CargarProveedor(idProveedor){ //Función que trae los campos que se eligieron editar.
    var datosProveedor = {
        Id_Proveedor:idProveedor
    };
    var datosProveedorJson=JSON.stringify(datosProveedor);

    $.ajax({
        url: UrlProveedoreditar,
        type: 'POST',
        data: datosProveedorJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            //Muestra el id junto con su título que se encuentra oculto en el Agregar.
            document.getElementById('Id_Proveedor').style.display = 'none';
            $('label[for="Id_Proveedor"]').removeAttr('hidden'); //Título
        
            $('#Id_Proveedor').val(MisItems[0].Id_Proveedor).prop('readonly', true);  // Propiedad para que no se pueda modificar el campo.
            $('#Nombre').val(MisItems[0].Nombre);
            $('#RTN').val(MisItems[0].RTN);
            //Usar el mismo botón de agregar con la funcionalidad de actualizar.
            var btnactualizar = '<a  id="btn_actualizar" onclick="ActualizarProveedor(' +MisItems[0].Id_Proveedor+')"'+
            'value="Actualizar Proveedor" class="btn btn-primary">Actualizar Proveedor </a><button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button></input>';
            $('#btnagregarProveedor').html(btnactualizar);
            $('#btncancelar').click(function(){ //Cancela la acción
                location.href = "http://localhost/SIIS-PROYECTO/Formularios/Proveedores.php";
             });
            //Cambiar el título del formulario.
            var titulo = '<div class="Col-12" id="titulo">'+
            '<h3 style="color: black;">Editar Proveedor</h3></div>';
            $('#titulo').html(titulo); 
        }
    });
}

function ActualizarProveedor(idProveedor){
    var nombre = $('#Nombre').val();
    var rtn = $('#RTN').val();
    
    // Validar campos vacíos
    if (nombre.trim() === '' || rtn.trim() === '') {
        swal.fire("Atención", "Todos los campos son obligatorios.", "error");
        return false;
    }
    
    // Validar solo letras y espacios
    var regex = /^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/;
    if (!regex.test(nombre)) {
        alert('Por favor utiliza solo letras y espacios');
        return;
    }

    let DNIvalid = document.querySelector("#RTN");
      if (DNIvalid.classList.contains("is-invalid")) {
        swal.fire({
          title: "Atención",
          html: "El formato del RTN no es válido.<br>Debe ser: 0000-0000-000000",
          icon: "error"
        });  
         return false;
       }
    
    var datosProveedor = {
        Id_Proveedor: idProveedor,
        Nombre: $('#Nombre').val(),
        RTN: $('#RTN').val()
    };
    var datosProveedorJson = JSON.stringify(datosProveedor);

    $.ajax({
        url: UrlActualizarProveedor,
        type: 'PUT',
        data: datosProveedorJson,
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


function EliminarProveedor(idProveedor) {
    Swal.fire({
      title: "¿Eliminar proveedor?",
      text: "¿Estás seguro que quieres Eliminar el proveedor? Esta acción es irreversible.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "¡Sí, eliminar!",
    }).then((result) => { 
      if (result.isConfirmed) {
        var datosProveedor = {
            Id_Proveedor: idProveedor,
        };
        var datosProveedor = JSON.stringify(datosProveedor);
        $.ajax({
          url: UrlEliminarProveedor,
          type: "DELETE",
          data: datosProveedor,
          datatype: "JSON",
          success: function (response) {
            Swal.fire({
              title: "Eliminado",
              text: "Proveedor eliminado Correctamente.",
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
