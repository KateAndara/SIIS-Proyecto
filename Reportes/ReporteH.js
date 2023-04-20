function generarReporte(id_tabla, titulo_reporte, tamaño_tabla) {
    const jsPDF = window.jspdf.jsPDF;
  
    // Obtener los datos de la tabla y almacenarlos en una variable
var tableData = [];             //Body
var tableHeaders = [];      //Encabezados
$("#" + id_tabla + " th:not(:first-child)").each(function () { // Seleccionar todos los encabezados excepto el primero
  if ($(this).is(":visible")) {               // Verificar si la columna está visible
    tableHeaders.push($(this).text().trim()); // Limpiar los espacios en blanco del encabezado y agregarlo a la tabla
  }
});
tableData.push(tableHeaders);

var visibleRows = 0;
$("#" + id_tabla + " tbody tr").each(function () {
  if ($(this).is(":visible")) {     //Verificar si la fila está visible
    visibleRows++;                  //Contador de filas visibles
    var rowData = [];
    $(this).find("td:not(:first-child)").each(function () { // Seleccionar todas las celdas excepto la primera columna
      if ($(this).is(":visible")) { // Verificar si la celda está en una columna visible
        rowData.push($(this).text());
      }
    });
    tableData.push(rowData);
  }
});
  
    if (visibleRows === 0) {    // Comprobar si no hay filas visibles
      Alerta("error", "Su busqueda esta vacia, no se puede generar un reporte");
      return false;             //Retornarmos false para evitar la generacion del pdf
    }
  
    // Crear una instancia de jsPDF con orientación horizontal
    var pdf = new jsPDF({
      orientation: 'landscape'                   //Orientacion Horizontal ='landscape' 
    });
    
    // Agregar imagen de logo en el lado derecho de la página
    
    var logoImg = new Image();
    logoImg.src = '../img/Logo1.png';
    logoImg.onload = function () {
      var pageWidth = pdf.internal.pageSize.getWidth();    //Ancho de la pagina
      var imageWidth = 35;
      var margin = 20;
      var imageX = pageWidth - imageWidth - margin +15;
      pdf.addImage(logoImg, 'PNG', imageX, 10, 35, 35);
  
      
      // Agregar título centrado
     // Agregar título centrado
      var titulo = titulo_reporte;  //Titulo para el reporte
      var fontSize = 14;            //Tamaño para el titulo
      var textWidth = pdf.getTextDimensions(titulo, { fontSize }).w;
      var startX = (pageWidth - textWidth) / 2;
      pdf.setTextColor(144, 12, 63);
      pdf.setFont("Arial", "bold");//Tipo de letra y agregar negrita
      pdf.setFontSize(fontSize);
      pdf.text(titulo, startX, 45);
      pdf.line(startX, 46, startX + textWidth, 46);
      pdf.setTextColor(0, 0, 0);
      pdf.setFontSize(18);
      var NombreEmpresa = "Empresa de servicios múltiples";
      pdf.text(NombreEmpresa, 105, 20);
      var NombreEmpresa = "jóvenes profesionales";
      pdf.text(NombreEmpresa, 118, 27);
      var NombreEmpresa = "de La Sierra de la Paz";
      pdf.text(NombreEmpresa, 117, 34);
   
  
      var tableWidth = tamaño_tabla;
      // Agregar tabla
      /*pdf.autoTable({
        margin: { left: ((pageWidth - tableWidth) / 2) },       //Centrar la tabla
        startY: 45,                                             //Altura en la que se empieza a dibujar la tabla
        head: [tableHeaders],                                   //Enbezados de la tabla
        body: tableData.slice(1),                               //Cuerpo
        tableWidth: tableWidth,                                 //Ancho de la tabla
        styles: { fontSize: 9 }                                 //Tamaño de letra para la tabla
      });*/
  
      pdf.autoTable({
        margin: { left: 20 }, 
        startY: 65,                                            
        head: [tableHeaders],                                   
        body: tableData.slice(1),                              
        tableWidth: tableWidth + 200,  //Aumentar el ancho de la tabla en 100
        styles: { fontSize: 8 }      //Reducir el tamaño de letra a 8
      });
      // Agregar número de página
      var pageCount = pdf.internal.getNumberOfPages();
      for (i = 1; i <= pageCount; i++) {
        pdf.setPage(i);
        pdf.setFontSize(10);
        pdf.text('Página ' + i + ' / ' + pageCount, pdf.internal.pageSize.width - 30, pdf.internal.pageSize.height - 10);
  
        // Agregar fecha y hora actual
        var fecha = new Date().toLocaleString();
        pdf.setFontSize(10);
        pdf.text('Generado el ' + fecha, 15, pdf.internal.pageSize.height - 10);
      }
      // Guardar el PDF generado
      pdf.output('dataurlnewwindow', { filename: titulo_reporte + '.pdf' });  };
  }