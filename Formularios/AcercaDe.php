<?php 
include '../components/header.components.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acerca de</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="../CSS/styleF.css" rel="stylesheet">
</head>
<body>
<div class="border border-3 p-3">        
    <h1 style="color: black">Acerca de </h1><br>

<div class="accordion" id="informacion-empresa">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        Información de la empresa
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#informacion-empresa">
      <div class="accordion-body">
        La empresa "Empresa De Servicios Múltiples Jóvenes Profesionales Lencas De La Sierra" se dedica a la producción de productos cárnicos de cerdo en la región 
        de Yarula - Santa Elena, La Paz. Su producción incluye embutidos y cortes de carne, y actualmente satisfacen la demanda de la región local.
      </div>
    </div>
  </div>
</div>

<div class="accordion" id="informacion-sistema">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        Información del sistema
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#informacion-sistema">
      <div class="accordion-body">
        Para mejorar su gestión de inventario, la empresa ha decidido implementar un sistema informático llamado "Inventarios De La Sierra" (SIIS), desarrollado 
        por un equipo de trabajo denominado "Cazadores de Software". Este sistema permitirá llevar un control del inventario, registrando las entradas y salidas 
        (compras y ventas), y generando reportes para una mejor toma de decisiones.
      </div>
    </div>
  </div>
</div>

<div class="accordion" id="informacion-equipotecnico">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingThree">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        Información del equipo técnico 
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#informacion-equipotecnico">
      <div class="accordion-body">
        El equipo técnico encargado de desarrollar el sistema SIIS está conformado por estudiantes de la carrera de Informática Administrativa, quienes están comprometidos 
        con la empresa para brindar un sistema de información funcional y de fácil acceso. Con esto, se espera que la empresa pueda mejorar su eficiencia en la gestión de 
        inventarios y, por ende, su rentabilidad.
        <br>
      </div>
    </div>
  </div>
</div>
</div>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>