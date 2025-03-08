<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invitado</title>
    <link rel="shortcut icon" href="../usr/dist/img/logotipo.png" type="image/x-icon">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../usr/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../usr/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini dark-mode">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake rounded" src="../usr/dist/img/logotipo.png" alt="logotipo del cetis 61" height="60"
                width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>

        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link">
                <img src="../usr/dist/img/logotipo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">SISRGPP</span>
            </a>

            <div class="sidebar">
                <!-- NUEVOS ENLACES DE INICIO DE SESIÓN -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item menu-open">
                            <a href="../usr/pages/personal/login.php" class="nav-link">
                                <i class="nav-icon fas fa-user-graduate"></i>
                                <p>Iniciar sesión como Estudiante</p>
                            </a>
                        </li>
                        <li class="nav-item menu-open">
                            <a href="login_admin.php" class="nav-link">
                                <i class="nav-icon fas fa-user-shield"></i>
                                <p>Iniciar sesión como Administrador</p>
                            </a>
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
                            <h1 class="m-0 font-weight-bolder text-center text-uppercase text-light">Prácticas
                                Profesionales</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="col-12 mb-4">
                                <h3 class="text-center font-weight-bolder text-light">Información De Las Prácticas
                                    Profesionales</h3>
                            </div>

                            <div class="row">
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

                                <div class="col-12 col-md-6 col-lg-3 mb-4">
                                    <div class="card h-100 shadow-sm border-0" style="background-color: #34495e;">
                                        <div class="card-body rounded">
                                            <h4 class="text-center text-light mb-3">Importancia</h4>
                                            <p style="color: #ecf0f1;">
                                                Las prácticas solo se pueden realizar
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

                                <div class="col-12 col-md-6 col-lg-3 mb-4">
                                    <div class="card h-100 shadow-sm border-0" style="background-color: #34495e;">
                                        <div class="card-body rounded">
                                            <h4 class="text-center text-light mb-3">Ejemplos de Lugares</h4>
                                            <ul class="list-group list-group-flush" style="color: #ecf0f1;">
                                                <li class="list-group-item" style="background-color: #34495e;"> <i
                                                        class="fas fa-store"></i> Tiendas
                                                </li>
                                                <li class="list-group-item" style="background-color: #34495e;"> <i
                                                        class="fas fa-school"></i> Primarias
                                                </li>
                                                <li class="list-group-item" style="background-color: #34495e;"> <i
                                                        class="fas fa-shopping-basket"></i>
                                                    Supermercados</li>
                                                <li class="list-group-item" style="background-color: #34495e;"> <i
                                                        class="fas fa-industry"></i>
                                                    Maquiladoras</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-4">
                                    <div class="card h-100 shadow-sm border-0" style="background-color: #34495e;">
                                        <div class="card-body rounded text-center">
                                            <h4 class="text-light mb-3">Solicitud</h4>
                                            <a href="_formulario.php" class="btn btn-primary btn-block">Ir a Solicitud</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card Primer Reporte -->
                                <div class="col-12 col-md-6 col-lg-3 mb-4">
                                    <div class="card h-100 shadow-sm border-0" style="background-color: #34495e;">
                                        <div class="card-body rounded text-center">
                                            <h4 class="text-light mb-3">Primer Reporte</h4>
                                            <a href="_reporte1.php" class="btn btn-primary btn-block">Ir al Reporte</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card Segundo Reporte -->
                                <div class="col-12 col-md-6 col-lg-3 mb-4">
                                    <div class="card h-100 shadow-sm border-0" style="background-color: #34495e;">
                                        <div class="card-body rounded text-center">
                                            <h4 class="text-light mb-3">Segundo Reporte</h4>
                                            <a href="_reporte2.php" class="btn btn-primary btn-block">Ir al Reporte</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card Tercer Reporte -->
                                <div class="col-12 col-md-6 col-lg-3 mb-4">
                                    <div class="card h-100 shadow-sm border-0" style="background-color: #34495e;">
                                        <div class="card-body rounded text-center">
                                            <h4 class="text-light mb-3">Tercer Reporte</h4>
                                            <a href="_reporte3.php" class="btn btn-primary btn-block">Ir al Reporte</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card Reporte Final -->
                                <div class="col-12 col-md-6 col-lg-3 mb-4">
                                    <div class="card h-100 shadow-sm border-0" style="background-color: #34495e;">
                                        <div class="card-body rounded text-center">
                                            <h4 class="text-light mb-3">Reporte Final</h4>
                                            <a href="_reporte_final.php" class="btn btn-primary btn-block">Ir al Reporte</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    <script src="../usr/dist/js/indexjs.js"></script>
    <script src="../usr/plugins/jquery/jquery.min.js"></script>
    <script src="../usr/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../usr/dist/js/adminlte.min.js"></script>
</body>

</html>
