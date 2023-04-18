var UrlUsuarios = 'http://localhost/SIIS-PROYECTO/controller/Usuarios.php?opc=GetUsuarios'; //Traer todos los datos
var UrlUsuario = 'http://localhost/SIIS-PROYECTO/controller/Usuarios.php?opc=GetRol';     //Traer los datos de búsqueda
var UrlInsertarUsuario = 'http://localhost/SIIS-PROYECTO/controller/Usuarios.php?opc=InsertUsuario'; // Insertrar
var UrlActualizarUsuario = 'http://localhost/SIIS-PROYECTO/controller/Usuarios.php?opc=UpdateUsuario'; // Editar
var UrlEilinarUsuario = 'http://localhost/SIIS-PROYECTO/controller/Usuarios.php?opc=deleteUsuario'; // Eliminar
var UrlUsuarioseditar = 'http://localhost/SIIS-PROYECTO/controller/Usuarios.php?opc=GetUsuarioeditar'; // Traer el dato a editar
var UrlGetRoles = 'http://localhost/SIIS-PROYECTO/controller/Usuarios.php?opc=GetRoles'; // Traer el dato a editar

var UrlGetCargos = 'http://localhost/SIIS-PROYECTO/controller/Usuarios.php?opc=GetCargos'; // Traer el dato a editar


$(document).ready(function(){
   CargarUsuarios();
   CargarRoles();
   fntValidText();
   fntValidNumberDni();
   fntValidEmail();
   fntValidContra();
   CargarCargos();
});



//validaciones
function testText(txtString) {
  var stringText = new RegExp(
    /^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü]+(\s[a-zA-ZÑñÁáÉéÍíÓóÚúÜü]+)*$/
  );
  if (stringText.test(txtString)) {
    return true;
  } else {
    return false;
  }
}

function testEnteroDni(intCant) {
  var intCantidad = new RegExp(/^([0-9]{13})$/);
  if (intCantidad.test(intCant)) {
    return true;
  } else {
    return false;
  }
}
function fntEmailValidate(email) {
  var stringEmail = new RegExp(
    /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})$/
  );
  if (stringEmail.test(email) == false) {
    return false;
  } else {
    return true;
  }
}




function fntValidText() {
  let validText = document.querySelectorAll(".validText");
  validText.forEach(function (validText) {
    validText.addEventListener("keyup", function () {
      let inputValue = this.value;
      if (!testText(inputValue)) {
        this.classList.add("is-invalid");
        /*  this.classList.remove('is-valid'); */
      } else {
        this.classList.remove("is-invalid");
        /*       this.classList.add('is-valid'); */
      }
    });
  });
}


function fntValidNumberDni() {
  let validNumberDni = document.querySelectorAll(".validNumberDni");
  validNumberDni.forEach(function (validNumberDni) {
    validNumberDni.addEventListener("keyup", function () {
      let inputValue = this.value;
      if (!testEnteroDni(inputValue)) {
        this.classList.add("is-invalid");
      } else {
        this.classList.remove("is-invalid");
      }
    });
  });
}

function fntValidEmail() {
  let validEmail = document.querySelectorAll(".validEmail");
  validEmail.forEach(function (validEmail) {
    validEmail.addEventListener("keyup", function () {
      let inputValue = this.value;
      if (!fntEmailValidate(inputValue)) {
        this.classList.add("is-invalid");
      } else {
        this.classList.remove("is-invalid");
        this.classList.add("is-valid");
      }
    });
  });
}

function testContraseña(txtString) {
  var stringText = new RegExp(
    /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)([A-Za-z\d]|[^ ]){8,15}$/
  );
  if (stringText.test(txtString)) {
    return true;
  } else {
    return false;
  }
}


function fntValidContra() {
  let ValidContra = document.querySelectorAll(".ValidContra");
  ValidContra.forEach(function (ValidContra) {
    ValidContra.addEventListener("keyup", function () {
      let inputValue = this.value;
      if (!testContraseña(inputValue)) {
        this.classList.add("is-invalid");
        /*  this.classList.remove('is-valid'); */
      } else {
        this.classList.remove("is-invalid");
        /*       this.classList.add('is-valid'); */
      }
    });
  });
}


