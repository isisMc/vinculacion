<?php
    $servidor = "localhost";
    $usuario = "root";
    $password = "";
    $bbdd = "vinculacion";
    
    $conn = new mysqli($servidor,$usuario,$password,$bbdd);

    mysqli_set_charset($conn, 'utf8');

?>