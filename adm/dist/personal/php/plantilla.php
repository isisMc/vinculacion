<?php
session_start();
require_once("../../../../config/conexion/conexion.php");

// Obtener el ID enviado desde el frontend
$id = isset($_POST['id']) ? $_POST['id'] : null;

if (!$id) {
    echo json_encode([
        ['clave' => 'error', 'mensaje' => 'Error: ID no proporcionado']
    ]);
    exit;
}

// Escapar el valor de 'id' para evitar inyecciones SQL
$idAlumno = $conn->real_escape_string($id);

// Respuesta JSON
$json = [];

// Verificar conexión a la base de datos
if ($conn->connect_error) {
    $json[] = [
        'clave' => 'error',
        'mensaje' => 'Error: La conexión no se pudo establecer'
    ];
} else {
    // Consulta principal para obtener datos del alumno
    $sqlAlumno = "SELECT * FROM alumnos WHERE idAlumno = '$idAlumno'";
    $resultadoAlumno = $conn->query($sqlAlumno);

    if ($resultadoAlumno) {
        if ($resultadoAlumno->num_rows === 0) {
            $json[] = [
                'clave' => 'error',
                'mensaje' => 'Error: Alumno no encontrado'
            ];
        } else {
            // Datos del alumno
            $alumno = $resultadoAlumno->fetch_assoc();
            $json[] = [
                'clave' => 'ok',
                'img' => $alumno['img'],
                'fechaEnvio' => $alumno['fechaEnvio'],
                'nombres' => $alumno['nombres'],
                'paterno' => $alumno['paterno'],
                'materno' => $alumno['materno'],
                'direccion' => $alumno['direccion'],
                'noint' => $alumno['noint'],
                'noext' => $alumno['noext'],
                'cp' => $alumno['cp'],
                'colonia' => $alumno['colonia'],
                'estado' => $alumno['estado'],
                'municipio' => $alumno['municipio'],
                'telefono' => $alumno['telefono'],
                'sexo' => $alumno['sexo'],
                'especialidad' => $alumno['especialidad'],
                'semestre' => $alumno['semestre'],
                'grupo' => $alumno['grupo'],
                'generacion' => $alumno['generacion'],
                'noctrl' => $alumno['noctrl'],
                'curp' => $alumno['curp']
            ];

            $_SESSION['plantilla'] = implode('|', [
                $alumno['idAlumno'], $alumno['img'], $alumno['fechaEnvio'], $alumno['nombres'],
                $alumno['paterno'], $alumno['materno'], $alumno['direccion'], $alumno['noint'],
                $alumno['noext'], $alumno['cp'], $alumno['colonia'], $alumno['estado'],
                $alumno['municipio'], $alumno['telefono'], $alumno['sexo'], $alumno['especialidad'],
                $alumno['semestre'], $alumno['grupo'], $alumno['generacion'], $alumno['noctrl'],
                $alumno['curp']
            ]);

            // Datos únicos
            $sqlDatosUnicos = "SELECT * FROM datos_unicos WHERE idAlumno = '$idAlumno'";
            $resultadoDatosUnicos = $conn->query($sqlDatosUnicos);

            if ($resultadoDatosUnicos && $resultadoDatosUnicos->num_rows > 0) {
                $datosUnicos = $resultadoDatosUnicos->fetch_assoc();
                $json[] = [
                    'clave' => 'ok',
                    'idEmpresa' => $datosUnicos['idEmpresa'],
                    'horas' => $datosUnicos['horas'],
                    'incentivo' => $datosUnicos['incentivo'],
                    'departamento' => $datosUnicos['departamento'],
                    'hora_entrada' => $datosUnicos['hora_entrada'],
                    'hora_salida' => $datosUnicos['hora_salida'],
                    'jefe_inmediato' => $datosUnicos['jefe_inmediato'],
                    'giro' => $datosUnicos['giro'],
                    'inicio' => $datosUnicos['inicio'],
                    'termino' => $datosUnicos['termino'],
                    'actividades' => $datosUnicos['actividades']
                ];

                $_SESSION['dat_unicos'] = implode('|', [
                    $datosUnicos['idAlumno'], $datosUnicos['idEmpresa'], $datosUnicos['horas'],
                    $datosUnicos['incentivo'], $datosUnicos['departamento'], $datosUnicos['hora_entrada'],
                    $datosUnicos['hora_salida'], $datosUnicos['jefe_inmediato'], $datosUnicos['giro'],
                    $datosUnicos['inicio'], $datosUnicos['termino'], $datosUnicos['actividades']
                ]);

                // Datos de la empresa
                $idEmpresa = $datosUnicos['idEmpresa'];
                $sqlEmpresa = "SELECT * FROM empresas WHERE idEmpresa = '$idEmpresa'";
                $resultadoEmpresa = $conn->query($sqlEmpresa);

                if ($resultadoEmpresa && $resultadoEmpresa->num_rows > 0) {
                    $empresa = $resultadoEmpresa->fetch_assoc();
                    $json[] = [
                        'clave' => 'ok',
                        'nombre_empresa' => $empresa['nombre_empresa'],
                        'direccionEmp' => $empresa['direccion'],
                        'cpEmp' => $empresa['cp'],
                        'coloniaEmp' => $empresa['colonia'],
                        'telefonoEmp' => $empresa['telefono'],
                        'giroEmp' => $empresa['giro'],
                        'correoEmp' => $empresa['correo'],
                        'puesto' => $empresa['puesto'],
                        'tipo' => $empresa['tipo']
                    ];
                }
            }

            // Datos de reportes
            $sqlReportes = "SELECT * FROM admreportes WHERE idAlumno = '$idAlumno'";
            $resultadoReportes = $conn->query($sqlReportes);

            if ($resultadoReportes && $resultadoReportes->num_rows > 0) {
                $reporte = $resultadoReportes->fetch_assoc();
                $json[] = [
                    'clave' => 'ok',
                    'actividad1' => $reporte['actividad1'],
                    'fecha1' => $reporte['fecha1'],
                    'actividad2' => $reporte['actividad2'],
                    'fecha2' => $reporte['fecha2'],
                    'actividad3' => $reporte['actividad3'],
                    'fecha3' => $reporte['fecha3'],
                    'idReporteFinal' => $reporte['idReporteFinal'],
                    'fechaFinal' => $reporte['fechaFinal']
                ];
            }
            $sqlFinal = "SELECT * FROM reportefinal WHERE idAlumno = '$idAlumno'";
            $resultadoFinal = $conn->query($sqlFinal);
            if ($resultadoFinal && $resultadoFinal->num_rows > 0) {
                $final = $resultadoFinal->fetch_assoc();
                $json[] = [
                    'clave' => 'ok',
                    'actividades' => $final['actividades']
                ];
            }
        }
    } else {
        $json[] = [
            'clave' => 'error',
            'mensaje' => 'Error de consulta: ' . $conn->error
        ];
    }
}

// Configurar la cabecera y retornar la respuesta
header('Content-Type: application/json');
echo json_encode($json);

// Cerrar la conexión
$conn->close();
?>
