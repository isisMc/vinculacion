   <?php
    // require ("conexion.php");
    // $json = array();

    // if ($conn->connect_error) {
    //     $json[] = array(
    //         'clave' => 'ERROR',
    //         'mensaje' => 'Conexion con la base de datos, erronia.'
    //     );
        
    //     header('Content-Type: application/json');
    //     echo (json_encode($json));
        
    //     exit;
    // }

    // $img = 'imagen';
    // $fechaEnvio = $_POST['fechaEnvio'];
    // $nombres = $_POST['nombres'];
    // $paterno = $_POST['paterno'];
    // $materno = $_POST['materno'];
    // $direccion = $_POST['direccion'];
    // $noint = $_POST['numint'];
    // $noext = $_POST['numext'];
    // $cp = $_POST['cp'];
    // $colonia = $_POST['colonia'];
    // $estado = $_POST['edo'];
    // $municipio = $_POST['mun'];
    // $telefono = $_POST['telefono'];
    // $sexo = $_POST['sexo'];
    // $fecha = $_POST['fecha'];

    // $especialidad = $_POST['especialidad'];
    // $semestre = $_POST['semestre'];
    // $grupo = $_POST['grupo'];
    // $generacion = $_POST['generacion'];
    // $noctrl = $_POST['noctrl'];
    // $empresa = $_POST['empresa'];
    // $rfc = $_POST['rfc'];
    // $direcEmpresa = $_POST['direcEmpresa'];
    // $jefe = $_POST['jefe'];
    // $telefonoEmp = $_POST['telefonoEmp'];
    // $giro = $_POST['giro'];
    // $cpEmpresa = $_POST['cpEmp'];
    // $coloniaEmp = $_POST['coloniaEmp'];
    // $fechaIni = $_POST['fechaIni'];
    // $fechaTerm = $_POST['fechaTerm'];

    // $incentivo = $_POST['incentivo'];
    // $departamento = $_POST['departamento'];
    // $horario = $_POST['horario'];
    // $puesJefe = $_POST['puesJefe'];
    // $act = $_POST['act'];
    
    // $soli = "0";
    // $sql= "INSERT INTO alumnos (img, fechaEnvio, nombres, paterno, materno, direccion, noint, noext, cp, colonia, estado, municipio, telefono, sexo, fechaNac, especialidad, semestre, grupo, generacion, noctrl, empresa, rfc, direcEmpresa, jefe, telefonoEmp, giro, cpEmp, coloniaEmp, fechaIni, fechaTerm, incentivo, departamento, horario, puesJefe, act, soliP) 
    // VALUES (?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    // $stmt = $conn->prepare($sql);
    // $stmt->bind_param("sssssssssssssssssssssssssssssssssssi",$img,$fechaEnvio, $nombres, $paterno, $materno, $direccion, $noint, $noext, $cp, $colonia, $estado,$municipio ,$telefono, $sexo, $fecha,
    // $especialidad,$semestre,$grupo,$generacion,$noctrl,$empresa,$rfc,$direcEmpresa,$jefe,$telefonoEmp,$giro,$cpEmpresa,$coloniaEmp,$fechaIni,$fechaTerm,
    // $incentivo,$departamento,$horario,$puesJefe,$act,$soli);

    // $stmt->execute();

    // $stmt->close();
    // $conn->close();

   
    
    // $json[] = array(
    //     'clave' => 'ok',
    //     'mensaje' => 'Datos enviados correctamente.'
    // );
    
    // header('Content-Type: application/json');
    // echo (json_encode($json));
    // exit;