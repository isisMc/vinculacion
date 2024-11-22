<?php

session_start();

if (isset($_SESSION['usr_log'])) {
    $usuario = explode("|", $_SESSION['usr_log']);
    $idAlumno = $usuario[0];
} else {
    header('Location: ../../../index.php');
    exit;
}

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

$sql = "SELECT * FROM solicitudes WHERE idAlumno = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $idAlumno);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        $json[] = array(
            'clave' => 'Error',
            'mensaje' => 'No hay manera de manejar sus datos'
        );
    } else {
        $row = $result->fetch_assoc();

        if (isset($row['status']) && isset($row['yaEntrego'])) {
            $status = $row['status'];
            $proceso_num = $row['yaEntrego'];
        } else {
            $json[] = array(
                'clave' => 'ERROR',
                'mensaje' => 'Hay datos faltantes.'
            );
            header('Content-Type: application/json');
            echo json_encode($json);
            exit;
        }

        $proceso = "Error al recuperar el proceso ya entregado";

        switch ($proceso_num) {
            case 0:
                $proceso = "Formulario";
                break;
            case 1:
                $proceso = "Primer Reporte";
                break;
            case 2:
                $proceso = "Segundo Reporte";
                break;
            case 3:
                $proceso = "Tercer Reporte";
                break;
            case 4:
                $proceso = "Reporte final";
                break;
            case 5:
                $json[] = array(
                    'clave' => "EXITO",
                    'mensaje' => 'Concluyó exitosamente su proceso de prácticas profesionales.'
                );
                header('Content-Type: application/json');
                echo json_encode($json);
                exit;
        }

        switch ($status) {
            case 0:
                $json[] = array(
                    'clave' => "EXITO",
                    'mensaje' => 'No hay notificaciones pendientes'
                );
                break;
            case 1:
                $json[] = array(
                    'clave' => "EXITO",
                    'mensaje' => 'En espera de revisión del ' . $proceso
                );
                break;
            case 2:
                $json[] = array(
                    'clave' => "EXITO",
                    'mensaje' => 'El ' . $proceso . ' ha sido aceptado.'
                );
                break;
            case 3:
                $json[] = array(
                    'clave' => "EXITO",
                    'mensaje' => 'Se rechazó el ' . $proceso . ', favor de revisar sus datos.'
                );
                break;
        }

        $_SESSION['status_NUMBER'] = 0;
    }

    $stmt->close();
    $conn->close();
} else {
    $json[] = array(
        'clave' => 'ERROR',
        'mensaje' => 'No se ha podido realizar la solicitud.'
    );
}

header('Content-Type: application/json');
echo json_encode($json);
exit;