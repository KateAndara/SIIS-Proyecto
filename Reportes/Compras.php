<?php
require('../fpdf/fpdf.php');
require_once('../config/conexion4.php');
//require_once '../controller/roles.php';
//require_once '../models/Roles.php';


class PDF extends FPDF {

    // Cabecera de página
    
        function Header() {
            require_once('../config/conexion.php');
              // Ejecutar consulta para obtener el logo
              /* $sql = "SELECT Valor FROM tbl_ms_parametros where Parametro='LOGO'"; 
              $resultado = $conexion->query($sql);
              if ($resultado->num_rows > 0) {
                  while($fila = $resultado->fetch_assoc()) {
                    $logo = $fila["Valor"];
                  }
              } */

              $logo="../img/logo.jpg";
            $this->SetFont('Times', 'B', 12);
            $this->Image($logo, 170,8,35); //imagen(archivo, png/jpg || x,y,tamaño)
            $this->setXY(60, 15);
            $this->setXY(50,20);
            
            // Ejecutar consulta para obtener el nombre
            $sql = "SELECT Valor FROM tbl_ms_parametros where Parametro='NOMBRE_EMPRESA'"; 
            $resultado = $conexion->query($sql);
            if ($resultado->num_rows > 0) {
                while($fila = $resultado->fetch_assoc()) {
                  $nombre = $fila["Valor"];
                }
            }
            $conexion->close();
            $this->Cell(100,12,utf8_decode($nombre),0,0,'C',0);  //C=Center, R=right, L=left
            $this->setXY(50,20);
            //$this->Cell(100,20,utf8_decode('profesionales  de La Sierra de la Paz'),0,0,'C',0);  //C=Center, R=right, L=left
           
        }
    
    // Pie de página
    
        function Footer() {
            // Posición: a 1,5 cm del final
            $this->SetY(-15);
    
            $this->SetFont('Arial', 'B', 10);
            // Número de página y fecha
            date_default_timezone_set('America/Tegucigalpa');
            $hoy = date("d-m-Y h:i:s");
            $this->Cell(22, 10, utf8_decode('Generado el '), 0, 0, 'L');;
            $this->Cell(100, 10, utf8_decode($hoy), 0, 0, 'L');;
            $this->Cell(75, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'R');
            //Fecha
            //$this->Cell(170, 10,'Municipio, Estado , a '. date('d') . ' de '. date('F'). ' de '. date('Y'), 0,1,'C');
            
        }
    
    // --------------------METODO PARA ADAPTAR LAS CELDAS------------------------------
        var $widths;
        var $aligns;
    
        function SetWidths($w) {
            //Set the array of column widths
            $this->widths = $w;
        }
    
        function SetAligns($a) {
            //Set the array of column alignments
            $this->aligns = $a;
        }
    
        function Row($data, $setX) 
        {
            //Calculate the height of the row
            $nb = 0;
            for ($i = 0; $i < count($data); $i++) {
                $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
            }
    
            $h = 8 * $nb;
            //Issue a page break first if needed
            $this->CheckPageBreak($h, $setX);
            //Draw the cells of the row
            for ($i = 0; $i < count($data); $i++) {
                $w = $this->widths[$i];
                $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
                //Save the current position
                $x = $this->GetX();
                $y = $this->GetY();
                //Draw the border
                $this->Rect($x, $y, $w, $h, 'DF');
                //Print the text
                $this->MultiCell($w, 8, $data[$i], 0, $a);
                //Put the position to the right of the cell
                $this->SetXY($x + $w, $y);
            }
            //Go to the next line
            $this->Ln($h);
        }
    
        function CheckPageBreak($h, $setX) {
            //If the height h would cause an overflow, add a new page immediately
            if ($this->GetY() + $h > $this->PageBreakTrigger) {
                $this->AddPage($this->CurOrientation);
                $this->SetX($setX);
    
                //volvemos a definir el  encabezado cuando se crea una nueva pagina
                $this->SetFont('Helvetica', 'B', 15);
                $this->SetFillColor(116, 190, 220); //color de fondo rgb
                $this->Ln(40);

                $this->Cell(15,8,utf8_decode('N°'),1,0,'C',0);  //C=Center, R=right, L=left
                $this->Cell(70,8,utf8_decode('ROL'),1,0,'C',0);  //C=Center, R=right, L=left
                $this->Cell(100,8,utf8_decode('DESCRIPCIÓN'),1,1,'C',0);  //C=Center, R=right, L=left
                $this->SetFont('Arial', '', 12);
    
            }
    
            if ($setX == 100) {
                $this->SetX(100);
            } else {
                $this->SetX($setX);
            }
    
        }
    
