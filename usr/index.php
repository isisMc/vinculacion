<?php
session_start();

$array_botones = array("d-none", "d-none", "d-none", "d-none", "d-none");
$grupo_button = array("d-none","d-none");

$estados_color = array("text-muted", "text-muted", "text-muted", "text-muted", "text-muted");
$estados_array = array("No Enviado", "No Enviado", "No Enviado", "No Enviado", "No Enviado");

if (isset($_SESSION['usr_log'])) {
  $usuario = explode("|", $_SESSION['usr_log']);
  $img = $usuario[1];
  $nombres = $usuario[2];
  $paterno = $usuario[3];
  $materno = $usuario[4];
}

if(isset($_SESSION['usr_estatus'])){
  $proceso_actual = $_SESSION['usr_estatus'];
  switch ($proceso_actual[0]) {
    case 0:
      $array_botones[0] = "";
      break;
    case 1:
      $array_botones[1] = "";
      break;
    case 2:
      $array_botones[2] = "";
      break;
    case 3:
      $array_botones[3] = "";
      break;
    case 4:
      $array_botones[4] = "";
      break;
    case 5:
      $estados_array[4] = "Entregado";
      break;
  }

  if($array_botones[0] == "")
    $grupo_button[0] = "";
  else 
    $grupo_button[1] = "";

  for ($i=0; $i < 5; $i++) { 
    if($array_botones[$i] == ""){
      $estados_color[$i] = "text-warning";
      $estados_array[$i] = "En Espera";
      ciclo($i);
    }
  }
}

