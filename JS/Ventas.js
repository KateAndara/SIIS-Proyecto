
//Si se necesita traer datos de otra tabla para una lista desplegable
var UrlProductos = 'http://localhost/SIIS-PROYECTO/controller/Ventas.php?opc=GetProductos'; 
var UrlPromociones = 'http://localhost/SIIS-PROYECTO/controller/Ventas.php?opc=GetPromociones';
var UrlDescuentos =  'http://localhost/SIIS-PROYECTO/controller/Ventas.php?opc=GetDescuentos';
var UrlEstados =  'http://localhost/SIIS-PROYECTO/controller/Ventas.php?opc=GetEstados';
var UrlVentas =  'http://localhost/SIIS-PROYECTO/controller/Ventas.php?opc=GetVentas';
var urlDetalleVenta =
  "http://localhost/SIIS-PROYECTO/controller/Ventas.php?opc=AgregarDetalle";
  var urlEliminarProducto =
     "http://localhost/SIIS-PROYECTO/controller/Ventas.php?opc=deleteProducto";

     var urlEditProducto =
       "http://localhost/SIIS-PROYECTO/controller/Ventas.php?opc=editProducto";
       var urlFinalizarVenta =
         "http://localhost/SIIS-PROYECTO/controller/Ventas.php?opc=finalVenta";

$(document).ready(function(){
   CargarProductos();
   CargarPromociones();
   CargarDescuentos();
   CargarEstados();
   CargarVentas();
   
});


function CargarVentas(){
    
  $.ajax({
      url : UrlVentas,
      type: 'GET',
      datatype: 'JSON',
      success: function(reponse){
          var MisItems = reponse;
          // Si la tabla ya ha sido inicializada previamente, destruye la instancia
          if ($.fn.DataTable.isDataTable('#TableVentas')) {
           $('#TableVentas').DataTable().destroy();
          }
          $("#TableVentas").DataTable({
            processing: true,
            data: MisItems,
            language: {
              url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
            },
            columns: [
              { data: "Id_Venta" },
              { data: "Nombre" },
              { data: "Usuario" },
              { data: "Nombre_estado" },
              { data: "Subtotal" },
              { data: "Impuesto" },
              { data: "Total" },
              { data: "Fecha" },
              { data: "RTN" },
              { data: "Numero_factura" },
              { data: "options" },

            /*   {
                data: null,
                render: function (data, type, row) {
                  return (
                    '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarVenta(\'' +
                    row.Id_Venta +
                    "'); mostrarFormulario();\">Editar</button>" +
                    '<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarVenta(\'' +
                    row.Id_Venta +
                    "')\">Eliminar</button>"
                  );
                },
              }, */
            ],
          });
      }
  });
}


//Función para traer los datos de otra tabla para poder ser seleccionados en una lista desplegable
function CargarProductos(){
   
  $.ajax({
        url : UrlProductos,
        type: 'GET',
        datatype: 'JSON',
        success: function(response){
            var MisItems = response;
            var opciones='';
            
            
            
            for(i=0; i<MisItems.length; i++){ //Muestra Id y nombre
                opciones += '<option value="' + MisItems[i].Nombre + '">' +  MisItems[i].Nombre + '</option>';
                
                
              }

            $('#Select_Producto').html(opciones);
            
            
        }
    });
}


function CargarPromociones(){
  $.ajax({
      url : UrlPromociones,
      type: 'GET',
      datatype: 'JSON',
      success: function(response){
          var MisItems = response;
          var opciones='';
          
          for(i=0; i<MisItems.length; i++){ //Muestra Id y nombre
              opciones += '<option value="' + MisItems[i].Id_Promocion + '">' +  MisItems[i].Nombre_Promocion + '</option>';
          }
          $('#Select_Promocion').html(opciones);
          
      }
  });
}

