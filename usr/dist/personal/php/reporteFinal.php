<?php
require("../../../../config/conexion/conexion.php");

if ($conn->connect_error) {
    echo json_encode(array(
        'clave' => 'ERROR',
        'mensaje' => 'Error: La conexión no se pudo establecer'
    ));
    exit();
}
$idAlumno = $_POST['idAlumno']; 
$actividades = $_POST['actividades'];
$fechaFinal = $_POST['fecha'];
$status = "1"; 
$sqlInsert = "INSERT INTO reportefinal (idAlumno, actividades) VALUES (?, ?)";
$stmt = $conn->prepare($sqlInsert);
$stmt->bind_param("is", $idAlumno, $actividades);

if ($stmt->execute()) {
    $idReporteFinal = $conn->insert_id; // obtener el ID del último registro insertado

    $sqlUpdate = 'UPDATE solicitudes SET status = ? WHERE idAlumno = ?';
    $stmt = $conn->prepare($sqlUpdate);
    $stmt->bind_param("is", $status, $idAlumno);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            $sqlUpdate = 'UPDATE admreportes SET idReporteFinal = ?, fechaFinal = ? WHERE idAlumno = ?';
            $stmt = $conn->prepare($sqlUpdate);
            $stmt->bind_param("iss", $idReporteFinal, $fechaFinal, $idAlumno);
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    $json[] = array(
                        'clave' => 'OK',
                        'mensaje' => 'Reporte enviado correctamente.'
                    );
                } else {
                    $json[] = array(
                        'clave' => 'ERROR',
                        'mensaje' => 'no pudo ser modificad.',
                    );
                }
            } else {
                $json[] = array(
                    'clave' => 'ERROR',
                    'mensaje' => 'Error : ' . $conn->error,
                );
            }
        } else {
            $json[] = array(
                'clave' => 'ERROR',
                'mensaje' => 'El status no pudo ser modificado (posiblemente no se encontró el alumno).',
            );
        }
    } else {
        $json[] = array(
            'clave' => 'ERROR',
            'mensaje' => 'Error al modificar el status: ' . $conn->error,
        );
    }

} else {
    $json[] = array(
        'clave' => 'ERROR',
        'mensaje' => 'Error al enviar el reporte: ' . $conn->error
    );
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($json);
exit();
?>