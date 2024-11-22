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
   } else {
      if (isset($_POST['idEmpresa'])) {
         $idEmpresa = $conn->real_escape_string($_POST['idEmpresa']);
   
         $sql = "SELECT * FROM empresas WHERE idEmpresa = '$idEmpresa'";
         
         if ($resultado = $conn->query($sql)) {
            if ($resultado->num_rows === 0) {
               $json[] = array(
                  'clave' => 'error',
                  'nombre' => 'Error: Empresa no encontrada'
               );  
            } else {
               $row = $resultado->fetch_array();
               $json[] = array(
                  'clave' => 'ok',
                  'correo' => $row['correo'],
                  'direccion' => $row['direccion'],
                  'jefe' => $row['jefe_inmediato'],
                  'telefono' => $row['telefono'],
                  'cp' => $row['cp'],
                  'colonia' => $row['colonia']
               );  
            } 
         } else{
            $json[] = array(
               'clave' => 'error',
               'nombre' => 'Error de consulta'
            );
         }
      } else {
         $json[] = array(
            'clave' => 'error',
            'nombre' => 'Error, Los datos no fueron recibidos correctamente'
         );
      }
   }

   header('Content-Type: application/json');
   echo json_encode($json);

   $conn->close();