function CargarDescuentos(){
  $.ajax({
      url : UrlDescuentos,
      type: 'GET',
      datatype: 'JSON',
      success: function(response){
          var MisItems = response;
          var opciones='';
          
          for(i=0; i<MisItems.length; i++){ //Muestra Id y nombre
              opciones += '<option value="' + MisItems[i].Id_Descuento + '">' +  MisItems[i].Nombre_descuento + '</option>';
          }
          $('#Select_Descuento').html(opciones);
          
      }
  });
}

function CargarEstados(){
  $.ajax({
      url : UrlEstados,
      type: 'GET',
      datatype: 'JSON',
      success: function(response){
          var MisItems = response;
          var opciones='';
          
          for(i=0; i<MisItems.length; i++){ //Muestra Id y nombre
              opciones += '<option value="' + MisItems[i].Id_Estado_Venta + '">' +  MisItems[i].Nombre_estado + '</option>';
          }
          $('#Select_Estado').html(opciones);
          
      }
  });
}

function calcularTotal() {
  subtotal = document.querySelector("#Subtotal").value;
  impuesto = document.querySelector("#Impuesto").value;
  total = (subtotal * impuesto ) + subtotal;

  console.log(subtotal);
  console.log(impuesto);

  console.log(total);

  document.querySelector("#Total").value = total;
}

function AgregarDetalleVenta(){
  Producto= $("#Select_Producto").val();
  Cantidad= $("#Cantidad").val();
  Precio= $("#Precio").val();
 

if (
Producto == "" ||
Cantidad == "" ||
Precio == "" 
) {
swal.fire("Atención", "Todos los campos son obligatorios.", "error");
return false;
}



var DatosProducto = {
  Producto: $("#Select_Producto").val(),
  Cantidad: $("#Cantidad").val(),
  Precio: $("#Precio").val(),
};
var DatosProducto = JSON.stringify(DatosProducto);


$.ajax({
 url: urlDetalleVenta,
 type: "POST",
 data: DatosProducto,
 datatype: "JSON",
 success: function (response) {
  var MisItems = response;


    document.querySelector("#tablaVenta").innerHTML = MisItems.htmlVentas;
    document.querySelector("#InsertDetalleVenta").reset();
   Swal.fire({
     toast: true,
   
     customClass: {
       popup: "colored-toast",
     },
     position: "top-right",
     icon: "success",
     title: MisItems.msg,
     showConfirmButton: false,
     timer: 1500,
     timerProgressBar: true,
   });
 },
});
}