function CargarUsuarios(){
    
    $.ajax({
        url : UrlUsuarios,
        type: 'GET',
        datatype: 'JSON',
        success: function(reponse){
            var MisItems = reponse;
            // Si la tabla ya ha sido inicializada previamente, destruye la instancia
            if ($.fn.DataTable.isDataTable("#TablaUsuarios")) {
              $("#TablaUsuarios").DataTable().destroy();
            }
               $("#TablaUsuarios").DataTable({
                 processing: true,
                 data: MisItems,
                 language: {
                   url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
                 },
                 columns: [
                   { data: "Id_Usuario" },
                   { data: "Usuario" },
                   { data: "Nombre" },
                   { data: "DNI" },

                   { data: "Estado" },
                   { data: "Rol" },
                   { data: "Correo_Electronico" },
                   { data: "options" },

                   /*  {
                     data: null,
                     render: function (data, type, row) {
                       return (
                         '<?php echo `hola`;?><button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="verUsuario(\'' +
                         row.Id_Usuario +
                         "'); \">Ver +</button>" +
                         '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarUsuario(\'' +
                         row.Id_Usuario +
                         "'); mostrarFormulario();\">Editar</button>" +
                         '<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarUsuario(\'' +
                         row.Id_Usuario +
                         "')\">Eliminar</button>"
                       );
                     },
                   }, */
                 ],
               });
           }
       });
   }



function verUsuario(Id_Usuario) {
  //Función que trae los campos que se eligieron editar.
  var datosUsuario = {
    idUsuario: Id_Usuario,
  };
  var datosUsuarioJson = JSON.stringify(datosUsuario);

  $.ajax({
    url: UrlUsuarioseditar,
    type: "POST",
    data: datosUsuarioJson,
    datatype: "JSON",
    contentType: "application/json",
    success: function (reponse) {
      var MisItems = reponse;

      console.log(MisItems);

      document.querySelector("#exampleModalLabel").innerHTML = "Usuario "+ MisItems.Usuario;
      document.querySelector("#celUsuario").innerHTML=MisItems.Usuario;
      document.querySelector("#celNombre").innerHTML = MisItems.Nombre;
      document.querySelector("#celCorreo").innerHTML = MisItems.Correo_Electronico;
      document.querySelector("#celEstado").innerHTML = MisItems.Estado;
      document.querySelector("#celDNI").innerHTML = MisItems.DNI;
      document.querySelector("#celRol").innerHTML = MisItems.Rol;
      document.querySelector("#celCargo").innerHTML = MisItems.Nombre_cargo;
      document.querySelector("#celFCreacion").innerHTML =
        MisItems.Fecha_creacion;
      document.querySelector("#celCreado").innerHTML = MisItems.Creado_por;
      document.querySelector("#celFModificación").innerHTML =
        MisItems.Fecha_modificacion;
      document.querySelector("#celModificado").innerHTML =
        MisItems.Modificado_por;
      document.querySelector("#celFVencimiento").innerHTML =
        MisItems.Fecha_vencimiento;
 document.querySelector("#celConexion").innerHTML =
   MisItems.Fecha_ultima_conexion;

       $("#modalUsuario").modal("show");
    },
  });
}
   

