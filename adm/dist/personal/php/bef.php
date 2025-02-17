<?php
require_once("../../../../config/conexion/conexion.php");

$json = array();
$data = json_decode(file_get_contents('php://input'), true); // Obtener los datos JSON

if (isset($data['action']) && isset($data['idAlumno'])) {
    $action = $data['action'];
    $idAlumno = $data['idAlumno'];

    switch ($action) {
        case 'borrar':
            // Lógica para borrar el alumno
            $sql = "DELETE FROM alumnos WHERE idAlumno = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $idAlumno);
            if ($stmt->execute()) {
                $json[] = array('clave' => 'OK', 'mensaje' => 'Alumno borrado correctamente.');
            } else {
                $json[] = array('clave' => 'ERROR', 'mensaje' => 'Error al borrar el alumno.');
            }
            break;

        case 'editar':
            $sql = "SELECT img, nombres, paterno, materno, direccion, noint, noext, cp, colonia, estado, municipio, telefono, sexo, especialidad, semestre, grupo, generacion, curp, noctrl FROM alumnos WHERE idAlumno = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $idAlumno);
            $stmt->execute();
            
            if ($stmt->execute()) {
                $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $json[] = array('clave' => 'OK', 'mensaje' => 'Alumno encontrado.', 'alumno' => $row);
            
            } else {
                $json[] = array('clave' => 'ERROR', 'mensaje' => 'Error al editar el alumno.');
            }
            break;

        case 'foto':
            // Lógica para manejar la foto del alumno
            // Aquí deberías recibir el nuevo path de la imagen o el archivo
            $sql = "UPDATE alumnos SET img = ? WHERE idAlumno = ?";
            $stmt = $conn->prepare($sql);
            // $stmt->bind_param("si", $nuevoPath, $idAlumno); // Asegúrate de que los tipos sean correctos
            if ($stmt->execute()) {
                $json[] = array('clave' => 'OK', 'mensaje' => 'Foto actualizada correctamente.');
            } else {
                $json[] = array('clave' => 'ERROR', 'mensaje' => 'Error al actualizar la foto.');
            }
            break;

        default:
            $json[] = array('clave' => 'ERROR', 'mensaje' => 'Acción no válida.');
            break;
    }
} else {
    $json[] = array('clave' => 'ERROR', 'mensaje' => 'Datos incompletos.');
}

header('Content-Type: application/json');
echo json_encode($json);
$conn->close();
?>