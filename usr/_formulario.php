<?php
    session_start();
    if(isset($_SESSION["status_actual"]) && isset($_SESSION["usr_estatus"])){
        if($_SESSION['status_actual'] !== 0  || $_SESSION["usr_estatus"] > 0){
             //header("location: index.php");
        }
      } else {
        header("location: index.php");
      }
    if (isset($_SESSION['usr_log'])) {
        set_error_handler(function($errno, $errstr, $errfile, $errline) {
            // error was suppressed with the @-operator
            if (0 === error_reporting()) {
                return false;
            }
            
            throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
        });
        try {
            $usuario = explode("|", $_SESSION['usr_log']);
            $idAlumno = $usuario[0];
            $img = $usuario[1];
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
            $curp = $usuario[19];
        } catch (Exception $e) {
            header("location:pages/personal/login.php");
        }
    } else {
        header("location:index.php");
    }
?>
<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administracion</title>

  <link rel="shortcut icon" href="dist/img/logotipo.png" type="image/x-icon">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="dist/personal/css/style.css">
</head>
<body class="hold-transition sidebar-mini dark-mode">

    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake rounded" src="dist/img/logotipo.png" alt="logotipo del cetis 61" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Derecha Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" id="salir">
                        <i class="fas fa-sign-out-alt fa-rotate-180"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link">
                <img src="dist/img/logotipo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3 "
                    style="opacity: .8">
                <span class="brand-text font-weight-light">Nombre Proyecto</span>
            </a>

            <div class="sidebar">
              <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="<?php
                        if (!empty($img)) {
                            echo htmlspecialchars($img);
                        } else {
                            echo "dist/img/usuarios/1.png";
                        }
                    ?>" class="img-circle elevation-2" alt="Imagen del Alumno" id="imgUser" width="150px" height="150px">
                </div>
                <div class="info">
                    <span href="#" class="d-block" id="nameUser"><?php echo ($nombres . " " . $paterno . " " . $materno) ?></span>
                </div>
              </div>

              <!-- Sidebar Menu -->
              <nav class="mt-2">
                  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                      data-accordion="false">
                      <li class="nav-item menu-open">
                          <a href="index.php" class="nav-link">
                            <i class="nav-icon fas fa-solid fa-house-user"></i>
                            <p>
                                Inicio
                            </p>
                          </a>
                      </li>
                  </ul>
              </nav>
              <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Solicitud de practicas</h1>
                        </div>
                    </div> <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="personal" name="personal" class="ms-3 needs-validation border-top border-bottom "disabled>
                                <div class="row mt-lg-4">
                                    <div class="col-12 my-2 d d-block d-lg-none">
                                        <h2 class="text-center fw-bold">Solicitud de practicas</h2>
                                        <h4 class="text-center">1.-Datos personales</h4>
                                    </div>
                                    <div class="col-sm-12 col-lg-3 mb-3 text-center">
                                        <div>
                                            <?php
                                                if (empty($img)) {
                                                    echo '<img id="imagenSeleccionda" for="imagen" src="dist/img/usuarios/1.png" class="rounded-pill mb-3 foto_retrato" alt="Imagen por defecto">';
                                                    echo '<button type="button" class="btn btn-info" id="openModal">Abrir Cámara</button>';
                                                } else {
                                                    echo '<img id="imagenSeleccionda" for="imagen" src="' . htmlspecialchars($img) . '" class="rounded-pill mb-3 foto_retrato" alt="Imagen actual">';
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-6 my-2 d d-none d-lg-block">
                                        <h2 class="text-center fw-bold">Solicitud de practicas</h2>
                                        <h4 id="title" class="text-center">1.-Datos personales</h4>
                                    </div>
                                    <div class="col-sm-12 col-lg -3 my-auto">
                                        <label for="fechaEnvio" class="form-label  my-auto">Fecha: </label>
                                        <input class="form-control rounded-pill px-0 px-0 text-center"
                                            type="date" id="fechaEnvio" name="fechaEnvio" disabled />
                                    </div>
                                    <div class="col-sm-6 col-lg-4">
                                        <label for="nombres" class="form-label">Nombre(s): </label>
                                        <input type="text" class="form-control rounded-pill mb-3"
                                            id="nombres" name="nombres" value="<?php echo $nombres; ?>"
                                            disabled />
                                    </div>
                                    <div class="col-sm-6 col-lg-4">
                                        <label for="paterno" class="form-label">Apellido Paterno:</label>
                                        <input type="text" class="form-control rounded-pill mb-3"
                                            id="paterno" name="paterno" value="<?php echo $paterno; ?>"
                                            disabled />
                                    </div>
                                    <div class="col-sm-6 col-lg-4">
                                        <label for="materno" class="form-label">Apellido Materno:</label>
                                        <input type="text" class="form-control rounded-pill mb-3"
                                            id="materno" name="materno" value="<?php echo $materno; ?>"
                                            disabled />

                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <label for="direccion" class="form-label">Direccion:</label>
                                        <input type="text" class="form-control rounded-pill" id="direccion"
                                            name="direccion" value="<?php echo $direccion; ?>" disabled />

                                    </div>
                                    <div class="col-sm-4 col-lg-2">
                                        <label for="numext" class="form-label">No. exterior:</label>
                                        <input type="text" class="form-control rounded-pill" id="numext"border-top
                                            name="numext" maxlength="5" pattern="[0-9]{5}"
                                            value="<?php echo $noext; ?>" disabled />

                                    </div>
                                    <div class="col-sm-4 col-lg-2">
                                        <label for="numint" class="form-label">No. interior:</label>
                                        <input type="text" class="form-control rounded-pill" id="numint"
                                            name="numint" maxlength="5" pattern="[0-9]{5}"
                                            value="<?php echo $noint; ?>" disabled />

                                    </div>
                                    <div class="col-sm-4 col-lg-2">
                                        <label for="cp" class="form-label">C.P:</label>
                                        <input type="text" class="form-control rounded-pill" id="cp"
                                            name="cp" maxlength="6" pattern="[0-9]{6}"
                                            value="<?php echo $cp; ?>" disabled />

                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <label for="colonia" class="form-label">Colonia:</label>
                                        <input type="text" class="form-control rounded-pill" id="colonia"
                                            name="colonia" value="<?php echo $colonia; ?>" disabled />

                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <label for="edo" class="form-label">Estado:</label>
                                        <input class="form-control rounded-pill mb-3" type="text" id="edo"
                                            name="edo" value="<?php echo $estado; ?>" disabled />

                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <label for="mun" class="form-label">Municipio:</label>
                                        <input class="form-control rounded-pill mb-3" type="text" id="mun"
                                            name="mun" value="<?php echo $municipio; ?>" disabled />

                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <label for="telefono" class="form-label">Telefono:</label>
                                        <input class="form-control rounded-pill mb-3" type="tel"
                                            id="telefono" maxlength="10" name="telefono" pattern="[0-9]{10}"
                                            value="<?php echo $telefono; ?>" disabled />

                                    </div>
                                    <div class="col-sm-12 col-lg-3">
                                        <label for="sexo" class="form-label">Sexo:</label>
                                        <input class="form-control rounded-pill mb-3" type="text" id="sexo"
                                            maxlength="2" name="sexo" pattern="[0-9]{10}"
                                            value="<?php echo $sexo; ?>" disabled placeholder="M" />
                                    </div>
                                    <div class="col-12 my-2 text-center">
                                        <button class="btn btn-outline-light px-2 py-1 border-0" style="color: #FFD700;" type="button" disabled>
                                            <i class="fa-solid fa-circle-chevron-left fa-xl"></i>
                                        </button>
                                        <button id="btn" class="btn btn-outline-light px-2 py-1 border-0" style="color: #FF4500;" title="SIGUIENTE" type="button">
                                            <i class="fa-solid fa-circle-chevron-right fa-xl"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <form id="formularioEsc" name="formularioEsc" class="hidden was-validated border-top border-bottom">
                                <div class="row mt-lg-4">
                                    <div class="col-12 my-2">
                                        <h4 id="title" class="text-center fw-bold">2.- Escolaridad</h4>
                                    </div>
                                    <div class="col-12 col-lg-8">
                                        <label for="especialidad" class="form-label">Especialidad:</label>
                                        <input class="form-control rounded-pill mb-3" id="especialidad"
                                            name="especialidad" value="<?php echo $especialidad; ?>"
                                            disabled />
                                    </div>
                                    <div class="col-6 col-lg-4">
                                        <label for="semestre" class="form-label">Semestre:</label>
                                        <input class="form-control rounded-pill mb-3" type="text"
                                            id="semestre" name="semestre" value="<?php echo $semestre; ?>"
                                            disabled />

                                    </div>
                                    <div class="col-6 col-lg-4">
                                        <label for="grupo" class="form-label">Grupo:</label>
                                        <input class="form-control rounded-pill mb-3" type="text" id="grupo"
                                            name="grupo" value="<?php echo $grupo; ?>" disabled />

                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <label for="generacion" class="form-label">Generacion:</label>
                                        <input class="form-control rounded-pill mb-3" type="text"
                                            id="generacion" name="generacion"
                                            value="<?php echo $generacion; ?>" disabled />

                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <label for="noctrl" class="form-label">No. ctrl:</label>
                                        <input type="text" class="form-control rounded-pill mb-3"
                                            id="noctrl" name="noctrl" maxlength="18" pattern="[0-9]{18}"
                                            value="<?php echo $noctrl; ?>" disabled />
                                    </div>
                                </div>
                                <div class="row mt-lg-4">
                                    <div class="col-12 mb-3">
                                        <h4 id="tit" class="text-center fw-bold">3.- Datos de la empresa
                                        </h4>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3 mb-3">
                                        <label for="empresa" class="form-label">Empresa:</label>
                                        <div class="input-group bg-dark rounded-pill" data-toggle="modal" data-target="#modalEmpresa">
                                            <input class="form-control bg-transparent border-0" type="text" id="empresa" name="empresa" disabled/>
                                            <span class="input-group-text bg-transparent border-0  text-white" id="btn-search">
                                                <i class="fa-solid fa-magnifying-glass search-empresa"></i>
                                            </span>
                                        </div>                            
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <label for="jefe" class="form-label">Jefe inmediato:</label>
                                        <input type="text" class="form-control rounded-pill mb-3" id="jefe"
                                            name="jefe" disabled />
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="direcEmpresa" class="form-label">Direccion:</label>
                                        <input class="form-control rounded-pill mb-3" type="text"
                                            id="direcEmpresa" name="direcEmpresa" disabled />
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <label for="correo" class="form-label">Correo:</label>
                                        <input class="form-control rounded-pill mb-3" type="text" id="correo"
                                            name="correo" disabled />

                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <label for="telefonoEmp" class="form-label">Telefono:</label>
                                        <input class="form-control rounded-pill mb-3" type="tel"
                                            id="telefonoEmp" maxlength="10" name="telefonoEmp"
                                            pattern="[0-9]{10}" disabled />
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <label for="cpEmp" class="form-label">C.P:</label>
                                        <input type="text" class="form-control rounded-pill" id="cpEmp"
                                            name="cpEmp" disabled />
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <label for="coloniaEmp" class="form-label">Colonia:</label>
                                        <input type="text" class="form-control rounded-pill" id="coloniaEmp"
                                            name="coloniaEmp" disabled />
                                    </div>
                                </div>
                                <div class="col-12 my-2 text-center">
                                    <button id="volver2" class="btn btn-outline-light px-2 py-1 border-0" style="color:#FFD700" title="ATRAS" type="button">
                                        <i class="fas fa-solid fa-circle-chevron-left fa-xl"></i>
                                    </button>
                                    <button id="btn2" class="btn btn-outline-light px-2 py-1 border-0" style="color: #FF4500;" title="SIGUIENTE" type="button" disabled>
                                        <i class="fas fa-solid fa-circle-chevron-right fa-xl"></i>
                                    </button>
                                </div>
                            </form>
                            <form id="formularioEmp" action="#" name="formularioEmp" class="hidden was-validated border-top border-bottom">
                                <div class="row mt-lg-4">
                                    <div class="col-12 my-3">
                                        <h4 id="tit" class="text-center fw-bold">
                                            4.- Datos de las Practicas.
                                        </h4>
                                    </div>
                                    <div class="col-sm-6 col-lg-4 hidden">
                                        <input type="text" class="form-control rounded-pill mb-3" id="idAlumno" name="idAlumno" value="<?php echo $idAlumno; ?>" required />
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <label for="incentivo" class="form-label">Incentivo de $:</label>
                                        <input class="form-control rounded-pill mb-3" type="text" id="incentivo" name="incentivo" pattern="[$ ]*[0-9]+[\.0-9]{0,1}" placeholder="$0000" minlength="2" maxlength="6" required />
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <label for="departamento" class="form-label">Departamento:</label>
                                        <input class="form-control rounded-pill mb-3" type="text" id="departamento" name="departamento" pattern="[^\s][a-zA-ZáéíóúÁÉÍÓÚñÑ\s]*[\.]{0,1}" placeholder="Limpieza" minlength="3" maxlength="25" required /> 
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <label for="horarioInicio" class="form-label">Horario Inicio:</label>
                                                <input class="form-control rounded-pill mb-3" type="time" id="horarioInicio" name="horarioInicio" title="horarios permitidos de inicio (4:00 - 23:00)" min="04:00" max="23:00" required />
                                            </div>
                                            <div class="col-sm-12 col-md-6">    
                                                <label for="horarioInicio" class="form-label">Horario Termino:</label>
                                                <input class="form-control rounded-pill mb-3" type="time" id="horarioTermino" name="horarioTermino" title="horarios permitidos de conclusión (5:00 - 24:00)" min="05:00" max="24:00" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <label for="jefe_inmediato" class="form-label">Nombre del jefe inmediato:</label>
                                        <input type="text" class="form-control rounded-pill mb-3" id="jefe_inmediato" name="jefe_inmediato" pattern="[^\s][a-zA-ZáéíóúÁÉÍÓÚñÑ\s]*[\.]{0,1}" placeholder="Sam Puckett" minlength="3" maxlength="30" required />
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="giro" class="form-label">Giro:</label>
                                        <input type="text" class="form-control rounded-pill mb-3" id="giro" name="giro" placeholder="Educativo - Industrial - Comercial" pattern="[^\s][a-zA-ZáéíóúÁÉÍÓÚñÑ\s]*[\.]{0,1}" minlength="3" maxlength="10" required />
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <label for="inicio" class="form-label colorFondoDos">Inicio:</label>
                                        <input class="form-control rounded-pill mb-3" type="date" id="inicio" name="inicio" required /> 
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <label for="termino" class="form-label colorFondoDos">Termino:</label>
                                        <input class="form-control rounded-pill mb-3" type="date" id="termino" name="termino" disabled required/> 
                                    </div>
                                    <div class="col-12">
                                        <label for="actividades" class="form-label">Actividades:</label>
                                        <textarea name="actividades" id="actividades" rows="10" cols="40" class="form-control is-invalid max_height_size_area rounded" required></textarea>
                                    </div>
                                </div>
                                <div class="col-12 my-2 text-center">
                                    <button id="volver3" class="btn btn-outline-light px-2 py-1 border-0" style="color: #FFD700;" title="ATRAS" type="button">
                                        <i class="fa-solid fa-circle-chevron-left fa-xl"></i>
                                    </button>
                                    <button id="btn3" class="btn btn-outline-light px-2 py-1 border-0" style="color: #FF4500;" title="ENVIAR" type="submit">
                                        <i class="fa-solid fa-paper-plane"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /.content-wrapper -->
            <div class="modal fade" id="cameraModal"  data-backdrop="static" data-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-md-6 my-auto mx-auto">
                                        <video class=" my-auto mx-auto" autoplay="true" id="video"></video>
                                    </div>
                                    <div class="col-12 col-md-6 my-auto mx-auto">
                                        <canvas class=" my-auto mx-auto" id="foto"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-info" id="takeSnapshot">Tomar Foto</button>
                            <button class="btn btn-success" disabled id="takePicture">Guardar Foto</button>
                        </div>
                    </div>
                </div>
            </div> 

            <!-- Modal Estatico de Busqueda de Empresa -->
            <div class="modal fade" id="modalEmpresa" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="empresa_modal_aria" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="empresa_modal_aria">Busqueda de Empresa</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-light" id="modal_busqueda">
            
                            <input type="text" class="form-control" id="searchInput" placeholder="Escribe para buscar...">
                            
                            <ul style="display: none;" class="list-group" id="professionList">
                                <?php
                                    require("../config/conexion/conexion.php");

                                    $sql = "SELECT idEmpresa, nombre_empresa FROM empresas";
                                    $resultado = $conn->query($sql);

                                    if ($resultado->num_rows > 0) {
                                        while ($fila = $resultado->fetch_assoc()) {
                                            echo (
                                                    '<li class="list-group-item text-light">' 
                                                . 
                                                        '<span class="d-none">'
                                                            .
                                                            htmlspecialchars($fila['idEmpresa']) 
                                                            .
                                                        '</span>'
                                                . 
                                                        '<span>'
                                                            .
                                                            htmlspecialchars($fila['nombre_empresa']) 
                                                            .
                                                        '</span>'
                                                .
                                                        '<button type="button" class="close text-warning seleccionar-empresa">
                                                            <i class="fa-regular fa-circle-check seleccionar-empresa"></i>
                                                        </button>'
                                                .
                                                    "</li>"
                                            );
                                        }
                                    } else {
                                        echo '<li class="list-group-item text-light">No hay profesiones disponibles</li>';
                                    }

                                    $conn->close();
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FIN Modal Estatico de Busqueda de Empresa -->

            <script src="dist/personal/js/solicitud.js"></script>
            <script src="dist/personal/js/formulario.js"></script>
            <script src="plugins/jquery/jquery.min.js"></script>
            <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="dist/js/adminlte.min.js"></script>
</body>
</html>