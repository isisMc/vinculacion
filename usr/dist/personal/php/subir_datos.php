<?php
session_start();

if (isset($_SESSION['usr_log'])) {
    $usuario = explode("|", $_SESSION['usr_log']);
    $idAlumno = $usuario[0];
} else {
    header('Location: ../../../index.php');
}

require_once("../../../../config/conexion/conexion.php");
$json = array();
if ($conn->connect_error) {
    $json[] = array(
        'clave' => 'error',
        'nombre' => 'Error: La conexión no se pudo establecer'
    );
    echo json_encode($json);
    exit;
}

// Verificar los datos recibidos

$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : null;
$numext = isset($_POST['numext']) ? $_POST['numext'] : null; 
$numint = isset($_POST['numint']) ? $_POST['numint'] : null;
$cp = isset($_POST['cp']) ? $_POST['cp'] : null;
$colonia = isset($_POST['colonia']) ? $_POST['colonia'] : null;
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : null;

// Crear un arreglo de datos
$datos = [
    'direccion' => $direccion,
    'noext' => $numext,
    'noint' => $numint,
    'cp' => $cp,
    'colonia' => $colonia,
    'telefono' => $telefono
];

// Filtrar los datos para obtener solo los que no son nulos o vacíos
$datosNoNulos = array_filter($datos, function($valor) {
    return $valor !== null && $valor !== ''; // Filtra valores null o vacíos
});

// Si hay datos no nulos, proceder a construir la consulta SQL
if (!empty($datosNoNulos)) {
    // Construir la parte de la consulta SQL
    $setClause = [];
    $values = [];

    foreach ($datosNoNulos as $campo => $valor) {
        $setClause[] = "$campo = ?";
        $values[] = $valor; // Agregar el valor correspondiente
    }

    // Unir los campos para la consulta
    $setClauseString = implode(", ", $setClause);
    
    // Preparar la consulta SQL
    $sql = "UPDATE alumnos SET $setClauseString WHERE idAlumno = ?";
    $stmt = $conn->prepare($sql);

    // Agregar el idAlumno al final de los valores
    $values[] = $idAlumno; // Asegúrate de que $idAlumno esté definido
    $types = str_repeat("s", count($datosNoNulos)) . "i"; // Cambia "s" por el tipo correspondiente si es necesario

    // Vincular los parámetros
    $stmt->bind_param($types, ...$values);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            $json[] = array(
                'clave' => 'OK',
                'mensaje' => 'Datos actualizados correctamente'
            );
        } else {
            $json[] = array(
                'clave' => 'ERROR',
                'mensaje' => 'No se realizaron cambios en los datos'
            );
        }
    } else {
        $json[] = array(
            'clave' => 'ERROR',
            'mensaje' => 'Error al intentar actualizar los datos: ' . $stmt->error // Mostrar el error
        );
    }
} else {
    $json[] = array(
        'clave' => 'ERROR',
        'mensaje' => 'Error: No hay datos para actualizar'
    );  
}

header('Content-Type: application/json');
echo json_encode($json);

$conn->close();
exit;