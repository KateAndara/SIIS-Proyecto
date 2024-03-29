
var urlProveedores =
  "http://localhost/SIIS-PROYECTO/controller/ProcesoCompra.php?opc=GetProveedores";


var urlDetalleCompra =
  "http://localhost/SIIS-PROYECTO/controller/ProcesoCompra.php?opc=AgregarDetalle";
 

  var urlProductos =
    "http://localhost/SIIS-PROYECTO/controller/ProcesoCompra.php?opc=GetProductos";

   var urlEliminarProducto =
     "http://localhost/SIIS-PROYECTO/controller/ProcesoCompra.php?opc=deleteProducto";

     var urlEditProducto =
       "http://localhost/SIIS-PROYECTO/controller/ProcesoCompra.php?opc=editProducto";
       var urlFinalizarCompra =
         "http://localhost/SIIS-PROYECTO/controller/ProcesoCompra.php?opc=finalCompra";

  //
  var urlCompras =
    "http://localhost/SIIS-PROYECTO/controller/ProcesoCompra.php?opc=getCompras";
     var urlVerCompra =
       "http://localhost/SIIS-PROYECTO/controller/ProcesoCompra.php?opc=getCompra";
       var urlDeleteCompra =
         "http://localhost/SIIS-PROYECTO/controller/ProcesoCompra.php?opc=deleteCompra";
         var urlUltimaCompra="http://localhost/SIIS-PROYECTO/controller/ProcesoCompra.php?opc=getUltimaCompra";
         var UrlEspeciesMM = 'http://localhost/SIIS-PROYECTO/controller/especiesMM.php?opc=GetEspeciesMM';

var tableCompra;
function CargarCompras() {
  $.ajax({
    url: urlCompras,
    type: "GET",
    datatype: "JSON",
    success: function (reponse) {
      var MisItems = reponse;
      var secuencia = 1; // Agregar una variable para la secuencia de números
            
      // Recorrer los datos y agregar la secuencia de números
      for (i = 0; i < MisItems.length; i++) {
          MisItems[i].Numero = secuencia;
          secuencia++;
      }
      // Si la tabla ya ha sido inicializada previamente, destruye la instancia
      if ($.fn.DataTable.isDataTable("#TablaCompras")) {
        $("#TablaCompras").DataTable().destroy();
      }
      $("#TablaCompras").DataTable({
        processing: true,
        data: MisItems,
        language: {
          url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
        },
        columns: [
          { data: 'Numero' }, // Mostrar la secuencia de números
          { data: "nombreProveedor" },
          { data: "Fecha_compra" },
          { data: "Total" },
          { data: "options" },

          /*  {
            data: null,
            render: function (data, type, row) {
              return (
                '<div class="d-flex"><div  style="margin-right: 4px;"><button class="rounded" style=" background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="verCompra(\'' +
                row.Id_Compra +
                "');\">Ver "+'<i class="fa-solid fa-eye"></i>'+"</button></div>" +
                '<div style="margin-right: 4px;"><button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 80px;" onclick="compraPDF(\'' +
                row.Id_Compra +
                "')\">PDF "+'<i class="fa-regular fa-file-pdf"></i>'+"</button></div>"+'<div><button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 80px;" onclick="cancelarCompra(\'' +
                row.Id_Compra +
                "')\">Cancelar</button></div>'"+"</div>"
              );
            },
          }, */
        ],
      });
    },
  });
}


