<?php   
    session_start();
        
    require_once("../../../../config/conexion/conexion.php");
    $json = array();
    if ($conn->connect_error) {
        $json[] = array(
            'clave' => 'ERROR',
            'mensaje' => 'Error: La conexión no se pudo establecer'
        );
    } else {
        if (isset($_POST['id_empresa']) && isset($_POST['idAlumno'])) {
            $idAlumno = $conn->real_escape_string($_POST['idAlumno']);
            $idEmpresa = $conn->real_escape_string($_POST['id_empresa']);
            $incentivo = $conn->real_escape_string($_POST['incentivo']);
            $departamento = $conn->real_escape_string($_POST['departamento']);
            $horarioInicio = $conn->real_escape_string($_POST['horarioInicio']);
            $horarioTermino = $conn->real_escape_string($_POST['horarioTermino']);
            $jefe_inmediato = $conn->real_escape_string($_POST['jefe_inmediato']);
            $giro = $conn->real_escape_string($_POST['giro']);
            $inicio = $conn->real_escape_string($_POST['inicio']);
            $termino = $conn->real_escape_string($_POST['termino']);
            $actividades  = $conn->real_escape_string($_POST['actividades']);
    
            $sql_verificar_existencia = "SELECT * FROM datos_unicos WHERE idAlumno = '$idAlumno'";
            
            if ($resultado = $conn->query($sql_verificar_existencia)) {
                if ($resultado->num_rows === 0) {
                    $sql_insertar_datos = 'INSERT INTO datos_unicos (idAlumno , idEmpresa, incentivo, departamento, hora_entrada, hora_salida, jefe_inmediato,  giro, inicio, termino, actividades) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
                    $stmt = $conn->prepare($sql_insertar_datos);
                    $stmt->bind_param("sssssssssss", $idAlumno , $idEmpresa, $incentivo, $departamento, $horarioInicio, $horarioTermino, $jefe_inmediato, $giro, $inicio, $termino, $actividades);

                    if ($stmt->execute()) {
                        if ($stmt->affected_rows > 0) {
                            $json[] = array(
                                'clave' => 'OK',
                                'mensaje' => 'Datos ingresados correctamente'
                            );
                            $_SESSION['status_NUMBER'] = 1;  
                        } else {
                            $json[] = array(
                                'clave' => 'ERROR',
                                'mensaje' => 'Error al intentar insertar sus datos'
                            );
                        }
                    } else {
                        $json[] = array(
                            'clave' => 'ERROR',
                            'mensaje' => 'No se ha podido realizar la consulta para insertar su solicitud.'
                        );
                    }
                    
                } else {
                    $sql_actualizar_datos = 'UPDATE datos_unicos SET idEmpresa = ?, incentivo = ?, departamento = ?, hora_entrada = ?, hora_salida = ?, jefe_inmediato = ?, giro = ?, inicio = ?, termino = ?, actividades = ? WHERE idAlumno = ?';
                    $stmt = $conn->prepare($sql_actualizar_datos);
                    $stmt->bind_param("sssssssssss", $idEmpresa, $incentivo, $departamento, $horarioInicio, $horarioTermino, $jefe_inmediato, $giro, $inicio, $termino, $actividades, $idAlumno);  
                
                    if ($stmt->execute()) {
                        if ($stmt->affected_rows > 0) {
                            $json[] = array(
                                'clave' => 'OK',
                                'mensaje' => 'Datos modificados correctamente'
                            );
                            $_SESSION['status_NUMBER'] = 1;
                        } else {
                            $json[] = array(
                                'clave' => 'ERROR',
                                'mensaje' => 'Error al intentar actualizar sus datos'
                            );
                        }
                    } else {
                        $json[] = array(
                            'clave' => 'ERROR',
                            'mensaje' => 'No se pudo realizar la consulta para actualizar sus datos.'
                        );
                    }
                } 
            } else{
                $json[] = array(
                    'clave' => 'ERROR',
                    'mensaje' => 'Error de consulta de verificar'
                );
            }
        } else {
            $json[] = array(
                'clave' => 'ERROR',
                'mensaje' => 'Error: Los datos no fueron recibidos correctamente'
            );
        }
    }

    header('Content-Type: application/json');
    echo json_encode($json);

    $conn->close();