<?php 
    require ('../../../../config/conexion/conexion.php');
    $json = array();
    
    if ($conn -> connect_error) {
        $json[] = array(
            'clave' => 'ERROR', 
            'mensaje' => 'ERROR de la conexion con la base de datos.'
        );
    }else{
        $id = $_POST['id'];
        $status = $_POST['status'];
        
        $stmt = $conn->prepare("UPDATE `vinculacion`.`solicitudes` SET `status`=? WHERE  `idAlumno`=?;");

        if (!$stmt) {
            $json[] = array(
                'clave' => 'ERROR',
                'mensaje' => 'Error al preparar la consulta.'
            );
            echo json_encode($json);
            exit;
        }

        $stmt->bind_param('ii',$status,$id);

        if ($stmt->execute()) {
            $json[] = array(
               'clave' => 'EXITO',
               'mensaje' => 'Se ha aceptado correctamente.'
            );
         } else {
            $json[] = array(
               'clave' => 'ERROR',
               'mensaje' => 'ERROR al momemto de hacer la consulta.'
            );
         }
         
         $stmt->close();
    }
    
    header('Content-Type: application/json');
    echo (json_encode($json));
    exit;    