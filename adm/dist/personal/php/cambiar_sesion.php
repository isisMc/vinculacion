<?php 
    session_start();
    $json = array();
    
    $_SESSION['grupo'] = $_POST['grupo'];
    
    if ($_SESSION['grupo'] == $_POST['grupo']) {
        $json[] = array(
            'clave' => 'OK',
            'mensaje' => $_SESSION['grupo']
        );
    } else {
        $json[] = array(
            'clave' => 'ERROR',
            'mensaje' => 'ERROR al momemto de cambiar la sessión.'
        );
    }
    
    header('Content-Type: application/json');
    echo (json_encode($json));
    exit;  