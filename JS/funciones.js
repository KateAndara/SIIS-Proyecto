function mostrarPassword(id){
var cambio = document.getElementById(id);
    if(cambio.type == "password"){
    cambio.type = "text";
    $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
    }else{
    cambio.type = "password";
    $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
    }
} 

function validarCampoUsuario() {
  const campo = document.getElementById("usuario");
  const regex = /^[a-zA-Z]+$/; 
  const maxCaracteres = 45; 
  
  if (campo.value && !regex.test(campo.value)) { 
    campo.value = campo.value.replace(/[^a-zA-Z]/g, ''); 
     // Mostrar el mensaje
     var mensajeElemento = document.getElementById("mensaje");
     mensajeElemento.style.display = "block";
 
     // Ocultar el mensaje después de 3 segundos (3000 ms)
     setTimeout(function() {
         mensajeElemento.style.display = "none";
     }, 3000);
 
     return false;
  }
  
  if (campo.value.length > maxCaracteres) { 
    campo.value = campo.value.slice(0, maxCaracteres); 
    // Mostrar el mensaje
    var mensajeElemento = document.getElementById("mensaje3");
    mensajeElemento.style.display = "block";

    // Ocultar el mensaje después de 4 segundos (4000 ms)
    setTimeout(function() {
        mensajeElemento.style.display = "none";
    }, 4000);

    return false;
  }
}

function validarCampoContrasenia() {
  const campo = document.getElementById("password");
  const maxCaracteres = 15; 
  
  if (campo.value.length > maxCaracteres) { 
    campo.value = campo.value.slice(0, maxCaracteres); 
    // Mostrar el mensaje
    var mensajeElemento = document.getElementById("mensaje2");
    mensajeElemento.style.display = "block";

    // Ocultar el mensaje después de 2 segundos (2000 ms)
    setTimeout(function() {
        mensajeElemento.style.display = "none";
    }, 3000);

    return false;
  }
}