<?php 
    require ('../../../../config/conexion/conexion.php');
    $json = array();
    
    if ($conn->connect_error) {
        $json[] = array(
            'clave' => 'ERROR', 
            'mensaje' => 'ERROR de la conexion con la base de datos.'
        );
    } else {
        $id = $_POST['id'];

        $soli = $conn->prepare("SELECT yaEntrego FROM solicitudes WHERE idAlumno = ?");
        $soli->bind_param('i', $id); 

        if (!$soli) {
            $json[] = array(
                'clave' => 'ERROR',
                'mensaje' => 'Error al preparar la consulta.'
            );
        } else {
            if ($soli->execute()) {
                $resultado = $soli->get_result();

                if ($resultado->num_rows === 0) {
                    $json[] = array(
                        'clave' => 'error',
                        'mensaje' => 'Error: Usuario no encontrado'
                    );
                } else {
                    $row = $resultado->fetch_assoc();
                    $nuevoValorYaEntrego = $row['yaEntrego'] + 1;

                    $stmt = $conn->prepare("UPDATE solicitudes SET status = 0, yaEntrego = " . $nuevoValorYaEntrego . " WHERE idAlumno = " . $id . ";");

                    if (!$stmt) {
                        $json[] = array(
                            'clave' => 'ERROR',
                            'mensaje' => 'Error al preparar la consulta.'
                        );
                    } else {
                        if ($stmt->execute()) {
                            $json[] = array(
                               'clave' => 'EXITO',
                               'mensaje' => 'Se ha actualizado el proceso exitosamente.'
                            );
                        } else {
                            $json[] = array(
                               'clave' => 'ERROR',
                               'mensaje' => 'ERROR al momento de hacer la consulta.'
                            );
                        }
                        $stmt->close();
                    }
                }
                $soli->close();
            } else {
                $json[] = array(
                   'clave' => 'ERROR',
                   'mensaje' => 'ERROR al momento de hacer la consulta.'
                );
            }
        }
    }

    header('Content-Type: application/json');
    echo json_encode($json);