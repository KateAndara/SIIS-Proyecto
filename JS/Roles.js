var UrlRoles = 'http://localhost/SIIS-PROYECTO/controller/roles.php?opc=GetRoles'; //Traer todos los datos
var UrlRol = 'http://localhost/SIIS-PROYECTO/controller/roles.php?opc=GetRol';     //Traer los datos de búsqueda
var UrlInsertarRol = 'http://localhost/SIIS-PROYECTO/controller/roles.php?opc=InsertRol'; // Insertrar
var UrlActualizarRol = 'http://localhost/SIIS-PROYECTO/controller/roles.php?opc=UpdateRol'; // Editar
var UrlEliminarRol = 'http://localhost/SIIS-PROYECTO/controller/roles.php?opc=DeleteRol'; // Eliminar
var UrlRoleditar = 'http://localhost/SIIS-PROYECTO/controller/roles.php?opc=GetRoleditar'; // Traer el dato a editar
var urlPermisos = 'http://localhost/SIIS-PROYECTO/Formularios/EditarPermisos.php'; // Traer el dato a editar
var urlPermisoRol= 'http://localhost/SIIS-PROYECTO/controller/roles.php?opc=GetPermisos'; // Traer el dato a editar
var urlPermisosInsert= 'http://localhost/SIIS-PROYECTO/controller/roles.php?opc=setPermisos'; // Traer el dato a editar


$(document).ready(function(){
   CargarRoles();
});

function CargarRoles(){
    
    $.ajax({
        url : UrlRoles,
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
            if ($.fn.DataTable.isDataTable('#TablaRoles')) {
                $('#TablaRoles').DataTable().destroy();
               }
               $("#TablaRoles").DataTable({
                 processing: true,
                 data: MisItems,
                 language: {
                   url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
                 },
                 columns: [
                   { data: 'Numero' }, // Mostrar la secuencia de números
                   { data: "Rol" },
                   { data: "Descripcion" },
                   { data: "options" },
                   /*  { 
                           data: null, 
                           render: function ( data, type, row ) {
                             return '<button  style="background-color: #2D7AC0; color: white; display: inline-block; width: 80px;" class="rounded bg-success"  onclick="CargarPermiso(\'' + row.Id_Rol + '\'); mostrarFormulario2();">Permisos</button>'+ '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarRol(\'' + row.Id_Rol + '\'); mostrarFormulario();">Editar</button>' +
                                    '<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarRol(\'' + row.Id_Rol + '\')">Eliminar</button>';
                           }
                         }  */
                 ],
               });
           }
       });
   }



function CargarPermiso(idRol) {
  var datosRol = {
    idRol: idRol,
  };
    var datosRolJson=JSON.stringify(datosRol);

    $.ajax({
      url: urlPermisoRol,
      type: "POST",
      data: datosRolJson,
      datatype: "JSON",
      contentType: "application/json",
      success: function (reponse) {

            var MisItems = reponse;
            console.log(MisItems);
            document.querySelector("#tituloPermisos").innerHTML="Permisos - "+MisItems.nombreRol;
   
        document.querySelector("#getPermisos").innerHTML = MisItems.htmlPermisos;
      },
    });
}

function gurdarPermisos() {
  
    formPermisos = document.querySelector("#formPermisos");
        


   let request = (window.XMLHttpRequest) ? 
                         new XMLHttpRequest() : 
                         new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = urlPermisosInsert;

    let formData = new FormData(formPermisos);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange=function(){
        if(request.readyState !=4) return;
        if(request.status == 200){
        let objData = JSON.parse(request.responseText);
            swal.fire({
              title: "LISTO!",
              text: objData.msg,
              icon: "success",
              confirmButtonText: "Aceptar",
              closeOnConfirm: false,
              timer: 3000,
              /* willClose: () => {
                window.location.reload();
              }, */
            });
        }
    }
}

function generarPDF() {
   idRol= document.querySelector("#idrol").value
  // Crear la URL del PDF
  var urlPDF =
    "http://localhost/SIIS-PROYECTO/Reportes/reportePermisos.php?rol="+idRol;

  // Abrir el PDF en una nueva ventana del navegador
  window.open(urlPDF, "_blank");

  // Redirigir al usuario después de cerrar el PDF
  window.location.href = "../Formularios/Roles.php";
}

/*
function BuscarRol(NombreRol){
    var datosRol = {
        Nombre: isNaN(NombreRol) ? NombreRol : null,
        Id_Rol: isNaN(NombreRol) ? null : parseInt(NombreRol),
        Descripcion:isNaN(NombreRol) ? null : parseInt(NombreRol)
    };
    var datosRolJson = JSON.stringify(datosRol);

    $.ajax({
        url: UrlRol,
        type: 'POST',
        data: datosRolJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            var Valores='';
            
            for(i=0; i<MisItems.length; i++){
                Valores+= '<tr>'+
                '<td>'+ MisItems[i].Id_Rol +'</td>'+
                '<td>'+ MisItems[i].Rol +'</td>'+
                '<td>'+ MisItems[i].Descripcion +'</td>'+
                '<td>'+ 
                '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick=" CargarRol('+MisItems[i].Id_Rol +'); mostrarFormulario();">Editar</button>'+ 
                '<button class="rounded" style="background-color: #D6234A; color: white; display: inline-block; width: 67px;"  onclick="EliminarRol('+MisItems[i].Id_Rol +')">Eliminar</button>'+
                '</td>'+
            '</tr>';
            }
            $('#DataRoles').html(Valores);
        }
    });
}*/
function validarFormulario(event) {
    var Rol = $('#Rol').val();
    var Descripcion = $('#Descripcion').val();
    
    if (Rol.trim() === "" || Descripcion.trim() === "") {
        swal.fire("Atención", "Todos los campos son obligatorios.", "error");
        event.preventDefault(); // Prevenir el envío del formulario
        return false;
    }
    return true; // Permitir el envío del formulario
}

