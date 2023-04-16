var UrlTalonarios =
  "http://localhost/SIIS-PROYECTO/controller/Talonario.php?opc=GetTalonarios"; //Traer todos los datos
var UrlRol = "http://localhost/SIIS-PROYECTO/controller/Talonario.php?opc=GetTalonario"; //Traer los datos de búsqueda
var UrlInsertarTalonario =
  "http://localhost/SIIS-PROYECTO/controller/Talonario.php?opc=insertTalonario"; // Insertrar
var UrlActualizarTalonario =
  "http://localhost/SIIS-PROYECTO/controller/Talonario.php?opc=UpdateTalonario"; // Editar
var urlDeleteTalonario =
  "http://localhost/SIIS-PROYECTO/controller/Talonario.php?opc=deleteTalonario"; // Eliminar
var urlEditarTalonario =
  "http://localhost/SIIS-PROYECTO/controller/Talonario.php?opc=urlEditarTalonario"; // Traer el dato a editar

$(document).ready(function () {
  CargarTalonario();

});

function CargarTalonario() {
  $.ajax({
    url: UrlTalonarios,
    type: "GET",
    datatype: "JSON",
    success: function (reponse) {
      var MisItems = reponse;
      // Si la tabla ya ha sido inicializada previamente, destruye la instancia
      if ($.fn.DataTable.isDataTable("#tablaTalonario")) {
        $("#tablaTalonario").DataTable().destroy();
      }
      $("#tablaTalonario").DataTable({
        processing: true,
        data: MisItems,
        language: {
          url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
        },
        columns: [
          { data: "Id_Talonario" },
          { data: "Numero_CAI" },
          { data: "Rango_Inicial" },
          { data: "Rango_final" },
          { data: "Rango_actual" },
          { data: "Fecha_Vencimiento" },

          {
            data: null,
            render: function (data, type, row) {
              return (
                '<button class="rounded mr-2" style=" background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarEditarTalonario(\'' + row.Id_Talonario +"'); mostrarFormulario();\">Editar</button>" +
                '<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarTalonario(\'' + row.Id_Talonario +"')\">Eliminar</button>"
              );
            },
          },
        ],
      });
    },
  });
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

function agregarTalonario() {

  numCai=document.querySelector("#CAI").value;
  rangeInicial = document.querySelector("#rangeInicial").value;
  rangeFinal = document.querySelector("#rangeFinal").value;
  rangeActual = document.querySelector("#rangeActual").value;
  dateVencimiento = document.querySelector("#date_vencimiento").value;

  console.log(numCai);
  console.log(rangeInicial);
  console.log(rangeFinal);
  console.log(rangeActual);
  console.log(dateVencimiento);
 

  if (
    numCai == "" ||
    rangeInicial == "" ||
    rangeActual == "" ||
    rangeActual == "" ||
    dateVencimiento == ""
  ) {
     swal.fire("Atención", "Todos los campos son obligatorios.", "error");
     return false;
  }



  var DatosTalonario = {
    numCai: numCai,
    rangeInicial: rangeInicial,
    rangeFinal: rangeFinal,
    rangeActual: rangeActual,
    dateVencimiento: dateVencimiento,
  };
  var DatosTalonarioJson = JSON.stringify(DatosTalonario);

  $.ajax({
    url: UrlInsertarTalonario,
    type: "POST",
    data: DatosTalonarioJson,
    datatype: "JSON",
    contentType: "application/json",
    success: function (reponse) {
      console.log(reponse.status);
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
     swal.fire({
       title: "Error!",
       text: "Error al guardar el Talonario",
       icon: "error",
       confirmButtonText: "Aceptar",
       closeOnConfirm: false,
       timer: 3000,
      
     });
    },
  });

}

function CargarEditarTalonario(idTalonario) {
  //Función que trae los campos que se eligieron editar.
  var datosTalonario = {
    idTalonario: idTalonario,
  };
  var datosTalonarioJson = JSON.stringify(datosTalonario);

  $.ajax({
    url: urlEditarTalonario,
    type: "POST",
    data: datosTalonarioJson,
    datatype: "JSON",
    contentType: "application/json",
    success: function (reponse) {
      var MisItems = reponse;
      console.log(MisItems);
      //Muestra el id junto con su título que se encuentra oculto en el Agregar.
      //$("#Id_Rol").removeAttr("hidden"); // ID
      //$('label[for="Id_Rol"]').removeAttr("hidden"); //Título

      $("#Id_Talonario").val(MisItems[0].Id_Talonario).prop("readonly", true); // Propiedad para que no se pueda modificar el campo.
      $("#CAI").val(MisItems[0].Numero_CAI);
      $("#rangeInicial").val(MisItems[0].Rango_Inicial);
      $("#num").html(MisItems[0].Rango_Inicial);

      $("#rangeFinal").val(MisItems[0].Rango_final);
      $("#num2").html(MisItems[0].Rango_final);

      $("#rangeActual").val(MisItems[0].Rango_actual);
      $("#date_vencimiento").val(MisItems[0].Fecha_Vencimiento);

      //Usar el mismo botón de agregar con la funcionalidad de actualizar.
      var btnactualizar =
        '<a id="btn_actualizar" onclick="ActualizarTalonario(' +
        MisItems[0].Id_Talonario +
        ')"' +'value="" class="btn btn-primary mr-3">Actualizar Talonario </a><button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button>';
      $("#btnagregarRol").html(btnactualizar);
      $("#btncancelar").click(function () {
        //Cancela la acción
        location.href = "http://localhost/SIIS-PROYECTO/Formularios/Talonario.php";
      });
      //Cambiar el título del formulario.
      var titulo =
        '<div class="Col-12" id="titulo">' + "<h3>Editar Talonario</h3></div>";
      $("#titulo").html(titulo);
    },
  });
}

function ActualizarTalonario(idRol) {
  idTalonario = document.querySelector("#Id_Talonario").value;

  numCai = document.querySelector("#CAI").value;
  rangeInicial = document.querySelector("#rangeInicial").value;
  rangeFinal = document.querySelector("#rangeFinal").value;
  rangeActual = document.querySelector("#rangeActual").value;
  dateVencimiento = document.querySelector("#date_vencimiento").value;

  if (
    numCai == "" ||
    rangeInicial == "" ||
    rangeActual == "" ||
    rangeActual == "" ||
    dateVencimiento == ""
  ) {
    swal.fire("Atención", "Todos los campos son obligatorios.", "error");
    return false;
  }

  
  var DatosTalonario = {

    idTalonario:idTalonario,
    numCai: numCai,
    rangeInicial: rangeInicial,
    rangeFinal: rangeFinal,
    rangeActual: rangeActual,
    dateVencimiento: dateVencimiento,
  };
  var datosTalonarioJson = JSON.stringify(DatosTalonario);

  $.ajax({
    url: UrlActualizarTalonario,
    type: "PUT",
    data: datosTalonarioJson,
    datatype: "JSON",
    contentType: "application/json",
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

function EliminarTalonario(idTalonario) {
  Swal.fire({
    title: "Eliminar Talonario?",
    text: "Estas Seguro que quieres Eliminar el Talonario, esta acción es irreversible",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Eliminar!",
  }).then((result) => {
    if (result.isConfirmed) {
      var datosTalonario = {
        idTalonario: idTalonario,
      };
      var datosTalonario = JSON.stringify(datosTalonario);
      $.ajax({
        url: urlDeleteTalonario,
        type: "DELETE",
        data: datosTalonario,
        datatype: "JSON",
        success: function (response) {
          //Swal.fire("Cancelada!", "Elimitar talonario Cancelada Correctamente.", "success");
          Swal.fire({
            title: "Eliminado",
            text: "Talonario eliminado Correctamente.",
            icon: "success",
            timer: 4000,
            willClose: () => {
              location.reload();
            },
          });
        },
      });
    }
  });
}

function controlTagNumeroEmpresa(e) {

  tecla = document.all ? e.keyCode : e.which;
  if (tecla == 8) return true;
  else if (tecla == 0 || tecla == 9) return true;
  patron = /[0-9+-\s]/;
  n = String.fromCharCode(tecla);
  return patron.test(n);
}