<?php
session_start();
if (isset($_SESSION['usr_log'])) {
    $usuario = explode("|", $_SESSION['usr_log']);
    $idAlumno = $usuario[0];
    $generacion = $usuario[17];
    $noctrl = $usuario[18];
}
require_once("../conexion/conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (isset($data['image'])) {
        $image = $data['image'];
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageData = base64_decode($image);

        if ($imageData === false) {
            echo json_encode(['success' => false, 'error' => 'Error al decodificar la imagen']);
            exit;
        }

        $fileName = $noctrl . '.png';
        $filePath = __DIR__ . '/../../img/generaciones/' . $generacion . '/' . $fileName; 

        if (!file_exists(dirname($filePath))) {
            mkdir(dirname($filePath), 0777, true); 
        }

        if (file_put_contents($filePath, $imageData)) {
            $relativePath = '../usr/dist/img/generaciones/' . $generacion . '/' . $fileName; 

            $datos_usuario = explode("|", $_SESSION['usr_log']);
            $datos_usuario[1] = $relativePath;
            $_SESSION['usr_log'] = implode('|', $datos_usuario);

            echo json_encode(['success' => true, 'imagePath' => $relativePath]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Error al guardar la imagen']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'No se recibió ninguna imagen']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
}