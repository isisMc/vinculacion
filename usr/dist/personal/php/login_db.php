<?php
   session_start();

   $_SESSION['usr_log'] = 'USER';
   $_SESSION['status_update'] = 'STATUS';

   require_once("../../../../config/conexion/conexion.php");
   $json = array();
   if ($conn->connect_error) {
      $json[] = array(
         'clave' => 'error',
         'nombre' => 'Error: La conexión no se pudo establecer'
      );
   } else {
      if (isset($_POST['curp']) && isset($_POST['noctrl'])) {
         $curp = $conn->real_escape_string($_POST['curp']);
         $noctrl = $conn->real_escape_string($_POST['noctrl']);
   
         $sql = "SELECT * FROM alumnos WHERE curp = '$curp' AND noctrl = '$noctrl'";
         
         if ($resultado = $conn->query($sql)) {
            if ($resultado->num_rows === 0) {
               $json[] = array(
                  'clave' => 'error',
                  'nombre' => 'Error: Usuario no encontrado'
               );  
            } else {

               $row = $resultado->fetch_array();
               $json[] = array(
                  'clave' => 'ok',
                  'img' => $row['img'],
                  'nombres' => $row['nombres'],
                  'paterno' => $row['paterno'],
                  'materno' => $row['materno'],
                  'direccion' => $row['direccion'],
                  'noint' => $row['noint'],
                  'noext' => $row['noext'],
                  'cp' => $row['cp'],
                  'colonia' => $row['colonia'],
                  'estado' => $row['estado'],
                  'municipio' => $row['municipio'],
                  'telefono' => $row['telefono'],
                  'sexo' => $row['sexo'],
                  'especialidad' => $row['especialidad'],
                  'semestre' => $row['semestre'],
                  'grupo' => $row['grupo'],
                  'generacion' => $row['generacion'],
                  'noctrl' => $row['noctrl'],
                  'curp' => $row['curp']
               );  
               $_SESSION['usr_log'] = $row['idAlumno']. "|". $row['img']. "|".$row['nombres']. "|".$row['paterno']. "|".$row['materno']. "|".$row['direccion']. "|".$row['noint']. "|".$row['noext']. "|".$row['cp']. "|".$row['colonia']
               . "|".$row['estado']. "|".$row['municipio']. "|".$row['telefono']. "|".$row['sexo']. "|".$row['especialidad']. "|".$row['semestre']. "|".$row['grupo']. "|".$row['generacion']
               . "|".$row['noctrl']. "|".$row['curp'];
   
               $id_alumno = $row['idAlumno'];

              $sql_2 = "SELECT * FROM solicitudes WHERE idAlumno = '$id_alumno'";
              $resultado_2 = $conn->query($sql_2);
              if ($resultado_2 && $resultado_2->num_rows > 0) {
                 $row_2 = $resultado_2->fetch_array();
                 $_SESSION['usr_estatus'] = $row_2['yaEntrego'];
                 $_SESSION['status_actual'] = $row_2['status'];
              } else {
                  $sql_insert = "INSERT INTO solicitudes (idAlumno, status, yaEntrego) VALUES ('$id_alumno', 0, 0)";
                  
                  if ($conn->query($sql_insert) === TRUE) {
                     // Si la inserción es exitosa, establecemos el estatus
                     $_SESSION['usr_estatus'] = 0;
                     $_SESSION['status_actual'] = 0;
                  } else {
                     $json[] = array(
                        'clave' => 'error',
                        'nombre' => 'Error al insertar en solicitudes: ' . $conn->error
                     );
                  }
               }
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