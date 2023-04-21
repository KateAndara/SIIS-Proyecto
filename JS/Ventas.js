
//Si se necesita traer datos de otra tabla para una lista desplegable
var UrlProductos = 'http://localhost/SIIS-PROYECTO/controller/Ventas.php?opc=GetProductos'; 
var UrlProducto = 'http://localhost/SIIS-PROYECTO/controller/Ventas.php?opc=GetProducto';
var urlClientes = 'http://localhost/SIIS-PROYECTO/controller/Ventas.php?opc=getClientes'; 
var urlCliente = 'http://localhost/SIIS-PROYECTO/controller/Ventas.php?opc=getCliente'; 
var UrlPromociones = 'http://localhost/SIIS-PROYECTO/controller/Ventas.php?opc=GetPromociones';
var urlPrecioPromocion = 'http://localhost/SIIS-PROYECTO/controller/Ventas.php?opc=getPrecioPromocion';
var UrlDescuentos =  'http://localhost/SIIS-PROYECTO/controller/Ventas.php?opc=GetDescuentos';
var UrlDescuento =  'http://localhost/SIIS-PROYECTO/controller/Ventas.php?opc=GetDescuento';
var UrlEstados =  'http://localhost/SIIS-PROYECTO/controller/Ventas.php?opc=GetEstados';
var UrlVentas =  'http://localhost/SIIS-PROYECTO/controller/Ventas.php?opc=GetVentas';
var urlDetalleVenta ="http://localhost/SIIS-PROYECTO/controller/Ventas.php?opc=AgregarDetalle";
var urlGetVenta ="http://localhost/SIIS-PROYECTO/controller/Ventas.php?opc=getVentaListar";
  
  
  var urlEliminarProducto =
     "http://localhost/SIIS-PROYECTO/controller/Ventas.php?opc=deleteProducto";

     var urlEditProducto =
       "http://localhost/SIIS-PROYECTO/controller/Ventas.php?opc=editProducto";
       var urlFinalizarVenta ="http://localhost/SIIS-PROYECTO/controller/Ventas.php?opc=finalVenta";
var urlCAI ="http://localhost/SIIS-PROYECTO/controller/Ventas.php?opc=agregarCAI";


$(document).ready(function(){
   CargarProductos();
   CargarPromociones();
   CargarDescuentos();
   CargarEstados();
   CargarVentas();
   cargarClientes();

if ($("#totalFila")) {
  document.querySelector("#totalDetalle").value = $("#totalFila").text();
  document.querySelector("#SubtotalDescuento").value = $("#totalFila").text();
  document.querySelector("#Subtotal").value = $("#totalFila").text();
}
 
   
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
            "order": [[0, "desc"]],
            language: {
              url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
            },
            columns: [
              { data: "Id_Venta" },
              { data: "Nombre" },
              /* { data: "Usuario" }, */
              { data: "Nombre_estado" },
              /* { data: "Subtotal" }, */
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
            var opciones =
              '<option value="">' + "Seleccione Un Producto" + "</option>";
            
            
            
            for(i=0; i<MisItems.length; i++){ //Muestra Id y nombre
                 opciones +='<option value="' +
                  MisItems[i].Id_Producto +
                  '">' +
                  MisItems[i].Id_Producto +
                  " - " +
                  MisItems[i].Nombre +
                  "</option>";
                
                
              }

            $('#Select_Producto').html(opciones);
               $("#Select_Producto").select2();
         
            
        }
    });
}

//Función para traer los datos de otra tabla para poder ser seleccionados en una lista desplegable
function cargarClientes(){
   
  $.ajax({
    url: urlClientes,
    type: "GET",
    datatype: "JSON",
    success: function (response) {
      var MisItems = response;
      var opciones =
        '<option value="">' + "Seleccione Un Cliente" + "</option>";
        

      for (i = 0; i < MisItems.length; i++) {
        opciones +=
          '<option value="' +
          MisItems[i].Id_Cliente +
          '">' +
          MisItems[i].DNI +
          " - " +
          MisItems[i].Nombre +
          "</option>";
      }

      $("#Select_Cliente").html(opciones);
      $("#Select_Cliente").select2({
        language: {
          noResults: function () {
            return "Sin Resultados <a href='http://localhost/SIIS-PROYECTO/Formularios/Clientes.php' class='btn btn-success'>Crear Cliente</a>";
          },
        },
        escapeMarkup: function (markup) {
          return markup;
        },
      });
    },
  });
}

