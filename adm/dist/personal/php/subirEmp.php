<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['csv_file'])) {
    
    $uploadDir = __DIR__ . "/uploads/";

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $filePath = $uploadDir . basename($_FILES['csv_file']['name']);

    if (move_uploaded_file($_FILES['csv_file']['tmp_name'], $filePath)) {
        echo "Archivo subido correctamente.";
        require 'empresas.php'; 
        procesarCSV($filePath);
    } else {
        echo "Error al mover el archivo.";
    }
} else {
    echo "Error: No se recibió un archivo o la generación.";
}
?>
