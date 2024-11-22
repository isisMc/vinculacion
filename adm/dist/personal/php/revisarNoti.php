<?php 
    require ('../../../../config/conexion/conexion.php');
    $json = array();
    
    if ($conn -> connect_error) {
        $json[] = array(
            'clave' => 'ERROR', 
            'mensaje' => 'Error de la conexion con la base de datos.'
        );
    }else{
        $sql = "SELECT s.*, a.nombres AS nombres, a.paterno AS paterno, a.materno AS materno FROM solicitudes s LEFT JOIN alumnos a ON a.idAlumno = s.idAlumno WHERE status = 1";

        if ($conectarMysql = $conn -> query($sql)) {
            if (($conectarMysql -> num_rows) == 0) {
                $json[] = array(
                    'clave' => 'NOTI',
                    'mensaje' => 'No hay Notificaciones'
                );
            } else {
                while ($row = $conectarMysql -> fetch_array()) {
                    if (isset($row['nombres']) && isset($row['paterno']) && isset($row['materno'])) {
                        $nombreAlumno = $row['nombres'] . " " . $row['paterno'] . "  " . $row['materno']; 
                    } else {
                        $nombreAlumno = "NOMBRE NO ENCONTRADO";
                    }

                    switch ($row['yaEntrego']) {
                        case 0:
                            $procesoRev = "Formulario";
                            break;
                        case 1:
                            $procesoRev = "Primer Reporte";
                            break;
                        case 2:
                            $procesoRev = "Segundo Reporte";
                            break;
                        case 3:
                            $procesoRev = "Tercer Reporte";
                            break;
                        case 4:
                            $procesoRev = "Reporte Final";
                            break;
                    }

                    $json[] = array(
                        'clave' => "EXITO",
                        'id' => $row['idAlumno'],
                        'nombre' => $nombreAlumno,
                        'proceso_a_revisar' => $procesoRev,
                        'mensaje' => 'Esperando Aprovación'
                    );
                }
            }
            $conectarMysql -> close();
    
            $conn->close();
        } else {
            $json[] = array(
                'clave' => 'ERROR',
                'mensaje' => 'No sea a podido realizar la solicitud.'
            );
        }
    }
    
    header('Content-Type: application/json');
    echo (json_encode($json));
    exit;