<?php
session_start();
if(isset($_SESSION["status_actual"]) && isset($_SESSION["usr_estatus"])){
  if($_SESSION['status_actual'] == 1 || $_SESSION['status_actual'] == 2 || $_SESSION["usr_estatus"]!= 1){
       header("location: index.php");
  }
} else {
  header("location: index.php");
}
if (isset($_SESSION['usr_log'])) {
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
  $curp = $usuario[18];
require("../config/conexion/conexion.php");
  if ($conn->connect_error) {
      echo "Error: La conexión no se pudo establecer";
      
  }  else {
  $sql = "SELECT * FROM datos_unicos WHERE idAlumno = '$idAlumno'";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $idEmpresa = $row['idEmpresa'];
      $departamento = $row['departamento'];
      $inicio = $row['inicio'];
      $termino = $row['termino'];
       $sql_empresa = "SELECT * FROM empresas WHERE idEmpresa = '$idEmpresa'";  
        $result_empresa = $conn->query($sql_empresa);

        if ($result_empresa->num_rows > 0) {
            $empresa = $result_empresa->fetch_assoc();
            $nombreEmpresa = $empresa['nombre_empresa'];
            $direccion = $empresa['direccion'];
        }
  } else {
      echo "No se encontró un idEmpresa para el idAlumno: " . $idAlumno;
  }
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

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="dist/personal/css/style.css">
</head>

<body class="hold-transition sidebar-mini dark-mode">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake rounded" src="dist/img/logotipo.png" alt="logotipo del cetis 61" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand  navbar-dark">
      <!-- Left navbar links -->
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

      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <img src="dist/img/logotipo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3 " style="opacity: .8">
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
              ?>" class="img-circle elevation-2" alt="Imaen del Usuario" id="imgUser  ">
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
              <h1 class="m-0">Reporte mensual de practicas profesionales</h1>
            </div>
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">

            <!-- Inicio Tablas -->
            <div class="col-lg-12">
              <div class="container shadow-lg rounded justify-content-center border border-1 border-light">
                <div class="row max-height_size2">

                  <div class="col-12 my-2 d d-block d-lg-none">
                    <h2 class="text-center fw-bold">Reporte mensual #1</h2>
                  </div>

                  <div class="col-12 col-lg-12 ">
                    <form id="personal" name="personal" class="ms-3 needs-validation" novalidate disabled>
                      <div class="row mt-lg-4">
                        <div class="col-sm-12 col-lg-3 mb-3 text-center">
                        </div>
                        <div class="col-6 my-2 d d-none d-lg-block">
                          <h2 class="text-center fw-bold">Reporte mensual #1</h2>
                          <h4 id="title" class="text-center">1.-Datos personales</h4>
                        </div>
                        <div class="col-sm-12 col-lg-4">
                          <label for="fechaEnvio" class="form-label">Fecha envio: </label>
                          <input class="form-control rounded-pill px-0 px-0 text-center" type="date" id="fechaEnvio" name="fechaEnvio" disabled />
                        </div>
                        <div class="col-sm-12 col-lg-4">
                          <label for="nombres" class="form-label">Nombre Completo: </label>
                          <input type="text" class="form-control rounded-pill mb-3" id="nombres" name="nombres" value="<?php echo $nombres. " ". $paterno." ".$materno; ?>" disabled />
                        </div>
                        <div class="col-sm-6 col-lg-4">
                          <label for="noctrl" class="form-label">No. ctrl:</label>
                          <input type="text" class="form-control rounded-pill mb-3" id="noctrl" name="noctrl" maxlength="18" pattern="[0-9]{18}" value="<?php echo $noctrl; ?>" disabled />
                        </div>
                        <div class="col-sm-6 col-lg-4">
                          <label for="especialidad" class="form-label">Especialidad:</label>
                          <input class="form-control rounded-pill mb-3" id="especialidad" name="especialidad" value="<?php echo $especialidad; ?>" disabled />
                        </div>
                        <div class="col-sm-6 col-lg-4">
                          <label for="semestre" class="form-label">Semestre:</label>
                          <input class="form-control rounded-pill mb-3" type="text" id="semestre" name="semestre" value="<?php echo $semestre; ?>" disabled />

                        </div>
                        <div class="col-sm-6 col-lg-4">
                          <label for="grupo" class="form-label">Grupo:</label>
                          <input class="form-control rounded-pill mb-3" type="text" id="grupo" name="grupo" value="<?php echo $grupo; ?>" disabled />
                        </div>
                      </div>
                    </form>
                    <form id="formularioEsc" name="formularioEsc" class="needs-validation" novalidate>
                      <div class="row mt-lg-4">
                        <div class="col-12 mb-3">
                          <h4 id="tit" class="text-center fw-bold">2.- Datos de la empresa</h4>
                        </div>
                        <div class="col-sm-4 col-lg-6 hidden">
                          <label for="idAlumno" class="form-label">idAlumno:</label>
                          <input class="form-control rounded-pill mb-3" type="text" id="idAlumno" name="idAlumno" value="<?php echo $idAlumno ?>" disabled />
                        </div>
                        <div class="col-sm-12 col-lg-6">
                          <label for="empresa" class="form-label">Empresa:</label>
                          <input class="form-control rounded-pill mb-3" type="text" id="empresa" name="empresa" value="<?php echo $nombreEmpresa ?>" disabled />
                        </div>
                        <div class="col-sm-6 col-lg-6">
                          <label for="direcEmpresa" class="form-label">Direccion:</label>
                          <input class="form-control rounded-pill mb-3" type="text" id="direcEmpresa" name="direcEmpresa" value="<?php echo $direccion ?>" disabled />
                        </div>
                        <div class="col-sm-6 col-lg-12">
                          <label for="area" class="form-label">Area donde realizara sus practicas profesionales:</label>
                          <input type="text" class="form-control rounded-pill mb-3" id="area" name="area" value="<?php echo $departamento ?>" disabled/>
                        </div>
                        <div class="col-sm-6 col-lg-6">
                          <label for="inicio" class="form-label colorFondoDos">Inicio:</label>
                          <input class="form-control rounded-pill mb-3" type="date" id="inicio" name="inicio" value="<?php echo $inicio ?>" disabled/>
                        </div>
                        <div class="col-sm-6 col-lg-6">
                          <label for="termino" class="form-label colorFondoDos">Termino:</label>
                          <input class="form-control rounded-pill mb-3" type="date" id="termino" name="termino" value="<?php echo $termino ?>" disabled/>

                        </div>
                        <div class="col-12">
                          <label for="actividades" class="form-label">Actividades:</label>
                          <textarea name="actividades" id="actividades" rows="10" cols="40" class="form-control max_height_size_area rounded"></textarea>
                        </div>
                      <div class="col-12 my-2 text-center">
                        <button class="btn btn-outline-light px-2 py-1 border-0 me-2 ms-2" style="color: #32CD32"; title="BORRA DATOS" type="reset">
                        <i class="fa-solid fa-trash"></i>
                        </button>
                        <button class="btn btn-outline-light px-2 py-1 border-0 ms-2" style="color: #FF4500;" title="ENVIAR" type="submit" id="btn">
                          Enviar<i class="fa-solid fa-paper-plane"></i>
                        </button>
                      </div>
                    </form>
                    
                  </div>
                </div>
              </div>
            </div>
            <!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
          <h5>Title</h5>
          <p>Sidebar content</p>
        </div>
      </aside>

      <script src="dist/personal/js/reportes.js"></script>
      <script src="plugins/jquery/jquery.min.js"></script>
      <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="dist/js/adminlte.min.js"></script>
</body>

</html>