function changeCliente() {
  idCliente = document.querySelector("#Select_Cliente").value;

  if (idCliente!=0) {
     var datosCliente = {
       idCliente: idCliente,
     };
     var datosCliente = JSON.stringify(datosCliente);

     $.ajax({
       url: urlCliente,
       type: "POST",
       data: datosCliente,
       datatype: "JSON",
       success: function (response) {
         var MisItems = response;
         console.log(MisItems);
         document.querySelector("#FechaNacimiento").value =
           MisItems.Fecha_nacimiento;
         document.querySelector("#Dni").value = MisItems.DNI;
       },
     });
  }else{
    document.querySelector("#FechaNacimiento").value ="1111-11-11";
    document.querySelector("#Dni").value = "0001";
  }
 
}

function changePromocion(select,idProducto) {
  idProducto = idProducto;
  Select=select
  idPromocion=Select.options[Select.selectedIndex].value

  options = Select.options[Select.selectedIndex];
  Nombre=options.parentNode.parentNode.parentNode.firstChild.nextElementSibling
      .nextElementSibling.innerText

  Cantidad =
    options.parentNode.parentNode.parentNode.firstChild.nextElementSibling
      .nextElementSibling.nextElementSibling.innerText;

  
  
  //idPromocion = idPromo;

 
    var datosProducto = {
      idProducto: idProducto,
      Nombre:Nombre,
      Cantidad:Cantidad,
      idPromocion: idPromocion,
    };
    var datosProducto = JSON.stringify(datosProducto);

    $.ajax({
      url: urlPrecioPromocion,
      type: "POST",
      data: datosProducto,
      datatype: "JSON",
      success: function (response) {
        var MisItems = response;
        console.log(MisItems);
        
      Swal.fire({
        toast: true,

        customClass: {
          popup: "colored-toast",
        },
        position: "top-right",
        icon: "sucess",
        title: MisItems.msg,
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: true,
      });
    document.querySelector("#tablaVenta").innerHTML = MisItems.htmlVentas;
    document.querySelector("#detalle_totales").innerHTML = MisItems.htmlTotales;
    document.querySelector("#tablaVenta2").innerHTML = MisItems.htmlPromociones;
        document.querySelector("#detalle_totales2").innerHTML = MisItems.htmlTotalesPromociones;
        document.querySelector("#totalDetalle").value = $("#totalFila").text();
        document.querySelector("#SubtotalDescuento").value = $("#totalFila").text();
        document.querySelector("#Subtotal").value = $("#totalFila").text();
        changeDescuento();
    console.log(MisItems);
        //document.querySelector("#Precio").value = MisItems[0].Precio_Venta;
      },
    });
  
}

function changeProducto() {
    idProducto = document.querySelector("#Select_Producto").value;
    var datosProducto = {
      idProducto: idProducto,
    };
    var datosProducto = JSON.stringify(datosProducto);

    $.ajax({
      url: UrlProducto,
      type: "POST",
      data: datosProducto,
      datatype: "JSON",
      success: function (response) {
        var MisItems = response;
        console.log(MisItems);
        document.querySelector("#Precio").value = MisItems[0].Precio;
      },
    });


var datosProducto2 = {
  idProducto: idProducto,
};
var datosProducto2 = JSON.stringify(datosProducto2);
     $.ajax({
       url: UrlPromociones,
       type: "POST",
       data: datosProducto2,
       datatype: "JSON",
       success: function (response) {
         var MisItems = response;
         console.log(MisItems);
         var MisItems = response;
         var opciones =
           '<option value="0">' + "Seleccione Una Promoción" + "</option>";

         for (i = 0; i < MisItems.length; i++) {
           //Muestra Id y nombre
           opciones +=
             '<option value="' +
             MisItems[i].Id_Promocion +
             '">' +
             MisItems[i].Id_Promocion +
             " - " +
             MisItems[i].Nombre_Promocion +
             "</option>";
         }

         $("#select_Promocion").html(opciones);
         $("#select_Promocion").select2();
       },
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
          var opciones='<option value="#">' + "Seleccione Un Descuento" + "</option>";
          
          for(i=0; i<MisItems.length; i++){ //Muestra Id y nombre
              opciones += '<option value="' + MisItems[i].Id_Descuento + '">' +  MisItems[i].Nombre_descuento + '</option>';
          }
          $('#Select_Descuento').html(opciones);
          
      }
  });
}