function siguiente1() {

    nombre = document.querySelector("#Nombre").value;
    fechanacimiento = document.querySelector("#FechaNacimiento").value;
    dni = document.querySelector("#Dni").value;
    
  
     if (
       nombre == "" ||
       fechanacimiento == "" ||
       dni == ""
     ) {
       swal.fire("Atención", "Todos los campos son obligatorios.", "error");
       return false;
     }
  
    document.querySelector("#pestaña1").classList.remove("active");
    document.querySelector("#pestaña1").classList.remove("show");
    document.querySelector("#nav1").classList.remove("active");
    document.querySelector("#nav1").classList.remove("show");
  
    document.querySelector("#pestaña2").classList.add("active");
    document.querySelector("#pestaña2").classList.add("show");
    document.querySelector("#nav2").classList.add("active");
    document.querySelector("#nav2").classList.add("show");
    
  }

  function siguiente2() {

    producto = document.querySelector("#Select_Producto").value;
    cantidad = document.querySelector("#Cantidad").value;
    precio = document.querySelector("#Precio").value;
    
  
     if (
       producto == "" ||
       cantidad == "" ||
       precio == ""
     ) {
       swal.fire("Atención", "Todos los campos son obligatorios.", "error");
       return false;
     }
  
    document.querySelector("#pestaña2").classList.remove("active");
    document.querySelector("#pestaña2").classList.remove("show");
    document.querySelector("#nav2").classList.remove("active");
    document.querySelector("#nav2").classList.remove("show");
  
    document.querySelector("#pestaña3").classList.add("active");
    document.querySelector("#pestaña3").classList.add("show");
    document.querySelector("#nav3").classList.add("active");
    document.querySelector("#nav3").classList.add("show");
    
  }

  function siguiente3() {

    promocion = document.querySelector("#Select_Promocion").value;
    precio = document.querySelector("#PrecioV").value;
    
  
     if (
       promocion == "" ||
       precio == ""
     ) {
       swal.fire("Atención", "Todos los campos son obligatorios.", "error");
       return false;
     }
  
          
    document.querySelector("#pestaña3").classList.remove("active");
    document.querySelector("#pestaña3").classList.remove("show");
    document.querySelector("#nav3").classList.remove("active");
    document.querySelector("#nav3").classList.remove("show");
  
    document.querySelector("#pestaña4").classList.add("active");
    document.querySelector("#pestaña4").classList.add("show");
    document.querySelector("#nav4").classList.add("active");
    document.querySelector("#nav4").classList.add("show");
    
  }
   
  function siguiente4() {

          
    document.querySelector("#pestaña4").classList.remove("active");
    document.querySelector("#pestaña4").classList.remove("show");
    document.querySelector("#nav4").classList.remove("active");
    document.querySelector("#nav4").classList.remove("show");
  
    document.querySelector("#pestaña5").classList.add("active");
    document.querySelector("#pestaña5").classList.add("show");
    document.querySelector("#nav5").classList.add("active");
    document.querySelector("#nav5").classList.add("show");
    
  }


  function atras1() {

    document.querySelector("#pestaña2").classList.remove("active");
    document.querySelector("#pestaña2").classList.remove("show");
    document.querySelector("#nav2").classList.remove("active");
    document.querySelector("#nav2").classList.remove("show");
    
    document.querySelector("#pestaña1").classList.add("active");
    document.querySelector("#pestaña1").classList.add("show");
    document.querySelector("#nav1").classList.add("active");
    document.querySelector("#nav1").classList.add("show");
  
    
  }

  function atras2() {

    document.querySelector("#pestaña3").classList.remove("active");
    document.querySelector("#pestaña3").classList.remove("show");
    document.querySelector("#nav3").classList.remove("active");
    document.querySelector("#nav3").classList.remove("show");
    
  
    document.querySelector("#pestaña2").classList.add("active");
    document.querySelector("#pestaña2").classList.add("show");
    document.querySelector("#nav2").classList.add("active");
    document.querySelector("#nav2").classList.add("show");
  
    
  }

  function atras3() {

    document.querySelector("#pestaña4").classList.remove("active");
    document.querySelector("#pestaña4").classList.remove("show");
    document.querySelector("#nav4").classList.remove("active");
    document.querySelector("#nav4").classList.remove("show");
    
  
    document.querySelector("#pestaña3").classList.add("active");
    document.querySelector("#pestaña3").classList.add("show");
    document.querySelector("#nav3").classList.add("active");
    document.querySelector("#nav3").classList.add("show");
  
    
  }

  function atras4() {

    document.querySelector("#pestaña5").classList.remove("active");
    document.querySelector("#pestaña5").classList.remove("show");
    document.querySelector("#nav5").classList.remove("active");
    document.querySelector("#nav5").classList.remove("show");
    
  
    document.querySelector("#pestaña4").classList.add("active");
    document.querySelector("#pestaña4").classList.add("show");
    document.querySelector("#nav4").classList.add("active");
    document.querySelector("#nav4").classList.add("show");
  
    
  }

  function Cancelar(){

    location.href = "http://localhost/SIIS-PROYECTO/Formularios/Ventas.php";
  
  }

  function NuevaVenta(){

     location.href = "http://localhost/SIIS-PROYECTO/Formularios/Nueva_Venta.php";

  }