function cancelarCompra(idCompra) {
  Swal.fire({
    title: "¿Cancelar compra?",
    text: "¿Está seguro que desea cancelar la compra? Esta acción es irreversible",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí, cancelar",
  }).then((result) => {
    if (result.isConfirmed) {

 var datoCompra = {
   idCompra: idCompra,
 };
 var datoCompra = JSON.stringify(datoCompra);
 $.ajax({
   url: urlDeleteCompra,
   type: "POST",
   data: datoCompra,
   datatype: "JSON",
   success: function (response) {
     
      //Swal.fire("Cancelada!", "Compra Cancelada Correctamente.", "success");
      Swal.fire({
        title: "Cancelada",
        text: "Compra cancelada correctamente.",
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


function calcularRendimiento() {
  peso = parseFloat(document.querySelector("#PesoVivo").value);
  canal = parseFloat(document.querySelector("#Canal").value);
  rendimiento = (canal * 100) / peso;

  console.log(peso);
  console.log(canal);

  console.log(rendimiento);

  rendimiento = rendimiento.toFixed(2); // 2 decimales
  document.querySelector("#Rendimiento").value = rendimiento;
}


function verCompra(idCompra){

    location.href = "http://localhost/SIIS-PROYECTO/Formularios/verCompra.php?id="+idCompra;
  
}

function compraPDF(idCompra) {
  // Crear la URL del PDF
  var urlPDF = "http://localhost/SIIS-PROYECTO/Reportes/reporteCompra.php?id=" + idCompra;

  // Abrir el PDF en una nueva ventana del navegador
  window.open(urlPDF, "_blank");

  // Redirigir al usuario después de cerrar el PDF
  window.location.href = "../Formularios/Compras.php";
}


function listarCompra(idCompra) {
 var datoCompra = {
      idCompra: idCompra,
    };
    var datoCompra = JSON.stringify(datoCompra);
   $.ajax({
     url: urlVerCompra,
     type: "POST",
     data: datoCompra,
     datatype: "JSON",
     success: function (response) {
       var MisItems = response;
       var opciones = "";
       console.log(MisItems["DetalleCompra"]);

       document.querySelector("#titulo").innerHTML =
         "Compra #" + MisItems["Compra"][0]["Id_Compra"];
       document.querySelector("#Select_Proveedor").value =
         MisItems["Compra"][0]["nombreProveedor"];

         // Obtener la fecha en el formato "año-mes-día" desde MisItems
        var fechaOriginal = MisItems["Compra"][0]["Fecha_compra"];

        // Dividir la fecha en partes (año, mes, día)
        var partesFecha = fechaOriginal.split("-");

        // Crear una nueva fecha en el formato "mes-dia-año"
        var fechaFormateada = partesFecha[2] + "-" + partesFecha[1] + "-" + partesFecha[0];

        // Asignar la fecha formateada al campo de texto
        document.querySelector("#Fecha_Compra").value = fechaFormateada;

       document.querySelector("#Total").value = MisItems["Compra"][0]["Total"];
       document.querySelector("#Observacion").value =
         MisItems["Compra"][0]["Observacion"];

        for (i = 0; i < MisItems["DetalleCompra"].length; i++) {
          console.log(MisItems["DetalleCompra"][i]["Id_Producto"]);
         opciones += `<tr>
              <td>${MisItems["DetalleCompra"][i]["Id_Producto"]}</td>
              <td>${MisItems["DetalleCompra"][i]["Nombre"]}</td>
              <td>${MisItems["DetalleCompra"][i]["Cantidad"]}</td>
              <td>${MisItems["DetalleCompra"][i]["Precio_libra"]}</td>
              <td>${MisItems["DetalleCompra"][i][0]["Especie"]}</td>
              <td>${MisItems["DetalleCompra"][i][0]["Peso_vivo"]}</td>
              <td>${MisItems["DetalleCompra"][i][0]["Canal"]}</td>
              <td>${MisItems["DetalleCompra"][i][0]["Rendimiento"]}</td>

            </tr>`;
         
       }
       $("#tablaCompra").html(opciones);
     },
   });
}
         //Función para traer los Proveedores
function CargarProveedores() {
  $.ajax({
    url: urlProveedores,
    type: "GET",
    datatype: "JSON",
    success: function(response){
      var MisItems = response;
      var opciones =
        '<option value="">' + "Seleccione Un Proveedor" + "</option>";
      
      for(i=0; i<MisItems.length; i++){ //Muestra Id y nombre
           opciones +='<option value="' +
            MisItems[i].Id_Proveedor +
            '">' +
            MisItems[i].Id_Proveedor +
            " - " +
            MisItems[i].Nombre +
            "</option>";
        }
      $("#Select_Proveedor").html(opciones);
      $("#Select_Proveedor").select2({
        language: {
          noResults: function () {
            return "Sin Resultados <a href='http://localhost/SIIS-PROYECTO/Formularios/Proveedores.php' class='btn btn-success'>Agregar Nuevo Proveedor</a>";
          },
        },
        escapeMarkup: function (markup) {
          return markup;
        },
      });
    },
  });
}
function CargarEspecies(){
  $.ajax({
    url: UrlEspeciesMM,
    type: "GET",
    datatype: "JSON",
    success: function(response){
      var MisItems = response;
      var opciones =
        '<option value="">' + "Seleccione la Especie" + "</option>";
      
      for(i=0; i<MisItems.length; i++){ //Muestra Id y nombre
           opciones +='<option value="' +
            MisItems[i].Id_Especie +
            '">' +
            MisItems[i].Id_Especie +
            " - " +
            MisItems[i].Nombre_Especie +
            "</option>";
        }
      $('#Especie').html(opciones);
         $("#Especie").select2({
          language: {
            noResults: function () {
              return "Sin Resultados <a href='http://localhost/SIIS-PROYECTO/Formularios/EspeciesMM.php' class='btn btn-success'>Agregar Nueva Especie</a>";
            },
          },
          escapeMarkup: function (markup) {
            return markup;
          },
        });
    },
  });
}

//Función para traer los Productos
function CargarProductos() {
  $.ajax({
    url: urlProductos,
    type: "GET",
    datatype: "JSON",
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

$(document).ready(function () {
  CargarProveedores();
  CargarProductos();
  CargarEspecies();
  CargarCompras();
});

function siguiente1() {

  proveedor = document.querySelector("#Select_Proveedor").value;
  fechaCompra = document.querySelector("#Fecha_Compra").value;
  total = document.querySelector("#Total").value;
  observacion = document.querySelector("#Observacion").value;

  // Validar que se haya seleccionado un proveedor
  if (proveedor === "") {
    Swal.fire({
        title: 'No ha seleccionado un proveedor',
        icon: 'error',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Aceptar'
    });
    return;
  }

  // Validar que el total sea un número mayor a 0 con dos decimales después del punto
  if (!/^\d+(\.\d{1,2})?$/.test(total) || parseFloat(total) <= 0) {
    Swal.fire({
        title: 'Total de la compra inválido',
        text: 'El total debe ser un número válido con hasta dos decimales y mayor a 0.',
        icon: 'error',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Aceptar'
    });
    document.querySelector("#Total").value = ""; 
    return;
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

function atras2() {

  document.querySelector("#pestaña2").classList.remove("active");
  document.querySelector("#pestaña2").classList.remove("show");
  document.querySelector("#nav2").classList.remove("active");
  document.querySelector("#nav2").classList.remove("show");
  


  document.querySelector("#pestaña1").classList.add("active");
  document.querySelector("#pestaña1").classList.add("show");
  document.querySelector("#nav1").classList.add("active");
  document.querySelector("#nav1").classList.add("show");

  
}

function AgregarDetalleCompra(){
      Producto= $("#Select_Producto").val();
      Cantidad= $("#Cantidad").val();
      Precio_Libra= $("#Precio_Libra").val();
      especie= $("#Especie").val();
      pesoVivo= $("#PesoVivo").val();
      canal= $("#Canal").val();
      Rendimiento= $("#Rendimiento").val();

    // Validar que se haya seleccionado un producto
    if (Producto === "") {
      Swal.fire({
          title: 'Seleccione un producto',
          icon: 'error',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Aceptar'
      });
      return;
    }

    // Validar que la cantidad sea un número mayor a 0
    if (!(/^\d+$/.test(Cantidad)) || parseInt(Cantidad) <= 0) {
      Swal.fire({
          title: 'Ingrese una cantidad de producto válida',
          text: 'La cantidad debe ser un número entero mayor a 0.',
          icon: 'error',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Aceptar'
      });
      document.querySelector("#Cantidad").value = ""; 
      return;
    }

    // Validar que el precio sea un número mayor a 0 con dos decimales después del punto
    if (!/^\d+(\.\d{1,2})?$/.test(Precio_Libra) || parseFloat(Precio_Libra) <= 0) {
      Swal.fire({
          title: 'Ingrese un precio por libra válido',
          text: 'El precio debe ser un número válido con hasta dos decimales y mayor a 0.',
          icon: 'error',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Aceptar'
      });
      document.querySelector("#Precio_Libra").value = ""; 
      return;
    }

    // Validar que se haya seleccionado una especie
    if (especie === "") {
      Swal.fire({
          title: 'Seleccione la especie',
          icon: 'error',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Aceptar'
      });
      return;
    }

    // Validar que el peso vivo sea un número mayor a 0
    if (!(/^\d+$/.test(pesoVivo)) || parseInt(pesoVivo) <= 0) {
      Swal.fire({
          title:'Peso vivo inválido',
          text: 'El peso vivo debe ser un número entero mayor a 0.',
          icon: 'error',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Aceptar'
      });
      document.querySelector("#PesoVivo").value = ""; 
      return;
    }

     // Validar que el canal sea un número mayor a 0 con dos decimales después del punto
     if (!/^\d+(\.\d{1,2})?$/.test(canal) || parseFloat(canal) <= 0) {
      Swal.fire({
          title:'Canal inválido',
          text: 'El canal debe ser un número válido con hasta dos decimales y mayor a 0.',
          icon: 'error',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Aceptar'
      });
      document.querySelector("#Canal").value = ""; 
      return;
    }

    var DatosProducto = {
      Producto: $("#Select_Producto").val(),
      Cantidad: $("#Cantidad").val(),
      Precio_Libra: $("#Precio_Libra").val(),
      especie: $("#Especie").val(),
      pesoVivo: $("#PesoVivo").val(),
      canal: $("#Canal").val(),
      Rendimiento: $("#Rendimiento").val(),
    };
    var DatosProducto = JSON.stringify(DatosProducto);


   $.ajax({
     url: urlDetalleCompra,
     type: "POST",
     data: DatosProducto,
     datatype: "JSON",
     success: function (response) {
      var MisItems = response;
    

        document.querySelector("#tablaCompra").innerHTML = MisItems.htmlCompras;
        document.querySelector("#InsertDetalleCompra").reset();
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

function del_product_detalle(idProducto){
   var DatosProducto = {
     Producto:idProducto
   };
   var DatosProducto = JSON.stringify(DatosProducto);

   $.ajax({
     url: urlEliminarProducto,
     type: "POST",
     data: DatosProducto,
     datatype: "JSON",
     success: function (response) {
       var MisItems = response;
     
       document.querySelector("#tablaCompra").innerHTML = MisItems.htmlCompras;
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

function edit_product_detalle(idProducto) {
  var DatosProducto = {
    Producto: idProducto,
  };
  var DatosProducto = JSON.stringify(DatosProducto);
  $.ajax({
    url: urlEditProducto,
    data: DatosProducto,
    type: "POST",
    datatype: "JSON",
    success: function (response) {
      var MisItems = response.datos;
      var MisItems2 = response;

      document.querySelector("#Select_Producto").value = MisItems.idproducto;
      document.querySelector("#Cantidad").value = MisItems.cantidad;
      document.querySelector("#Precio_Libra").value = MisItems.precio;
      document.querySelector("#Especie").value = MisItems.especie;
      document.querySelector("#PesoVivo").value = MisItems.pesoVivo;
      document.querySelector("#Canal").value = MisItems.canal;
      document.querySelector("#Rendimiento").value = MisItems.Rendimiento;

      // Agrega la clase "select2" al select de Producto y especie
      $('#Select_Producto, #Especie').addClass('select2');
      // Inicializa los select2
      $('.select2').select2();

      Swal.fire({
        toast: true,
        customClass: {
          popup: "colored-toast",
        },
        position: "top-right",
        icon: "info",
        title: MisItems2.msg,
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: true,
      });
    },
  });
}


function finalizarCompra() {
  proveedor = document.querySelector("#Select_Proveedor").value;
  fechaCompra = document.querySelector("#Fecha_Compra").value;
  total = document.querySelector("#Total").value;
  observacion = document.querySelector("#Observacion").value;

  var DatosCompra = {
    proveedor: proveedor,
    fechaCompra: fechaCompra,
    total: total,
    observacion: observacion,
  };
  var DatosCompra = JSON.stringify(DatosCompra);

  $.ajax({
    url: urlFinalizarCompra,
    type: "POST",
    data: DatosCompra,
    datatype: "JSON",
    success: function (response) {
      var MisItems = response;

      // Agregar solicitud AJAX para obtener el ID de la última compra
      $.ajax({
        url: urlUltimaCompra,
        type: "GET",
        datatype: "JSON",
        success: function (response) {
          var ultimaCompra = response.Id_Compra;
          // Actualizar el botón PDF con el ID de la última compra
          var botonPDF = '<div style="margin-right: 4px;"><button id="boton-pdf" class="rounded" style="background-color: #FF0000; color: white; display: none; width: 80px;" onclick="compraPDF(\'' + ultimaCompra + "')\">PDF " + '<i class="fa-regular fa-file-pdf"></i>' + "</button></div>";
          // Actualizar el mensaje de confirmación para incluir el botón PDF actualizado
          swal.fire({
            title: "LISTO!",
            html: MisItems.msg + botonPDF,
            icon: "success",
            confirmButtonText: "Aceptar",
            closeOnConfirm: false,
            timer: 9000,
            willClose: () => {
              /* var imprimir = confirm("¿Desea imprimir la ficha de la compra?"); */
              swal.fire({
                title: "Ficha de compra",
                text: "¿Desea imprimir la ficha de la compra?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sí, imprimir",
                cancelButtonText: "No, cancelar",
                closeOnConfirm: false,
                closeOnCancel: true,
              }).then((result)=>{
                if(result.isConfirmed){
                compraPDF(ultimaCompra)
                }else {
                  window.location.href = "../Formularios/Compras.php";
                }
              })
            },
          });
        },
      });
    },
  });
}


