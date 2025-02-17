<?php
function procesarCSV($filePath, $generacion, $semestre) {
    require ('../../../../config/conexion/conexion.php');

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    if (!file_exists($filePath)) {
        die("Error: No se encontró el archivo CSV en la ruta: $filePath");
    }

    if (($handle = fopen($filePath, "r")) !== FALSE) {
        $headers = fgetcsv($handle, 1000, ",");
        $headers = array_map('strtolower', $headers);

        $table_columns = [];
        $result = $conn->query("SHOW COLUMNS FROM alumnos");
        while ($row = $result->fetch_assoc()) {
            $table_columns[] = strtolower($row['Field']);
        }

        $matched_columns = array_intersect($headers, $table_columns);
        if (empty($matched_columns)) {
            die("Error: Ningún encabezado del CSV coincide con las columnas de la base de datos.");
        }

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $values = array_combine($headers, $data);
            $filtered_values = array_filter($values, fn($key) => in_array($key, $matched_columns), ARRAY_FILTER_USE_KEY);
            if (isset($filtered_values['semestre']) && strlen($filtered_values['semestre']) >= 2) {
                $filtered_values['grupo'] = $filtered_values['semestre'][1];
                $filtered_values['semestre'] = $semestre;
            }
            $filtered_values['generacion'] = $generacion; // Agregar la generación
             // Agregar la generación

           

            if (isset($filtered_values['curp']) && strlen($filtered_values['curp']) >= 11) {
                $sexo_char = $filtered_values['curp'][10];
                $filtered_values['sexo'] = ($sexo_char === 'H') ? 'M' : (($sexo_char === 'M') ? 'F' : null);
            }

            if (!empty($filtered_values['noctrl'])) {
                $sql = "SELECT idAlumno FROM alumnos WHERE noctrl = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $filtered_values['noctrl']);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $idAlumno = $result->fetch_assoc()['idAlumno'];
                    $update_fields = implode(", ", array_map(fn($key) => "$key = ?", array_keys($filtered_values)));
                    $sql = "UPDATE alumnos SET $update_fields WHERE idAlumno = ?";
                    $stmt = $conn->prepare($sql);
                    $params = array_values($filtered_values);
                    $params[] = $idAlumno;
                    $stmt->bind_param(str_repeat("s", count($filtered_values)) . "i", ...$params);
                } else {
                    $columns = implode(", ", array_keys($filtered_values));
                    $placeholders = implode(", ", array_fill(0, count($filtered_values), "?"));
                    $sql = "INSERT INTO alumnos ($columns) VALUES ($placeholders)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param(str_repeat("s", count($filtered_values)), ...array_values($filtered_values));
                }
                $stmt->execute();
            } else {
                echo "Error: El campo 'noctrl' está vacío en una fila del CSV.";
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
