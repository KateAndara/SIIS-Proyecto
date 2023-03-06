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
    alert("El campo 'Usuario' solo debe contener letras"); 
  }
  
  if (campo.value.length > maxCaracteres) { 
    campo.value = campo.value.slice(0, maxCaracteres); 
    alert("El campo 'Usuario' no puede contener más de " + maxCaracteres + " caracteres"); 
  }
}

function validarCampoContrasenia() {
  const campo = document.getElementById("password");
  const maxCaracteres = 15; 
  
  if (campo.value.length > maxCaracteres) { 
    campo.value = campo.value.slice(0, maxCaracteres); 
    alert("El campo 'Contraseña' no puede contener más de " + maxCaracteres + " caracteres"); 
  }
}