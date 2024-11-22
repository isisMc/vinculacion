<?php 
    require ('../../../../config/conexion/conexion.php');
    header('Content-Type: application/json');
    $json = array();
    $id = intval(trim($_POST['id']));
    $tablas = $_POST['tablas'];
    $columnas = $_POST['columnas'];

    $tablas_permitidas = ['alumnos', 'usuarios', 'empresas'];
    $columnas_permitidas = ['idAlumno', 'idUsuario', 'idEmpresa'];

    if (!in_array($tablas, $tablas_permitidas) || !in_array($columnas, $columnas_permitidas)) {
        $json[] = array(
            'clave' => 'ERROR',
            'mensaje' => 'Tabla o columna no permitida.'
        );
        echo json_encode($json);
        exit;
    }
    
    if ($conn -> connect_error) {
        $json[] = array(
            'clave' => 'ERROR', 
            'mensaje' => 'Error de la conexion con la base de datos.' . $conn->connect_error
            ); 
        echo (json_encode($json));
        exit;
    }

    $SQL= "";

    switch ($tablas) {
        case 'alumnos':
            $SQL = "DELETE FROM alumnos WHERE idAlumno = ?";
            break;
        case 'usuarios':
            $SQL = "DELETE FROM usuarios WHERE idUsuario = ?"; 
            break;
        case 'empresas':
            $SQL = "DELETE FROM empresas WHERE idEmpresa = ?"; 
            break;
        default:
            $json[] = array(
                'clave' => 'ERROR',
                'mensaje' => 'Tabla no permitida.'
            );
            echo (json_encode($json));
            exit;
    }

    $stmt = $conn->prepare($SQL);

    if (!$stmt) {
        $json[] = array(
            'clave' => 'ERROR',
            'mensaje' => 'Error al preparar la consulta: ' . $conn->error
        );
        echo json_encode($json);
        exit;
    }

    if (!$stmt->bind_param('i', $id)) {
        $json[] = array(
            'clave' => 'ERROR',
            'mensaje' => 'Error al vincular el parámetro: ' . $stmt->error
        );
        echo json_encode($json);
        exit;
    }

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            $json[] = array(
                'clave' => 'OK',
                'mensaje' => 'Se ha eliminado correctamente.'
            );
        } else {
            $json[] = array(
                'clave' => 'ERROR',
                'mensaje' => 'No se ha podido eliminar el registro.'
            );
        }
    } else {
        $json[] = array(
            'clave' => 'ERROR',
            'mensaje' => 'No se ha podido realizar la solicitud.' . $stmt->error
        );
    }

    $stmt->close();
    $conn->close();    
    
    echo (json_encode($json));
    exit;