
<?php
    include_once './token/Token.php';


    //include_once 

    $datos = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    $validar = ALLtoken::validar($datos);

    if ($validar = 'Token Valido') 
    {
        /*?>
        <?php*/
    }else {
    
        header('Location: ./Formularios/');
    }

?>