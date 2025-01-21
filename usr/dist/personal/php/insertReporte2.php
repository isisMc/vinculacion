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
$fecha2 = $_POST['fecha2'];
$status = "1"; 
$sqlU = 'UPDATE admreportes SET actividad2 = ?, fecha2 = ? WHERE idAlumno = ?';
$stmt = $conn->prepare($sqlU);
$stmt->bind_param("ssi", $actividades, $fecha2 ,$idAlumno);

if ($stmt->execute()) {
    $sqlUpdate = 'UPDATE solicitudes SET status = ? WHERE idAlumno = ?';
    $stmt = $conn->prepare($sqlUpdate);
    $stmt->bind_param("is", $status, $idAlumno);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            $json[] = array(
                'clave' => 'OK',
                'mensaje' => 'Reporte enviado y status modificado correctamente.'
            );
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
exit;
?>
