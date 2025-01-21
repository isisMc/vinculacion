<?php 
require ('../../../../config/conexion/conexion.php');
$json = array();

if ($conn->connect_error) {
    $json[] = array(
        'clave' => 'ERROR', 
        'mensaje' => 'ERROR de la conexión con la base de datos.'
    );
} else {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $proceso = $_POST['proceso'];
    $mensaje = isset($_POST['mensaje']) ? $_POST['mensaje'] : null;

    // Actualizar el estado de la solicitud
    $stmt = $conn->prepare("UPDATE `vinculacion`.`solicitudes` SET `status`=? WHERE `idAlumno`=?;");
    if (!$stmt) {
        $json[] = array(
            'clave' => 'ERROR',
            'mensaje' => 'Error al preparar la consulta.'
        );
        echo json_encode($json);
        exit;
    }

    $stmt->bind_param('ii', $status, $id);

    if ($stmt->execute()) {
        if ($status == 3 && !empty($mensaje)) {
            // Guardar el mensaje de rechazo si existe
            $stmt_mensaje = $conn->prepare("INSERT INTO `vinculacion`.`mensajes_rechazo` (`idAlumno`, `mensaje`,`proceso`) VALUES (?, ?, ?);");
            if ($stmt_mensaje) {
                $stmt_mensaje->bind_param('isi', $id, $mensaje, $proceso);
                if ($stmt_mensaje->execute()) {
                    $json[] = array(
                        'clave' => 'EXITO',
                        'mensaje' => 'Se ha rechazado correctamente y el mensaje fue enviado.'
                    );
                } else {
                    $json[] = array(
                        'clave' => 'ERROR',
                        'mensaje' => 'Solicitud rechazada, pero no se pudo guardar el mensaje.'
                    );
                }
                $stmt_mensaje->close();
            } else {
                $json[] = array(
                    'clave' => 'ERROR',
                    'mensaje' => 'Solicitud rechazada, pero ocurrió un error al preparar la consulta para el mensaje.'
                );
            }
        } else {
            $json[] = array(
                'clave' => 'EXITO',
                'mensaje' => 'Se ha procesado correctamente la solicitud.'
            );
        }
    } else {
        $json[] = array(
            'clave' => 'ERROR',
            'mensaje' => 'ERROR al momento de hacer la consulta.'
        );
    }

    $stmt->close();
}

header('Content-Type: application/json');
echo json_encode($json);
exit;
?>
