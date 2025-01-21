<?php
session_start();
$nodefined = "";
if (!isset($_SESSION['usr_log'])) {
    $nodefined = "La sesión no está definida.";
    exit();
} else {
    $usuario = explode("|", $_SESSION['usr_log']);
    $idAlumno = $usuario[0];
    $img = $usuario[1]; // Ruta de la imagen del alumno desde la sesión
    $nombres = $usuario[2];
    $paterno = $usuario[3];
    $materno = $usuario[4];
    $direccion = $usuario[5];
    $noint = $usuario[6];
    $noext = $usuario[7];
    $cp = $usuario[8];
    $colonia = $usuario[9];
    $estado = $usuario[10];
    $municipio = $usuario[11];
    $telefono = $usuario[12];
    $sexo = $usuario[13];
    $especialidad = $usuario[14];
    $semestre = $usuario[15];
    $grupo = $usuario[16];
    $generacion = $usuario[17];
    $noctrl = $usuario[18];

    require("../../config/conexion/conexion.php");

    if ($conn->connect_error) {
        echo "Error: La conexión no se pudo establecer";
    } else {
        $sql = "SELECT * FROM datos_unicos WHERE idAlumno = '$idAlumno'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $idEmpresa = $row['idEmpresa'];
            $inicio = $row['inicio'];
            $termino = $row['termino'];
            $incentivo = $row['incentivo'];
            $departamento = $row['departamento'];
            $actividades = $row['actividades'];
            $horario = $row['hora_entrada'] . "-" . $row['hora_salida'];

            $sql_empresa = "SELECT * FROM empresas WHERE idEmpresa = '$idEmpresa'";
            $result_empresa = $conn->query($sql_empresa);

            if ($result_empresa->num_rows > 0) {
                $empresa = $result_empresa->fetch_assoc();
                $nombreEmpresa = $empresa['nombre_empresa'];
                $direccionE = $empresa['direccion'];
                $telefonoE = $empresa['telefono'];
                $cpE = $empresa['cp'];
                $rfc = "123";
                $jefe_inmediato = $empresa['jefe_inmediato'];
                $giroE = $empresa['giro'];
                $coloniaE = $empresa['colonia'];
                $correoE = $empresa['correo'];
                $puestoJ = $empresa['puesto'];
            }
        }
    }
}

use PhpOffice\PhpWord\TemplateProcessor;

require "vendor/autoload.php";

$templateProcessor = new PhpOffice\PhpWord\TemplateProcessor('plantillas/solicitud.docx');

$templateProcessor->setValues([
    'nombreCompleto' => $paterno . " " . $materno . " " . $nombres,
    'direccion' => $direccion . " " . $noint . " " . $noext . " " . $cp,
    'colonia' => $colonia,
    'estado' => $estado,
    'edad' => "17",
    'ciudad' => $municipio,
    'telefono' => $telefono,
    'sexo' => $sexo,
    'especialidad' => $especialidad,
    'semestre' => $semestre,
    'grupo' => $grupo,
    'noctrl' => $noctrl,
    'generacion' => $generacion,
    'inicio' => $inicio,
    'termino' => $termino,
    'nombreEmpresa' => $nombreEmpresa,
    'direccionEmpresa' => $direccionE,
    'telefonoEmpresa' => $telefonoE,
    'cpEmpresa' => $cpE,
    'rfcEmpresa' => $rfc,
    'jefeInmediato' => $jefe_inmediato,
    'giroEmpresa' => $giroE,
    'coloniaEmpresa' => $coloniaE,
    'correoEmpresa' => $correoE,
    'puestoJefe' => $puestoJ,
    'horario' => $horario,
    'actividades' => $actividades,
    'incentivo' => $incentivo,
    'departamento' => $departamento
]);

// Integración de la imagen
$rutaImagen = "../" . $img; // Ruta de la imagen del alumno
$templateProcessor->setImageValue('imagen', [
    'path' => $rutaImagen,
    'width' => 150, // Ancho de la imagen en píxeles
    'height' => 150, // Alto de la imagen en píxeles
    'ratio' => true // Mantener la proporción
]);

// Guardar el documento rellenado
$pathToSave = 'solicitud.docx';
$templateProcessor->saveAs($pathToSave);

// Forzar la descarga del archivo generado
header('Content-Description: File Transfer');
header('Content-Disposition: attachment; filename=solicitud.docx');
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');

readfile($pathToSave);
?>