function changeDescuento() {

   idDescuento = document.querySelector("#Select_Descuento").value;
   totalDetalle = document.querySelector("#totalDetalle").value;
   var datosDescuento = {
     idDescuento: idDescuento,
   };
   var datosDescuento = JSON.stringify(datosDescuento);

   $.ajax({
     url: UrlDescuento,
     type: "POST",
     data: datosDescuento,
     datatype: "JSON",
     success: function (response) {
       var MisItems = response;
       console.log(MisItems.impuesto.Valor);
       totalDescontado = totalDetalle * (MisItems.Porcentaje_a_descontar / 100);
       porcentaje=MisItems.Porcentaje_a_descontar
       porcentajeImpuesto = MisItems.impuesto.Valor;
      subtotal = Number(totalDetalle) - totalDescontado;
   
       document.querySelector("#Porcentaje").value = porcentaje +"%";
       document.querySelector("#Totaldescontado").value = totalDescontado;
       document.querySelector("#SubtotalDescuento").value =subtotal;
       document.querySelector("#Subtotal").value =subtotal;
       document.querySelector("#Impuesto").value = (subtotal*(porcentajeImpuesto/100)) ;
       document.querySelector("#labelImpuesto").innerHTML = "IMPUESTO "+ porcentajeImpuesto + "%";
       document.querySelector("#Total").value =  subtotal + (subtotal*(porcentajeImpuesto/100));


     },
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
  impuesto=Number(impuesto)/100;
  total = (Number(subtotal) * Number(impuesto) ) + Number(subtotal);

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

    console.log(MisItems)
    document.querySelector("#tablaVenta").innerHTML = MisItems.htmlVentas;
    document.querySelector("#detalle_totales").innerHTML = MisItems.htmlTotales;
    document.querySelector("#tablaVenta2").innerHTML = MisItems.htmlPromociones;
    document.querySelector("#detalle_totales2").innerHTML = MisItems.htmlTotalesPromociones;
    document.querySelector("#FormDetalle").reset();
    document.querySelector("#totalDetalle").value = $("#totalFila").text();
    document.querySelector("#SubtotalDescuento").value = $("#totalFila").text();
    document.querySelector("#Subtotal").value = $("#totalFila").text();
    

changeDescuento();
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
function del_product_detalle(idProducto) {
  var DatosProducto = {
    Producto: idProducto,
  };
  var DatosProducto = JSON.stringify(DatosProducto);

  $.ajax({
    url: urlEliminarProducto,
    type: "POST",
    data: DatosProducto,
    datatype: "JSON",
    success: function (response) {
      var MisItems = response;

      document.querySelector("#tablaVenta").innerHTML = MisItems.htmlVentas;
    document.querySelector("#detalle_totales").innerHTML = MisItems.htmlTotales;
    document.querySelector("#tablaVenta2").innerHTML = MisItems.htmlPromociones;
    document.querySelector("#detalle_totales2").innerHTML = MisItems.htmlTotalesPromociones;
       document.querySelector("#totalDetalle").value = $("#totalFila").text();
       document.querySelector("#SubtotalDescuento").value =
         $("#totalFila").text();
       document.querySelector("#Subtotal").value = $("#totalFila").text();
    changeDescuento();
    
      Swal.fire({
        toast: true,

        customClass: {
          popup: "colored-toast",
        },
        position: "top-right",
        icon: "warning",
        title: MisItems.msg,
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: true,
      });
    },
  });
}



function generarFactura() {
   $.ajax({
     url: urlCAI,
     type: "GET",
     datatype: "JSON",
     success: function (response) {
       var MisItems = response;
       console.log(MisItems);
       rangoActual = MisItems.Rango_actual;
       rangoActual=Number(rangoActual)+1
      document.querySelector("#Numero_factura").value = MisItems.Numero_CAI+ "-"+rangoActual;
      document.querySelector("#idTalonario").value = MisItems.Id_Talonario;
      document.querySelector("#valorActualTalonario").value = MisItems.Rango_actual;
       
     },
   });
}



function siguiente1() {

    nombre = document.querySelector("#Select_Cliente").value;
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

  function agregarVenta() {
    idCliente = document.querySelector("#Select_Cliente").value;
    idDescuento = document.querySelector("#Select_Descuento").value;
    Porcentaje = document.querySelector("#Porcentaje").value;
    totalDetalle = document.querySelector("#totalDetalle").value;
    Totaldescontado = document.querySelector("#Totaldescontado").value;
    SubtotalDescuento = document.querySelector("#SubtotalDescuento").value;
    idEstado = document.querySelector("#Select_Estado").value;
    Subtotal = document.querySelector("#Subtotal").value;
    Impuesto = document.querySelector("#Impuesto").value;
    RTN = document.querySelector("#RTN").value;
    Total = document.querySelector("#Total").value;
    Numero_factura = document.querySelector("#Numero_factura").value;
    idTalonario = document.querySelector("#idTalonario").value;
    valorActual = document.querySelector("#valorActualTalonario").value;
    

    var datosVenta = {
      idCliente: idCliente,
      idDescuento: idDescuento,
      Porcentaje: Porcentaje,
      totalDetalle: totalDetalle,
      Totaldescontado: Totaldescontado,
      SubtotalDescuento: SubtotalDescuento,
      idEstado: idEstado,
      Subtotal: Subtotal,
      Impuesto: Impuesto,
      RTN: RTN,
      Total: Total,
      Numero_factura: Numero_factura,
      idTalonario: idTalonario,
      valorActual: valorActual,
    };
    var datosVenta = JSON.stringify(datosVenta);

    $.ajax({
      url: urlFinalizarVenta,
      type: "POST",
      data: datosVenta,
      datatype: "JSON",
      success: function (response) {
        var MisItems = response;
        idVenta = MisItems.idVenta;
        //document.querySelector("#tablaCompra").innerHTML = MisItems.htmlCompras;
        swal.fire({
          title: "LISTO!",
          text: MisItems.msg,
          icon: "success",
          confirmButtonText: "Aceptar",
          closeOnConfirm: false,
          timer: 3000,
          willClose: () => {
            swal.fire({
                title: "Ficha de Venta",
                text: "Desea imprimir la ficha de la Venta?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Si, imprimir!",
                cancelButtonText: "No, Cancelar!",
                closeOnConfirm: false,
                closeOnCancel: true,
              }).then((result)=>{
                if(result.isConfirmed){
                generarPDF(idVenta);
                }else {
                  window.location.href = "../Formularios/Ventas.php";
                }
              })
          },
        });
      },
    });
    
  }

  function verVenta(idVenta) {
    location.href="http://localhost/SIIS-PROYECTO/Formularios/verVenta.php?id=" +
      idVenta;
  }
  function generarPDF(idVenta) {
    // Crear la URL del PDF
    var urlPDF =
      "http://localhost/SIIS-PROYECTO/Reportes/reporteVenta.php?id=" +
      idVenta;

    // Abrir el PDF en una nueva ventana del navegador
    window.open(urlPDF, "_blank");

    // Redirigir al usuario después de cerrar el PDF
    window.location.href = "../Formularios/Ventas.php";
  }

  function listarVenta(idVenta) {
    var DatosProducto = {
      idVenta: idVenta,
    };
    var DatosProducto = JSON.stringify(DatosProducto);

    $.ajax({
      url: urlGetVenta,
      type: "POST",
      data: DatosProducto,
      datatype: "JSON",
      success: function (response) {
        console.log(response);
        var opciones = "";
        var venta = response["datos"]["Venta"];
        var descuento = response["datos"]["descuento"];
        var detalles = response["datos"]["detalle"];
            document.querySelector("#titulo").innerHTML =
              "Venta #" + venta["Id_Venta"];
        document.querySelector("#txtFactura").value = venta["Numero_factura"];
        document.querySelector("#txtEstado").value = venta["Nombre_estado"];
        document.querySelector("#txtCliente").value = venta["Nombre"];
        document.querySelector("#Fecha_Compra").value = venta["Fecha"];
        document.querySelector("#descuento").value = descuento["Nombre_descuento"];
        document.querySelector("#porcDescontado").value = descuento["Porcentaje_a_descontar"];
        document.querySelector("#impuestoLabel").innerHTML =
          "Descuento " + descuento["Nombre_descuento"];

       

subtotal = 0;
        console.log(response);
        for (i = 0; i < detalles.length; i++) {
          
          opciones += `<tr>
              <td>${detalles[i]["Id_Producto"]}</td>
              <td>${detalles[i]["Nombre"]}</td>
              <td>${detalles[i]["Cantidad"]}</td>
              <td>${detalles[i]["Precio"]}</td>
              <td>${detalles[i]["Cantidad"] * detalles[i]["Precio"]}</td>
              
            </tr>`;

              $("#tablaVenta").html(opciones);
          subtotal = subtotal + detalles[i]["Cantidad"] * detalles[i]["Precio"];
        }
          document.querySelector("#txtSubtotal").value = subtotal;
          document.querySelector("#txtDescuento").value = descuento["Total_descuento"];
          document.querySelector("#txtImpuesto").value = venta["Impuesto"];
          document.querySelector("#txtTotal").value = venta["Total"];

        /*  document.querySelector("#tablaVenta").innerHTML = MisItems.htmlVentas;
      document.querySelector("#detalle_totales").innerHTML =
        MisItems.htmlTotales;
      document.querySelector("#tablaVenta2").innerHTML =
        MisItems.htmlPromociones;
      document.querySelector("#detalle_totales2").innerHTML =
        MisItems.htmlTotalesPromociones;
      document.querySelector("#totalDetalle").value = $("#totalFila").text();
      document.querySelector("#SubtotalDescuento").value =
        $("#totalFila").text();
      document.querySelector("#Subtotal").value = $("#totalFila").text();
      changeDescuento(); */
      },
    });
  }