function AgregarRol() {
    var isValid = validarFormulario(event); // Llama a la función de validación
    
    if (!isValid) {
        return false; // Prevenir el envío del formulario
    }
    

    Rol=document.querySelector("#Rol").value;
    Descripcion=document.querySelector("#Descripcion").value;


    console.log(Rol);
    console.log(Descripcion);

    
    if ( Rol == "" ||Descripcion == "") {
        swal.fire("Atención", "Todos los campos son obligatorios.", "error");
        return false;
     }
    var datosRol = {
        Rol: $('#Rol').val(),
        Descripcion: $('#Descripcion').val()
    };

    var datosRolJson = JSON.stringify(datosRol);

    $.ajax({
        url: UrlInsertarRol,
        type: 'POST',
        data: datosRolJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            console.log(reponse.status);
              swal.fire({
                title: "LISTO!",
                text: "Rol agregado con éxito",
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
                text: "Error al guardar el Rol",
                icon: "error",
                confirmButtonText: "Aceptar",
                closeOnConfirm: false,
                timer: 4000,
               
              });
        },
    });

    return false; // Prevenir el envío del formulario después de la acción AJAX
}



function CargarRol(idRol){ //Función que trae los campos que se eligieron editar.
    var datosRol = {
        Id_Rol:idRol
    };
    var datosRolJson=JSON.stringify(datosRol);

    $.ajax({
        url: UrlRoleditar,
        type: 'POST',
        data: datosRolJson,
        datatype: 'JSON',
        contentType: 'application/json',
        success: function(reponse){
            var MisItems = reponse;
            //Muestra el id junto con su título que se encuentra oculto en el Agregar.
            //$('#Id_Rol').removeAttr('hidden'); // ID
            document.getElementById('Id_Rol').style.display = 'none';

            $('label[for="Id_Rol"]').removeAttr('hidden'); //Título
        
            $('#Id_Rol').val(MisItems[0].Id_Rol).prop('readonly', true);  // Propiedad para que no se pueda modificar el campo.
            $('#Rol').val(MisItems[0].Rol);
            $('#Descripcion').val(MisItems[0].Descripcion);
            //Usar el mismo botón de agregar con la funcionalidad de actualizar.
            var btnactualizar = '<a id="btn_actualizar" onclick="ActualizarRol(' +MisItems[0].Id_Rol+')"'+
            'value="Actualizar Rol" class="btn btn-primary">Actualizar Rol</a> <button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button></input>';
            $('#btnagregarRol').html(btnactualizar);
            $('#btncancelar').click(function(){ //Cancela la acción
                location.href = "http://localhost/SIIS-PROYECTO/Formularios/Roles.php";
             });
            //Cambiar el título del formulario.
            var titulo = '<div class="Col-12" id="titulo">'+
            '<h3 style="color: black;">Editar Rol</h3></div>';
            $('#titulo').html(titulo); 
        }
    });
}
function ActualizarRol(idRol){
  var isValid = validarFormulario(event); // Llama a la función de validación
  
  if (!isValid) {
      return false; // Prevenir el envío del formulario
  }
  var rol = $('#Rol').val();
  var descripcion = $('#Descripcion').val();
  
  var datosRol = {
      Id_Rol: idRol,
      Rol: rol,
      Descripcion: descripcion
  };
  var datosRolJson = JSON.stringify(datosRol);

  $.ajax({
      url: UrlActualizarRol,
      type: 'PUT',
      data: datosRolJson,
      datatype: 'JSON',
      contentType: 'application/json',
      success: function(response){
          console.log(response);
          swal.fire({
              title: "Éxito",
              text: "Rol actualizado correctamente.",
              icon: "success"
          }).then(function() {
            window.location.reload();

          });
      },
      error: function(textStatus, errorThrown){
          swal.fire({
              title: "Error",
              text: "Error al actualizar el rol.",
              icon: "error"
          });
      }
  });
}



function EliminarRol(idRol){
    Swal.fire({
        title: "¿Desea eliminar el Rol?",
        text: "Estas Seguro que quieres Eliminar el Rol, esta acción es irreversible",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, Eliminar!",
      }).then((result) => {
        if (result.isConfirmed) {
        var datosRol={
            Id_Rol:idRol
        };

        var datosRolJson= JSON.stringify(datosRol);

        $.ajax({
            url: UrlEliminarRol,
            type: 'DELETE',
            data: datosRolJson,
            datatype: 'JSON',
            contentType: 'application/json',
            success: function (response) {
                //Swal.fire("Cancelada!", "Compra Cancelada Correctamente.", "success");
                Swal.fire({
                  title: "LISTO",
                  text: "Rol Eliminado Correctamente",
                  icon: "success",
                  timer: 3000,
                  willClose: () => {
                    location.reload();
                  },
                });
              },
              error: function(textStatus, errorThrown){
                Swal.fire({
                    title: 'Este Rol no puede ser eliminado',
                    icon: 'error',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar'
                });
            }
            });
          }
        });
     }
     