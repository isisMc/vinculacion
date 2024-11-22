<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administracion</title>

  <link rel="shortcut icon" href="dist/img/logotipo.png" type="image/x-icon">

  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
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
        <!-- Numero de notificaciones -->
        <a href="index.html" id="a_numNoti" class="nav-link">
          <i class="far fa-bell"></i>
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
            <a href="index.html" class="nav-link">
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
                <a href="_alumno.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tabla Alumnos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link active">
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
            <h1 class="m-0">Tabla Empresas</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
           <div class="col-lg-12">
            <div class="table-responsive max_heigth_table">
              <table class="table table-dark table-striped table-hover">
                  <thead class="text-center">
                      <tr>
                          <th scope="col"> <span>ID</span> </th>
                          <th scope="col"> <span>Nombre</span> </th>
                          <th scope="col"> <span>Dirección</span> </th>
                          <th scope="col"> <span>Colonia</span> </th>
                          <th scope="col"> <span>C.P.</span> </th>
                          <th scope="col"> <span>Telefono</span> </th>
                          <th scope="col"> <span>Jefe Inmediato</span> </th>
                          <th scope="col"> <span>Puesto</span> </th>
                          <th scope="col"> <span>Correo</span> </th>
                          <th scope="col"> <span>Tipo</span> </th>
                          <th scope="col"> <span>Giro</span> </th>  
                          <th scope="col"> </th>
                      </tr>
                  </thead>
                  
                  <tbody class="text-center" id="container_prin">
                    <?php 
                      require("../config/conexion/conexion.php");

                      $sql = "SELECT * FROM empresas";
    
                      if ($conectarMysql = $conn -> query($sql)) {
                        if (($conectarMysql -> num_rows) === 0) {  
                          echo ('<td> No hay ninguna empresa registrada </td>');
                        } else {
                            while ($row = $conectarMysql -> fetch_array()) {
                              echo ('<tr>');
                                echo ('<td> '. $row['idEmpresa'] .' </td>');
                                echo ('<td> '. $row['nombre_empresa'] .' </td>');
                                echo ('<td> '. $row['direccion'] .' </td>');
                                echo ('<td> '. $row['colonia'] .' </td>');
                                echo ('<td> '. $row['cp'] .' </td>');
                                echo ('<td> '. $row['telefono'] .' </td>');
                                echo ('<td> '. $row['jefe_inmediato'] .' </td>');
                                echo ('<td> '. $row['puesto'] .' </td>');
                                echo ('<td> '. $row['correo'] .' </td>');
                                echo ('<td> '. $row['tipo'] .' </td>');
                                echo ('<td> '. $row['giro'] .' </td>');
                                echo ('
                                  <td>
                                    <button type="button" class="btn btn-danger border-0">
                                      <i class="fas fa-solid fa-eraser"></i>
                                    </button>
                                    <button type="button" class="btn btn-success border-0">
                                        <i class="fas fa-solid fa-edit"></i>
                                    </button>
                                  </td>
                                ');
                              echo ('</tr>');
                            }
                        }
                        $conectarMysql -> close();
                  
                          $conn->close();
                      } else {
                        echo ('<td> Error en la conexion a la base de datos </td>');
                      }
                    ?>
                  </tbody>
              </table>
            </div>
            <!-- Fin de donde se pondran las Tablas se pondra las tablas -->
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

  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="dist/js/adminlte.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="dist/personal/js/empresa.js"></script>
</body>
</html>
