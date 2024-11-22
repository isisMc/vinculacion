<?php 
    session_start();
    $json = array();

    $_SESSION['id'] = $_POST['id'];
    $_SESSION['img'] = $_POST['img'];
    $_SESSION['cargo'] = $_POST['cargo'];
    $_SESSION['departamento'] = $_POST['departamento'];
    $_SESSION['nivel_acceso'] = $_POST['nivel_acceso'];

    if (isset($_SESSION['id'])) {
        $json[] = array(
            'clave' => 'exito',
            'mensaje' => 'Se logro crear la session'
        );
    } else {
        $json[] = array(
            'clave' => 'Error',
            'mensaje' => 'No se logro crear la session'
        );
    }

    header('Content-Type: application/json');
    echo (json_encode($json));
    exit;