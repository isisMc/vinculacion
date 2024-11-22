<?php 
    require ('../../../../config/conexion/conexion.php');
    $json = array();
    
    if ($conn -> connect_error) {
        $json[] = array(
            'clave' => 'ERROR', 
            'mensaje' => 'Error de la conexion con la base de datos.'
        );
    }else{
        $sql = "SELECT COUNT(a.idAlumno) AS total_alumnos, SUM(CASE WHEN s.yaEntrego >= 1 THEN 1 ELSE 0 END) AS alumnos_con_entrega FROM alumnos a LEFT JOIN solicitudes s ON a.idAlumno = s.idAlumno;";

        if ($conectarMysql = $conn -> query($sql)) {
            if (($conectarMysql -> num_rows) == 0) {
                $json[] = array(
                    'clave' => 'ERROR',
                    'mensaje' => 'No se encuentra nadie registrado.'
                );
            } else {
                while ($row = $conectarMysql -> fetch_array()) {

                    $json[] = array(
                        'clave' => 'OK',
                        'alumnos' => $row['total_alumnos'],
                        'procentaje' => $row['alumnos_con_entrega'],
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