        function NbLines($w, $txt) {
            //Computes the number of lines a MultiCell of width w will take
            $cw = &$this->CurrentFont['cw'];
            if ($w == 0) {
                $w = $this->w - $this->rMargin - $this->x;
            }
    
            $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
            $s = str_replace("\r", '', $txt);
            $nb = strlen($s);
            if ($nb > 0 and $s[$nb - 1] == "\n") {
                $nb--;
            }
    
            $sep = -1;
            $i = 0;
            $j = 0;
            $l = 0;
            $nl = 1;
            while ($i < $nb) {
                $c = $s[$i];
                if ($c == "\n") {
                    $i++;
                    $sep = -1;
                    $j = $i;
                    $l = 0;
                    $nl++;
                    continue;
                }
                if ($c == ' ') {
                    $sep = $i;
                }
    
                $l += $cw[$c];
                if ($l > $wmax) {
                    if ($sep == -1) {
                        if ($i == $j) {
                            $i++;
                        }
    
                    } else {
                        $i = $sep + 1;
                    }
    
                    $sep = -1;
                    $j = $i;
                    $l = 0;
                    $nl++;
                } else {
                    $i++;
                }
    
            }
            return $nl;
        }
    // -----------------------------------TERMINA---------------------------------
    }

//------------------OBTENES LOS DATOS DE LA BASE DE DATOS-------------------------

 $sql = "SELECT c.*, p.Nombre as nombreProveedor FROM  tbl_compras c INNER JOIN tbl_proveedores p on c.Id_Proveedor=p.Id_Proveedor";
 $resultado = mysqli_query($conn, $sql);


 
 


//--------------TERMINA BASE DE DATOS-----------------------------------------------

// Creación del objeto de la clase heredada
$pdf = new PDF(); //hacemos una instancia de la clase
$pdf->AliasNbPages();
$pdf->AddPage(); //añade l apagina / en blanco
$pdf->SetMargins(10, 10, 10); //MARGENES
$pdf->SetAutoPageBreak(true, 20); //salto de pagina automatico

    // -----------ENCABEZADO------------------
    $pdf->setXY(50,26);
    $pdf->SetFont('Helvetica','B',15); //Definir tipo de letra y tamaño B=Negrita
    $pdf->SetTextColor(220,50,50); //Color rojo
    $pdf->Cell(100,55,utf8_decode('Reporte de Compras'),0,0,'C',0);//Nombre del reporte 
    $pdf->SetFont('Helvetica','B',15); //Definir tipo de letra y tamaño B=Negrita
    $pdf->SetTextColor(0,0,0); //Color negro
    $pdf->Ln(40);
    $pdf->Cell(15,8,utf8_decode('N°'),1,0,'C',0);  //C=Center, R=right, L=left
    $pdf->Cell(60,8,utf8_decode('PROVEEDOR'),1,0,'C',0);  //C=Center, R=right, L=left
    $pdf->Cell(50,8,utf8_decode('FECHA'),1,0,'C',0);  //C=Center, R=right, L=left
    $pdf->Cell(50,8,utf8_decode('TOTAL'),1,1,'C',0);  //C=Center, R=right, L=left
    

    // -------TERMINA----ENCABEZADO------------------
    
    $pdf->SetFillColor(255, 255, 255 ); //color de fondo rgb
    $pdf->SetDrawColor(61, 61, 61); //color de linea  rgb
    
    $pdf->SetFont('Arial', '', 12);

//El ancho de las celdas
$pdf->SetWidths(array(15, 70, 100)); //???
// esto no lo mencione en el video pero también pueden poner la alineación de cada COLUMNA!!!
//$pdf->SetAligns(array('C','C','C','L'));


 // Agregar los datos a la página
 while ($fila = mysqli_fetch_assoc($resultado)) {
    $pdf->Cell(15,8, ucwords(strtolower(utf8_decode($fila['Id_Compra']))),1,0,'C',0);
    $pdf->Cell(60,8, ucwords(strtolower(utf8_decode($fila['nombreProveedor']))),1,0,'C',0);
    $pdf->Cell(50,8, ucwords(strtolower(utf8_decode($fila['Fecha_compra']))),1,0,'C',0);
    $pdf->Cell(50,8, ucwords(strtolower(utf8_decode($fila['Total']))),1,1,'C',0);


 }




// cell(ancho, largo, contenido,borde?, salto de linea?)*/
$pdf->Output();
?>