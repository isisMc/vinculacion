<?php
 require_once("../../../../config/conexion/conexion.php");
 if ($conn->connect_error) {
    echo json_encode(array(
        'clave' => 'ERROR',
        'mensaje' => 'Error: La conexión no se pudo establecer'
    ));
    exit();
}

$idAlumno = $_POST['idAlumno']; 
$actividad1 = $_POST['actividad1'];

$sql = "INSERT INTO admreportes (idAlumno, actividad1)
        VALUES ('$idAlumno', '$actividad1')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(array(
        'clave' => 'ok',
        'mensaje' => 'Reporte enviado correctamente'
    ));
} else {
    echo json_encode(array(
        'clave' => 'ERROR',
        'mensaje' => 'Error al enviar el reporte: ' . $conn->error
    ));
}

$conn->close();
?>
