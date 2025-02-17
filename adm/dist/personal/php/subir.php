<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['csv_file']) && isset($_POST['generacion'])&& isset($_POST['semestre'])) {
    $generacion = trim($_POST['generacion']);
    $semestre = trim($_POST['semestre']);
    $uploadDir = __DIR__ . "/uploads/";

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $filePath = $uploadDir . basename($_FILES['csv_file']['name']);

    if (move_uploaded_file($_FILES['csv_file']['tmp_name'], $filePath)) {
        echo "Archivo subido correctamente.";
        require 'cargamasiva.php'; 
        procesarCSV($filePath, $generacion, $semestre);
    } else {
        echo "Error al mover el archivo.";
    }
} else {
    echo "Error: No se recibió un archivo o la generación.";
}
?>
