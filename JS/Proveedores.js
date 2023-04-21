var UrlProveedores = 'http://localhost/SIIS-PROYECTO/controller/proveedores.php?opc=GetProveedores'; //Traer todos los datos
var UrlProveedor = 'http://localhost/SIIS-PROYECTO/controller/proveedores.php?opc=GetProveedor';     //Traer los datos de búsqueda
var UrlInsertarProveedor = 'http://localhost/SIIS-PROYECTO/controller/proveedores.php?opc=InsertProveedor'; // Insertrar
var UrlActualizarProveedor = 'http://localhost/SIIS-PROYECTO/controller/proveedores.php?opc=UpdateProveedor'; // Editar
var UrlEliminarProveedor = 'http://localhost/SIIS-PROYECTO/controller/proveedores.php?opc=DeleteProveedor'; // Eliminar
var UrlProveedoreditar = 'http://localhost/SIIS-PROYECTO/controller/proveedores.php?opc=GetProveedoreditar'; // Traer el dato a editar
var UrlContactoProveedor = 'http://localhost/SIIS-PROYECTO/Formularios/ContactoProveedor.php?id='; //me lleva al formulario contacto proveedor

$(document).ready(function(){
   CargarProveedores();
});

function CargarProveedores(){
    
    $.ajax({
        url : UrlProveedores,
        type: 'GET',
        datatype: 'JSON',
        success: function(reponse){
            var MisItems = reponse;
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
                       { data: 'Id_Proveedor' },
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

/*
function BuscarProveedor(NombreProveedor){
    var datosProveedor = {
        Nombre: isNaN(NombreProveedor) ? NombreProveedor : null,
        Id_Proveedor: isNaN(NombreProveedor) ? null : parseInt(NombreProveedor),
        RTN:isNaN(NombreProveedor) ? null : parseInt(NombreProveedor)
    };
    var datosProveedorJson = JSON.stringify(datosProveedor);

    $.ajax({
        url: UrlProveedor,
        type: 'POST',
        data: datosProveedorJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            var Valores='';
            
            for(i=0; i<MisItems.length; i++){
                Valores+= '<tr>'+
                '<td>'+ MisItems[i].Id_Proveedor +'</td>'+
                '<td>'+ MisItems[i].Nombre +'</td>'+
                '<td>'+ MisItems[i].RTN +'</td>'+
                '<td>'+ 
                '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick=" CargarProveedor('+MisItems[i].Id_Proveedor +'); mostrarFormulario();">Editar</button>'+ 
                '<button class="rounded" style="background-color: #D6234A; color: white; display: inline-block; width: 67px;"  onclick="EliminarProveedor('+MisItems[i].Id_Proveedor +')">Eliminar</button>'+
                '</td>'+
            '</tr>';
            }
            $('#DataProveedores').html(Valores);
        }
    });
}*/

function CargarContactoProveedor(Id_Proveedor) {
    window.location.href = UrlContactoProveedor + Id_Proveedor;
}
  

function AgregarProveedor() {
    var Nombre = $('#Nombre').val();
    var RTN = $('#RTN').val();
    //Permitir letras y espacios
    var patron = /^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/;
    //validar que no hayan campos vacíos 
    if (Nombre.trim() == "" || RTN.trim() == "") {
        alert("Por favor, complete todos los campos.");
        return false;
    } else if (!patron.test(Nombre)) {
        alert("Por favor, ingrese solo letras y espacios en los campos.");
        return false;
    }

    var datosProveedor = {
        Nombre: Nombre,
        RTN: RTN
    };

    var datosProveedorJson = JSON.stringify(datosProveedor);

    $.ajax({
        url:UrlInsertarProveedor,
        type: 'POST',
        data: datosProveedorJson,
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
                text: "Error al guardar el proveedor",
                icon: "error",
                confirmButtonText: "Aceptar",
                closeOnConfirm: false,
                timer: 4000,
               
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
            $('#Id_Proveedor').removeAttr('hidden'); // ID
            $('label[for="Id_Proveedor"]').removeAttr('hidden'); //Título
        
            $('#Id_Proveedor').val(MisItems[0].Id_Proveedor).prop('readonly', true);  // Propiedad para que no se pueda modificar el campo.
            $('#Nombre').val(MisItems[0].Nombre);
            $('#RTN').val(MisItems[0].RTN);
            //Usar el mismo botón de agregar con la funcionalidad de actualizar.
            var btnactualizar = '<input type="submit" id="btn_actualizar" onclick="ActualizarProveedor(' +MisItems[0].Id_Proveedor+')"'+
            'value="Actualizar Proveedor" class="btn btn-primary"> <button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button></input>';
            $('#btnagregarProveedor').html(btnactualizar);
            $('#btncancelar').click(function(){ //Cancela la acción
                location.href = "http://localhost/SIIS-PROYECTO/Formularios/Proveedores.php";
             });
            //Cambiar el título del formulario.
            var titulo = '<div class="Col-12" id="titulo">'+
            '<h3>Editar Proveedor</h3></div>';
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
    
    var datosProveedor = {
        Id_Proveedor: idProveedor,
        Nombre: nombre,
        RTN: rtn
    };
    var datosProveedorJson = JSON.stringify(datosProveedor);

    $.ajax({
        url: UrlActualizarProveedor,
        type: 'PUT',
        data: datosProveedorJson,
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


function EliminarProveedor(idProveedor) {
    Swal.fire({
      title: "¿Eliminar proveedor?",
      text: "Estas Seguro que quieres Eliminar el proveedor, esta acción es irreversible",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, Eliminar!",
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