function ciclo($numero) {
  global $estados_color, $estados_array;
  for ($j = $numero; $j > 0; $j--) {
      $estados_color[$j-1] = "text-success";
      $estados_array[$j-1] = "Entregado";
  }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administración de Prácticas</title>
    <link rel="shortcut icon" href="dist/img/logotipo.png" type="image/x-icon">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="dist/css/style.css">
</head>

<body class="hold-transition sidebar-mini dark-mode">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake rounded" src="dist/img/logotipo.png" alt="logotipo del cetis 61" height="60"
                width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a href="index.php" class="nav-link">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge" id="numNoti"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="nav-icon fas fa-solid fa-exclamation-triangle"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="salir">
                        <i class="fas fa-sign-out-alt fa-rotate-180"></i>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link">
                <img src="dist/img/logotipo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">Nombre Proyecto</span>
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?php echo !empty($img) ? htmlspecialchars($img) : 'dist/img/usuarios/1.png'; ?>"
                            class="img-circle elevation-2" alt="Imagen del Usuario" id="imgUser">
                    </div>
                    <div class="info">
                        <span href="#" class="d-block"
                            id="nameUser"><?php echo ($nombres . " " . $paterno . " " . $materno); ?></span>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item menu-open <?php echo($grupo_button[0]) ?>">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-book"></i>
                                <p>Formulario <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview <?php echo($array_botones[0]) ?>">
                                <li class="nav-item">
                                    <a href="_formulario.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Formulario</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item menu-open <?php echo($grupo_button[1]) ?>">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-file"></i>
                                <p>Reportes <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview <?php echo($array_botones[1]) ?>">
                                <li class="nav-item">
                                    <a href="_reporte1.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Primer Reporte</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview <?php echo($array_botones[2]) ?>">
                                <li class="nav-item">
                                    <a href="_reporte2.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Segundo Reporte</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview <?php echo($array_botones[3]) ?>">
                                <li class="nav-item">
                                    <a href="_reporte3.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tercer Reporte</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview <?php echo($array_botones[4]) ?>">
                                <li class="nav-item">
                                    <a href="_reporte_final.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Reporte Final</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-12">
                            <h1 class="m-0 font-weight-bolder text-center text-uppercase text-light">Practicas
                                Profesionales</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-12">
                            <div class="col-12 mb-4">
                                <h3 class="text-center font-weight-bolder text-light">Información De Las Practicas
                                    Profesionales</h3>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-3 mb-4">
                                    <div class="card text-center" style="background-color: #2c3e50; color: #ecf0f1;">
                                        <div class="card-header border-0">
                                            <h3 class="font-weight-bolder">ESTADOS DE LAS PRACTICAS</h3>
                                        </div>
                                        <div class="card-body table-responsive p-0">
                                            <table class="table table-striped table-valign-middle">
                                                <thead>
                                                    <tr>
                                                        <th>Proceso</th>
                                                        <th>Estado</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="proceso font-weight-bold">Formulario</td>
                                                        <td class="estado <?php echo($estados_color[0]) ?>">
                                                            <?php echo($estados_array[0]) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="proceso font-weight-bold">Primer Reporte</td>
                                                        <td class="estado <?php echo($estados_color[1]) ?>">
                                                            <?php echo($estados_array[1]) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="proceso font-weight-bold">Segundo Reporte</td>
                                                        <td class="estado <?php echo($estados_color[2]) ?>">
                                                            <?php echo($estados_array[2]) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="proceso font-weight-bold">Tercer Reporte</td>
                                                        <td class="estado <?php echo($estados_color[3]) ?>">
                                                            <?php echo($estados_array[3]) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="proceso font-weight-bold">Reporte Final</td>
                                                        <td class="estado <?php echo($estados_color[4]) ?>">
                                                            <?php echo($estados_array[4]) ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 col-lg-3 mb-4">
                                    <div class="card h-100 shadow-sm border-0" style="background-color: #34495e;">
                                        <div class="card-body rounded">
                                            <h4 class="text-center text-light mb-3">¿En qué consiste?</h4>
                                            <p style="color: #ecf0f1;">
                                                Siendo práctico, este proceso consiste en ir a una empresa (pública o
                                                privada) para ejercer los
                                                conocimientos de tu especialidad, mientras continúas con tus clases
                                                normales, con el fin de
                                                aumentar tus habilidades. Este proceso también puede llevarse a cabo
                                                mediante cursos ofrecidos
                                                por instituciones (aunque no siempre están disponibles).
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-5 col-lg-3 mb-4">
                                    <div class="card h-100 shadow-sm border-0" style="background-color: #34495e;">
                                        <div class="card-body rounded">
                                            <h4 class="text-center text-light mb-3">Importancia</h4>
                                            <p style="color: #ecf0f1;">
                                                Las practicas solo se pueden realizar
                                                en aquellos lugares donde realmente se pueda ejercer el área de tu
                                                especialidad.Realizar tus prácticas profesionales es elemental para tu
                                                formación académica, ya que reafirmas
                                                los conocimientos adquiridos en semestres pasados. Al realizarlas,
                                                retomas conceptos, métodos,
                                                temas y demás procesos necesarios para llevar a cabo una tarea dentro de
                                                una empresa.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-5 col-lg-3 mb-4">
                                    <div class="card h-100 shadow-sm border-0" style="background-color: #34495e;">
                                        <div class="card-body rounded">
                                            <h4 class="text-center text-light mb-3">Ejemplos de Lugares</h4>
                                            <ul class="list-group list-group-flush" style="color: #ecf0f1;">
                                                <li class="list-group-item" style="background-color: #34495e;"> <i class="fas fa-store"></i> Tiendas
                                                </li>
                                                <li class="list-group-item" style="background-color: #34495e;"> <i class="fas fa-school"></i> Primarias
                                                </li>
                                                <li class="list-group-item" style="background-color: #34495e;"> <i class="fas fa-shopping-basket"></i> 
                                                    Supermercados</li>
                                                <li class="list-group-item" style="background-color: #34495e;"> <i class="fas fa-industry"></i>
                                                    Maquiladoras</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Box de Horas Realizadas -->
                    <div class="col-12 col-lg-6">
                        <div class="info-box">
                            <!-- Icono de las horas con fondo más oscuro y texto claro -->
                            <span class="info-box-icon" style="background-color: #2c3e50;">
                                <i class="fas fa-clock" style="color: #ecf0f1;"></i>
                            </span>
                            <div class="info-box-content">
                                <!-- Texto de horas realizadas con color más neutro y sin resaltar demasiado -->
                                <span class="info-box-text text-light font-weight-bolder">Horas Realizadas <i class="far fa-clock"></i></span>
                                <!-- Número de horas con color más suave para armonizar con el diseño -->
                                <span class="info-box-number text-light">
                                    <span id="horas_realizadas" class="text-primary">0</span> de 240
                                </span>
                                <!-- Barra de progreso más discreta con colores oscuros -->
                                <div class="progress">
                                    <div class="progress-bar" style="background-color: #2980b9; width: 0%;"></div>
                                </div>
                                <!-- Descripción de porcentaje en tonos claros para que destaque sin ser agresivo -->
                                <span class="progress-description text-light">
                                    Porcentaje: <span class="text-primary" id="porcentaje_horas_realizadas">0%</span>
                                </span>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="dist/js/adminlte.min.js"></script>
</body>

</html>