function AgregarUsuario() {




  usuario=document.querySelector("#usuario").value;
  nombre = document.querySelector("#nombre").value;
  DNI = document.querySelector("#DNI").value;
  correo = document.querySelector("#correo").value;
  contraseña = document.querySelector("#contraseña").value;
  confirmContraseña = document.querySelector("#confirmContraseña").value;
  rolSelect = document.querySelector("#rolSelect").value;
  rolCargo = document.querySelector("#cargoSelect").value;
  estadoSelect = document.querySelector("#selecEstado").value;

  fechaVencimiento = document.querySelector("#fechaVencimiento").value;

 if (
   usuario == "" ||
   nombre == "" ||
   DNI == "" ||
   correo == "" ||
   rolSelect == "" ||
   fechaVencimiento == ""
 ) {
   Swal.fire("Error", "Debe de llenar todos los campos", "error");
   return false;
 }

 let contraseñaValid = document.querySelector("#contraseña");
 let DNIvalid = document.querySelector("#DNI");
 let correoValid = document.querySelector("#correo");
 let nombreValid = document.querySelector("#nombre");
 

 if (correoValid.classList.contains("is-invalid")) {
   swal.fire(
     "Atención",
     "Ingrese un correo Correcto, Ejemplo: example@example.com",
     "error"
   );
   return false;
 }
  if (nombreValid.classList.contains("is-invalid")) {
    swal.fire(
      "Atención",
      "El nombre debe de ser Alfabetico, sin más de dos espacios ni números o caracteres especiales",
      "error"
    );
    return false;
  }

 if (contraseñaValid.classList.contains("is-invalid")) {
   swal.fire(
     "Atención",
     "La contraseña debe de contener al menos 8 carácteres, una letra mayúscula, una letra minúscula, un número y sin espacios",
     "error"
   );
   return false;
 }

 if (DNIvalid.classList.contains("is-invalid")) {
   swal.fire("Atención", "DNI solo debe ser númerico", "error");
   return false;
 }

if (contraseña!="" && contraseña.length<8) {
  Swal.fire("Error", "La contraseña debe de ser mayor a 8 caracteres", "error");
  return false;
}


  if (contraseña != confirmContraseña) {

    Swal.fire("Error","No coinciden las contraseñas","error");
    return false;
  }
 
 let elementsValid = document.getElementsByClassName("valid");
 for (let i = 0; i < elementsValid.length; i++) {
   if (elementsValid[i].classList.contains("is-invalid")) {
     swal.fire("Atención", "Por favor verifique los campos en rojo.", "error");
     return false;
   }
 }

  var datosUsuario = {
    usuario: usuario,
    nombre: nombre,
    DNI: DNI,
    contraseña: contraseña,
    confirmContraseña: confirmContraseña,
    rolSelect: rolSelect,
    correo: correo,
    fechaVencimiento: fechaVencimiento,
    rolCargo: rolCargo,
    estadoSelect: estadoSelect,
  };
  var datosUsuarioJson = JSON.stringify(datosUsuario);

  $.ajax({
    url: UrlInsertarUsuario,
    type: "POST",
    data: datosUsuarioJson,
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
      alert("Error al agregar rol" + textStatus + errorThrown);
    },
  });


  
}

function CargarRoles(){
    $.ajax({
        url : UrlGetRoles,
        type: 'GET',
        datatype: 'JSON',
        success: function(response){
            var MisItems = response;
            var opciones='';
            console.log(MisItems)
            for(i=0; i<MisItems.length; i++){ //Muestra Id y nombre
                opciones += '<option value="' + MisItems[i].Id_Rol + '">' + ' ID ' + MisItems[i].Id_Rol + ' - ' + MisItems[i].Rol + '</option>';
            }
            $("#rolSelect").html(opciones);
        }
    });
}

function CargarCargos(){
    $.ajax({
        url : UrlGetCargos,
        type: 'GET',
        datatype: 'JSON',
        success: function(response){
            var MisItems = response;
            var opciones='';
            console.log(MisItems)
            for(i=0; i<MisItems.length; i++){ //Muestra Id y nombre
                opciones += '<option value="' + MisItems[i].Id_Cargo  + '">' + ' ID ' + MisItems[i].Id_Cargo  + ' - ' + MisItems[i].Nombre_cargo + '</option>';
            }
            $("#cargoSelect").html(opciones);
        }
    });
}




