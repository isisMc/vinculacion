<?php
    require ("../../../../config/conexion/conexion.php");
    $json = array();

    if ($conn->connect_error) {
        $json[] = array(
            'clave' => 'ERROR',
            'mensaje' => 'Error con la conexion a la base de datos.'
        );
    } else {
        $nombres = $conn -> real_escape_string($_POST['nombre']);
        $paterno = $conn -> real_escape_string($_POST['paterno']);
        $materno = $conn -> real_escape_string($_POST['materno']);
        $cargo = $conn -> real_escape_string($_POST['cargo']);
        $departamento = $conn -> real_escape_string($_POST['departamento']);
        $nivel_acceso = $conn -> real_escape_string($_POST['nivel_acceso']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        if ($cargo == "1") {
            $cargo = "Programar";
        } elseif ($cargo == "2") {
            $cargo = "Administrar";
        }

        if ($departamento == "1") {
            $departamento = "Vinculación";
        } elseif ($departamento == "2") {
            $departamento = "Control Escolar";
        } elseif ($departamento == "3") {
            $departamento = "Sala 2";
        }

        if ($nivel_acceso == "1") {
            $nivel_acceso = "30";
        } elseif ($nivel_acceso == "2") {
            $nivel_acceso = "60";
        } elseif ($nivel_acceso == "3") {
            $nivel_acceso = "100";
        }

        $sql = "INSERT INTO usuarios VALUES('','$nombres','$paterno','$materno','$nivel_acceso','$cargo','$departamento','$password')";

        if ($conectarMysql = $conn -> query($sql)) {
            $json[] = array(
                'clave' => 'OK',
                'mensaje' => 'Datos enviados correctamente.'
            );
        } else {
            $json[] = array(
                'clave' => 'ERROR',
                'mensaje' => 'Error: La solisitud tuvo un fallo.'
            );
        }

        $conn->close();
    } 

    header('Content-Type: application/json');
    echo (json_encode($json));
    exit;