<?php
require_once("../../../../config/conexion/conexion.php"); 
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['noctrl']) && isset($data['path'])) {
        $noctrl = $data['noctrl'];
        $path = $data['path'];

        $stmt = $conn->prepare("UPDATE alumnos SET img = ? WHERE noctrl = ?");
        $stmt->bind_param("ss", $path, $noctrl); 
        if ($stmt->execute()) {
            echo json_encode(['clave' => 'ok', 'mensaje' => 'Image path updated successfully']);
        } else {
            echo json_encode(['clave' => 'error', 'mensaje' => 'Failed to update image path: ' . $stmt->error]);
        }

        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(['clave' => 'error', 'mensaje' => 'Invalid input']);
    }
} else {
    echo json_encode(['clave' => 'error', 'mensaje' => 'Invalid request method']);
}
?>