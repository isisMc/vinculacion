<!DOCTYPE html>

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
        <a href="#" title="" id="a_numNoti" class="nav-link">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge" id="numNoti"></span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" title="expandir ventana" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" title="salir" id="salir">
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
      <span class="brand-text font-weight-light">SISRGPP</span>
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
          <div class="col-12">
            <h1 class="m-0">Administración</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 ">
            <div class="card d-none" id="card_noti">
              <div class="card-header border-0">
                <h3 class="card-title">Notificaciones</h3>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Alumno</th>
                    <th>Proceso A Revisar</th>
                    <th>Plantilla</th>
                    <th>Elección</th>
                  </tr>
                  </thead>
                  <tbody id="noti_container">
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-8">
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Porcentaje de alumnos que ya empezaron sus practicas</h3>
              </div>
              <div class="card-body table-responsive rounded-pill">
                <div class="progress" title="" id="barra">
                  <div class="progress-bar" title="" id="progress" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="dist/personal/js/app.js"></script>
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="dist/js/adminlte.min.js"></script>
  <script src="dist/personal/js/stadisticas.js"></script>
</body>
</html>
