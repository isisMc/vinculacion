<?php
   session_start();

   $_SESSION['adm_log'] = 'ADM';

   require_once("../../../../config/conexion/conexion.php");
   $json = array();
   if ($conn->connect_error) {
      $json[] = array(
         'clave' => 'error',
         'mensaje' => 'Error: La conexión no se pudo establecer'
      );
   }else {
      if (isset($_POST['nombre']) && isset($_POST['password_admin'])) {
         $nombre = $conn->real_escape_string($_POST['nombre']);
         $pass = $conn->real_escape_string($_POST['password_admin']);
   
         $stmt = $conn->prepare("SELECT * FROM usuarios WHERE nombre = ? AND password = ?");
         $stmt->bind_param('ss',$nombre,$pass);

         if ($stmt->execute()) {
            
            $resultado = $stmt->get_result();

            if ($resultado->num_rows === 0) {
               $json[] = array(
                  'clave' => 'error',
                  'mensaje' => 'Error: Usuario no encontrado'
               );  
            } else {
               $row = $resultado->fetch_assoc();
               $json[] = array(
                  'clave' => 'ok',
                  'mensaje' => 'Inicio exitoso',
                  'nombre' => $row["apellido_pat"] . " " . $row["nombre"],
                  'img' => $row["img"]
               );  
            } 
         } else {
            $json[] = array(
               'clave' => 'error',
               'mensaje' => 'Error al momemto de hacer la consulta'
            );
         }
         
         $stmt->close();
   
      } else {
         $json[] = array(
            'clave' => 'error',
            'mensaje' => 'Error, Los datos no fueron recibidos correctamente'
         );
      }
   }

   header('Content-Type: application/json');
   echo json_encode($json);

   $conn->close();