function CargarUsuario(idUsuario) {
  //Función que trae los campos que se eligieron editar.
  var datosUsuario = {
    idUsuario: idUsuario,
  };
  var datosUsuarioJson = JSON.stringify(datosUsuario);

  $.ajax({
    url: UrlUsuarioseditar,
    type: "POST",
    data: datosUsuarioJson,
    datatype: "JSON",
    contentType: "application/json",
    success: function (reponse) {
      var MisItems = reponse;

      console.log(MisItems.Nombre);
      $("#Id_Usuario").val(MisItems.Id_Usuario);

      $("#usuario").val(MisItems.Usuario);
      $("#nombre").val(MisItems.Nombre);
      $("#DNI").val(MisItems.DNI);
      $("#correo").val(MisItems.Correo_Electronico);
      $("#rolSelect").val(MisItems.Id_Rol);
      $("#cargoSelect").val(MisItems.Id_Cargo);
      $("#selecEstado").val(MisItems.Estado);

      $("#fechaVencimiento").val(MisItems.Fecha_vencimiento);


      //Usar el mismo botón de agregar con la funcionalidad de actualizar.
      var btnactualizar =
        '<a id="btn_actualizar" onclick="ActualizarUsuario(' +
        MisItems.Id_Usuario +
        ')"' +
        'value="" class="btn btn-primary mr-3">Actualizar Usuario </a> <button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button></input>';
      $("#btnAgregarUsuario").html(btnactualizar);
      $("#btncancelar").click(function () {
        //Cancela la acción
        location.href = "http://localhost/SIIS-PROYECTO/Formularios/GestionUsuario.php";
      });
      //Cambiar el título del formulario.
      var titulo =
        '<div class="Col-12" id="titulo">' + "<h3>Editar Usuario</h3></div>";
      $("#titulo").html(titulo);
    },
  });
}

function ActualizarUsuario(idUsuario) {
  usuario = document.querySelector("#usuario").value;
  nombre = document.querySelector("#nombre").value;
  DNI = document.querySelector("#DNI").value;
  correo = document.querySelector("#correo").value;
  contraseña = document.querySelector("#contraseña").value;
  confirmContraseña = document.querySelector("#confirmContraseña").value;
  rolSelect = document.querySelector("#rolSelect").value;
  rolCargo = document.querySelector("#cargoSelect").value;
  estadoSelect = document.querySelector("#selecEstado").value;

  fechaVencimiento = document.querySelector("#fechaVencimiento").value;

  if (
  
    usuario == "" ||
    nombre == "" ||
    DNI == "" ||
    correo == "" ||
    rolSelect == "" ||
    fechaVencimiento == ""
  ) {
    Swal.fire("Error", "Debe de llenar todos los campos", "error");
    return false;
  }

  
 

  let elementsValid = document.getElementsByClassName("valid");
  for (let i = 0; i < elementsValid.length; i++) {
    if (elementsValid[i].classList.contains("is-invalid")) {
      swal.fire("Atención", "Por favor verifique los campos en rojo.", "error");
      return false;
    }
  }

  var datosUsuario = {
    idUsuario: idUsuario,
    usuario: usuario,
    nombre: nombre,
    DNI: DNI,
    contraseña: contraseña,
    confirmContraseña: confirmContraseña,
    rolSelect: rolSelect,
    correo: correo,
    fechaVencimiento: fechaVencimiento,
    rolCargo: rolCargo,
    estadoSelect: estadoSelect,
  };
  var datosUsuarioJson = JSON.stringify(datosUsuario);
  $.ajax({
    url: UrlActualizarUsuario,
    type: "PUT",
    data: datosUsuarioJson,
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
      alert("Error al actualizar rol" + textStatus + errorThrown);
    },
  });

}

function EliminarUsuario(idUsuario){
    

   Swal.fire({
     title: "Eliminar Usuario?",
     text: "Estas Seguro que quieres Eliminar el Usuario, esta acción es irreversible",
     icon: "warning",
     showCancelButton: true,
     confirmButtonColor: "#3085d6",
     cancelButtonColor: "#d33",
     confirmButtonText: "Si, Eliminar!",
   }).then((result) => {
     if (result.isConfirmed) {
       var datosUsuario = {
         idUsuario: idUsuario,
       };
       var datosUsuario = JSON.stringify(datosUsuario);
       $.ajax({
         url: UrlEilinarUsuario,
         type: "POST",
         data: datosUsuario,
         datatype: "JSON",
         success: function (response) {
           //Swal.fire("Cancelada!", "Compra Cancelada Correctamente.", "success");
           Swal.fire({
             title: "Cancelada",
             text: "Usuario Eliminado Correctamente",
             icon: "success",
             timer: 3000,
             willClose: () => {
               location.reload();
             },
           });
         },
       });
     }
   });
}
