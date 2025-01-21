<?php session_start(); ?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administracion</title>

  <link rel="shortcut icon" href="dist/img/logotipo.png" type="image/x-icon">

  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
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
      <li class="nav-item dropdown">
        <a href="index.php" id="a_numNoti" class="nav-link">
          <i class="fas fa-bell"></i>
          <span class="badge badge-warning navbar-badge" id="numNoti"></span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
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
          <img src="" class="img-circle elevation-2" alt="Imaen del Usuario" id="imgUser">
        </div>
        <div class="info">
          <span href="#" class="d-block" id="nameUser">nombre</span>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
           <li class="nav-item menu-open">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-solid fa-home"></i>
              <p>
                Inicio
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-solid fa-table"></i>
              <p>
                Tablas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tabla Alumnos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="_empresa.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tabla Empresas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="_usuarios.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tabla Usuarios</p>
                </a>
              </li>
            </ul>
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
            <h1 class="m-0">Tabla Alumnos</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- Espacio de Botones -->
          <div class="col-12 col-lg-10 my-2">

            <div class="row">
              <div class="col-12">
                <div class="row">
                  <span class="col-12">Estados:</span>
                  <div class="col-12 col-lg-2">
                    <button class="btn btn-dark py-2"></button>
                    <span class="">No hay cambios</span>
                  </div>
                  <div class="col-12 col-lg-3">
                    <button class="btn btn-light py-2"></button>
                    <span class="text-light">Envio Algo A revisar</span>
                  </div>
                  <div class="col-12 col-lg-2">
                    <button class="btn btn-warning py-2"></button>
                    <span class="text-warning">Solicitud Aceptada</span>
                  </div>
                  <div class="col-12 col-lg-2">
                    <button class="btn btn-danger py-2"></button>
                    <span class="">Solicitud Rechazada</span>
                  </div>
                  <div class="col-12 col-lg-3">
                    <button class="btn btn-success py-2"></button>
                    <span class="text-success">Practicas Finalizadas</span>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="col-12 col-lg-2 mb-2 text-right">
            <button class="btn btn-primary">
              <i class="fas fa-solid fa-download"></i>
            </button>
            <button class="btn btn-primary">
              <i class="fas fa-solid fa-plus"></i>
            </button>
          </div>
          <!-- Inicio Tablas -->
          <div class="col-lg-12">
            <div class="table-responsive max_width_table">
              <table class="table table-sm table-borderless border-top border-bottom border-dark">
                  <thead>
                      <tr>
                        <th scope="col"> <p class="text-primary text-center my-auto">GRUPOS</p> </th>
                      </tr>
                  </thead>        
                  <tbody id="container_grupos">            
                    <?php 
                      require("../config/conexion/conexion.php");
                      $sql = "SELECT grupo FROM alumnos ORDER BY grupo";
                      
                      if ($conectarMysql = $conn -> query($sql)) {
                        if (($conectarMysql -> num_rows) === 0) {  
                          echo ('
                            <tr>
                              <td> No hay ningun alumno registrado </td>
                            </tr>
                          ');
                        } else {
                          echo ('
                            <tr> 
                              <td class="row">
                          ');
                                while ($row = $conectarMysql -> fetch_array()) {
                                  echo ('<div class="col text-center"> <button class="btn btn-success py-0 btn_grupos" id="btn-' . $row['grupo'] . '">'. $row['grupo'] .'</button> </div>');
                                }
                          echo ('
                              </td> 
                            </tr>
                          ');
                        }
                        $conectarMysql -> close();
                      } else {
                        echo ('
                          <tr>
                            <td> Error en la conexion a la base de datos </td>
                          </tr>
                        ');
                      }
                      $conn->close();
                    ?>
                  </tbody>
              </table>
            </div>
            <div class="table-responsive max_width_table">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                          <th scope="col"> <span class=" text-danger">Id</span> </th>
                          <th scope="col"> <span>Img</span> </th>
                          <th scope="col"> <span>Nombre</span> </th>
                          <th scope="col"> <span>Empresa De Practicas</span> </th>
                          <th scope="col"> <span>Sexo</span> </th>
                          <th scope="col"> <span>Especialidad</span> </th>
                          <th scope="col"> <span>Semestre</span> </th>
                          <th scope="col"> <span>Generacion</span> </th>
                          <th scope="col"> <span>CURP</span> </th>
                          <th scope="col"> <span>NOCTRL</span> </th>
                          <th scope="col"> <span>Proceso Actual</span> </th>
                          <th scope="col"> <span></span> </th>
                        </tr>
                    </thead>
                    
                    <tbody id="container_prin">
                      <?php 
                        require("../config/conexion/conexion.php");

                        $grupo = isset($_SESSION['grupo'])?$_SESSION['grupo']:'A';

                        $sql = "SELECT a.*, s.status AS estatus, s.yaEntrego AS proceso, e.nombre_empresa AS empresa FROM alumnos a LEFT JOIN datos_unicos du ON du.idAlumno = a.idAlumno LEFT JOIN empresas e ON e.idEmpresa = du.idEmpresa LEFT JOIN solicitudes s ON a.idAlumno = s.idAlumno WHERE a.grupo = ?";
                        $stmt = $conn->prepare($sql);

                        if ($stmt) {
                          $stmt->bind_param('s', $grupo);
                          $stmt->execute();
                          $result = $stmt->get_result();

                          if ($result->num_rows === 0) {  
                              echo ('<tr><td colspan="6"> No hay ningún alumno registrado </td></tr>');
                          } else {
                              while ($row = $result->fetch_assoc()) {
                                $estatusValue = isset($row['estatus']) ? $row['estatus'] : 0;
                                $procesoValue = isset($row['proceso']) ? $row['proceso'] : 0;
                                $empresa = isset($row['empresa'])? $row['empresa'] : "No tiene";
                                $empresa = (obtenerProceso($procesoValue) == "Aun no empiza")? "*".$empresa."*" : $empresa;
                                echo
                                ('
                                  <tr class="' . colorSegunEstatus($estatusValue) . '">
                                    <td> ' . $row['idAlumno'] . ' </td>
                                    <td> 
                                      <img src="  ' . obtenerimagen($row['img']) . '" alt="Imagen de el o la Usuario o Usuaria." width="100px">
                                    </td>
                                    <td> ' . $row['paterno'] . "  " . $row['materno'] . " " . $row['nombres'] . ' </td>
                                    <td> ' . $empresa . ' </td>
                                    <td> ' . $row['sexo'] . ' </td>
                                    <td> ' . $row['especialidad'] . ' </td>
                                    <td> ' . $row['semestre'] . ' </td>
                                    <td> ' . $row['generacion'] . ' </td>
                                    <td> ' . $row['curp'] . ' </td>
                                    <td> ' . $row['noctrl'] . ' </td>
                                    <td> ' . obtenerProceso($procesoValue) . ' </td>
                                    <td> 
                                      <div class="row">
                                        <div class="col-12">
                                          <button type="button" class="btn btn-outline-danger m-1">
                                              <i class="fas fa-solid fa-eraser"></i>
                                          </button>
                                          <button type="button" class="btn btn-success m-1">
                                              <i class="fas fa-solid fa-edit"></i>
                                          </button>
                                        </div>
                                        <div class="col-12">
                                          <button type="button" class="btn btn-info m-1">
                                            <i class="fas fa-solid fa-image"></i>
                                          </button>
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                ');
                              }
                          }

                          $result->free();
                          $stmt->close();
                        } else {
                            echo ('<tr><td colspan="6"> Error en la consulta a la base de datos </td></tr>');
                        }

                        function obtenerProceso($proceso) {
                          $procesos = [
                              0 => "Aun no empiza",
                              1 => "Formulario",
                              2 => "Primer Reporte",
                              3 => "Segundo Reporte",
                              4 => "Tercer Reporte",
                              5 => "Reporte Final"
                          ];
                          return $procesos[$proceso] ?? "Error";
                        }

                        function colorSegunEstatus($status) {
                          $colores = [
                              0 => "bg-light",
                              1 => "bg-white",
                              2 => "bg-warning",
                              3 => "bg-danger",
                              4 => "bg-success"
                          ];
                          return $colores[$status] ?? "";
                        }

                        function obtenerimagen($img) {
                          
                          if ($img = "" || $img = " ") {
                            $img = "dist/img/noPhoto.png";
                          } else {
                            # code...
                          }
                          

                          return $img;
                        }

                        // Cerrar la conexión
                        $conn->close();
                      ?>
                    </tbody>
                </table>
              </div>
           </div>
        </div>
      </div>
    </div>
  </div>

  <aside class="control-sidebar control-sidebar-dark">
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>

  <script src="dist/personal/js/alumno.js"></script>
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="dist/js/adminlte.min.js"></script>
</body>
</html>
