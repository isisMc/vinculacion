<?php
    session_start();

    $usuario = explode("|", $_SESSION['usr_log']);
    $idAlumno = $usuario[0];
    $status = $_SESSION['status_NUMBER'];

    require('../../../../config/conexion/conexion.php');
    $json = array();

    if ($conn->connect_error) {
        $json[] = array(
            'clave' => 'ERROR', 
            'mensaje' => 'Error de la conexión con la base de datos.'
        );
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    }

    $sql = 'UPDATE solicitudes SET status = ? WHERE idAlumno = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $status, $idAlumno);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            $json[] = array(
                'clave' => 'OK',
                'mensaje' => 'Status modificado'
            );
        } else {
            $json[] = array(
                'clave' => 'Error',
                'mensaje' => 'No hay manera de manejar sus datos',
                'dato' => $status,
                'SESSION' => $_SESSION['status_NUMBER']
            );
        }
    } else {
        $json[] = array(
            'clave' => 'ERROR',
            'mensaje' => 'No se ha podido realizar el cambios.'
        );
    }

    $stmt->close();
    $conn->close();

    header('Content-Type: application/json');
    echo json_encode($json);
    exit;