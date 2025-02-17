<?php
function procesarCSV($filePath) {
    require ('../../../../config/conexion/conexion.php');

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    if (!file_exists($filePath)) {
        die("Error: No se encontró el archivo CSV en la ruta: $filePath");
    }

    if (($handle = fopen($filePath, "r")) !== FALSE) {
        $headers = fgetcsv($handle, 1000, ",");
        $headers = array_map('strtolower', $headers); // Convierte encabezados a minúsculas

        
        // Obtener columnas de la base de datos
        $table_columns = [];
        $result = $conn->query("SHOW COLUMNS FROM empresas");
        while ($row = $result->fetch_assoc()) {
            $table_columns[] = strtolower($row['Field']);
        }

        // Coincidencias entre CSV y la base de datos
        $matched_columns = array_intersect($headers, $table_columns);
        if (empty($matched_columns)) {
            die("Error: Ningún encabezado del CSV coincide con las columnas de la base de datos.");
        }

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $values = array_combine($headers, $data);

            // Filtrar solo las columnas coincidentes
            $filtered_values = array_filter($values, function ($key) use ($matched_columns) {
                return in_array($key, $matched_columns);
            }, ARRAY_FILTER_USE_KEY);


            // Validar 'nombre_empresa'
            if (isset($filtered_values['nombre_empresa']) && !empty(trim($filtered_values['nombre_empresa']))) {
                $sql = "SELECT idEmpresa FROM empresas WHERE nombre_empresa = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $filtered_values['nombre_empresa']);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $idEmpresa = $result->fetch_assoc()['idEmpresa']; // Corregido: idEmpresa en singular
                    $update_fields = implode(", ", array_map(fn($key) => "$key = ?", array_keys($filtered_values)));
                    $sql = "UPDATE empresas SET $update_fields WHERE idEmpresa = ?";
                    $stmt = $conn->prepare($sql);
                    $params = array_values($filtered_values);
                    $params[] = $idEmpresa;
                    $stmt->bind_param(str_repeat("s", count($filtered_values)) . "i", ...$params);
                } else {
                    $columns = implode(", ", array_keys($filtered_values));
                    $placeholders = implode(", ", array_fill(0, count($filtered_values), "?"));
                    $sql = "INSERT INTO empresas ($columns) VALUES ($placeholders)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param(str_repeat("s", count($filtered_values)), ...array_values($filtered_values));
                }
                $stmt->execute();
            } 
        }
        fclose($handle);
        echo "Proceso completado correctamente.";
    } else {
        echo "Error al abrir el archivo.";
    }
    $conn->close();
}
?>
