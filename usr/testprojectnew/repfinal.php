<?php
session_start();
$nodefined= "";
if (!isset($_SESSION['usr_log'])) {
    $nodefined= "La sesión no está definida.";
    exit();
} else {
  $usuario = explode("|", $_SESSION['usr_log']);
  $idAlumno = $usuario[0];
  $nombres = $usuario[2];
  $paterno = $usuario[3];
  $materno = $usuario[4];
  $especialidad = $usuario[14];
  $semestre = $usuario[15];
  $grupo = $usuario[16];
  $noctrl = $usuario[18];
  require("../../config/conexion/conexion.php");
  if ($conn->connect_error) {
      echo "Error: La conexión no se pudo establecer";
      
  }  else {
  $sql = "SELECT * FROM datos_unicos WHERE idAlumno = '$idAlumno'";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $idEmpresa = $row['idEmpresa'];
      $inicio = date("d-m-Y", strtotime($row['inicio']));
      $termino = date("d-m-Y", strtotime($row['termino']));
      $departamento = $row['departamento']; 
       $sql_empresa = "SELECT * FROM empresas WHERE idEmpresa = '$idEmpresa'";  
        $result_empresa = $conn->query($sql_empresa);

        if ($result_empresa->num_rows > 0) {
            $empresa = $result_empresa->fetch_assoc();
            $nombreEmpresa = $empresa['nombre_empresa'];
            $direccionE = $empresa['direccion'];
            $sql_reportes = "SELECT idReporteFinal FROM admreportes WHERE idAlumno = '$idAlumno'";  
            $result_reportes = $conn->query($sql_reportes); 

            if($result_reportes->num_rows > 0){
                $reportes = $result_reportes->fetch_assoc();
                $idReporte = $reportes['idReporteFinal'];
                $sql_actividades = "SELECT actividades FROM reportefinal WHERE idReporteFinal = '$idReporte' AND idAlumno = '$idAlumno'";
                $result_actividades = $conn->query($sql_actividades);
                if($result_actividades->num_rows > 0){
                    $actividades = $result_actividades->fetch_assoc();
                    $actividades = $actividades['actividades'];
                }
            }

        }

  } 
}
}

use PhpOffice\PhpWord\TemplateProcessor;

require "vendor/autoload.php";

$templateProcessor =  new PhpOffice\PhpWord\TemplateProcessor('plantillas/reportefinal.docx');

$templateProcessor->setValues(
    ['nombreCompleto'=>$paterno ." ". $materno . " " . $nombres,
    'especialidad'=> $especialidad,
    'semestre'=> $semestre,
    'grupo'=> $grupo,
    'noctrl'=> $noctrl,
    'inicio'=> $inicio,
    'termino'=> $termino,
    'nombreEmpresa'=> $nombreEmpresa,
    'direccionEmpresa'=> $direccionE,
    'departamento'=> $departamento,
    'actividades'=> $actividades
]);

$pathToSave = 'reporteFinal.docx';
$templateProcessor->saveAs($pathToSave);

header('Content-Description: File Transfer');
header('Content-Disposition: attachment; filename=reporteFinal.docx');
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');

readfile($pathToSave);
?>