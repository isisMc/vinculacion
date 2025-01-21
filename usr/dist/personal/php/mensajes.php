<?php

require('../../../../config/conexion/conexion.php');
header('Content-Type: application/json');

$json = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['idAlumno']) && isset($_POST['proceso'])) {
        $idAlumno = $_POST['idAlumno'];
        $proceso = $_POST['proceso'];

        // Consulta para obtener todos los datos de mensajes_rechazo
        $sql = "SELECT * FROM mensajes_rechazo WHERE idAlumno = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idAlumno);

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $rechazo = $result->fetch_assoc();
                $procesoD = $rechazo['proceso'];
                $mensaje = $rechazo['mensaje'];
                if($proceso == $procesoD){
                    $json[] = array(
                    'clave' => 'ok',
                    'mensaje' => 'Datos encontrados.',
                    'datosRechazo' => $mensaje
                );
            } else {
                $json[] = array(
                    'clave' => 'ERROR',
                    'mensaje' => 'No se encontraron datos asociados al idAlumno.'
                );
            }
            } else {
                $json[] = array(
                    'clave' => 'ERROR',
                    'mensaje' => 'No se encontraron datos asociados al idAlumno.'
                );
            }
        } else {
            $json[] = array(
                'clave' => 'ERROR',
                'mensaje' => 'Error al ejecutar la consulta: ' . $stmt->error
            );
        }

        $stmt->close();
    } else {
        $json[] = array(
            'clave' => 'ERROR',
            'mensaje' => 'Parámetros incompletos.'
        );
    }

    $conn->close();
} else {
    $json[] = array(
        'clave' => 'ERROR',
        'mensaje' => 'Método no permitido.'
    );
}
header('Content-Type: application/json');
echo json_encode($json);
exit;
?>
