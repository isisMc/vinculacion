<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administracion</title>

  <link rel="shortcut icon" href="../usr/dist/img/logotipo.png" type="image/x-icon">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="../usr/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../usr/dist/css/adminlte.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../usr/dist/personal/css/style.css">
</head>
<body class="hold-transition sidebar-mini dark-mode">

    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake rounded" src="../usr/dist/img/logotipo.png" alt="logotipo del cetis 61" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link">
                <img src="../usr/dist/img/logotipo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3 "
                    style="opacity: .8">
                <span class="brand-text font-weight-light">SISRGPP</span>
            </a>

            <div class="sidebar">
              

              <!-- Sidebar Menu -->
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
                      <li class="nav-item menu-open">
                        
                          <a href="guess.php" class="nav-link">
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
                    <p class="h5"><i class="fas fa-exclamation-circle text-danger me-3"></i> Lo que se muestra es solo la plantilla de los datos que debe contener un formulario de solicitud, para ver tus datos reflejados inicia sesion.</p>
                </div>
                <!-- /.container-fluid -->
            </div>
            

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
                                        <img id="imagenSeleccionda" for="imagen" src="../usr/dist/img/usuarios/1.png" class="rounded-pill mb-3 foto_retrato" alt="Imagen por defecto">
                                             
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
                                            id="nombres" name="nombres" value=""
                                            disabled />
                                    </div>
                                    <div class="col-sm-6 col-lg-4">
                                        <label for="paterno" class="form-label">Apellido Paterno:</label>
                                        <input type="text" class="form-control rounded-pill mb-3"
                                            id="paterno" name="paterno" value=""
                                            disabled />
                                    </div>
                                    <div class="col-sm-6 col-lg-4">
                                        <label for="materno" class="form-label">Apellido Materno:</label>
                                        <input type="text" class="form-control rounded-pill mb-3"
                                            id="materno" name="materno" value=""
                                            disabled />

                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <label for="direccion" class="form-label">Direccion:</label>
                                        <input type="text" class="form-control rounded-pill" id="direccion"
                                            name="direccion" value="" disabled />

                                    </div>
                                    <div class="col-sm-4 col-lg-2">
                                        <label for="numext" class="form-label">No. exterior:</label>
                                        <input type="text" class="form-control rounded-pill" id="numext"border-top
                                            name="numext" maxlength="5" pattern="[0-9]{5}"
                                            value="" disabled />

                                    </div>
                                    <div class="col-sm-4 col-lg-2">
                                        <label for="numint" class="form-label">No. interior:</label>
                                        <input type="text" class="form-control rounded-pill" id="numint"
                                            name="numint" maxlength="5" pattern="[0-9]{5}"
                                            value="" disabled />

                                    </div>
                                    <div class="col-sm-4 col-lg-2">
                                        <label for="cp" class="form-label">C.P:</label>
                                        <input type="text" class="form-control rounded-pill" id="cp"
                                            name="cp" maxlength="6" pattern="[0-9]{6}"
                                            value="" disabled />

                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <label for="colonia" class="form-label">Colonia:</label>
                                        <input type="text" class="form-control rounded-pill" id="colonia"
                                            name="colonia" value="" disabled />

                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <label for="edo" class="form-label">Estado:</label>
                                        <input class="form-control rounded-pill mb-3" type="text" id="edo"
                                            name="edo" value="" disabled />

                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <label for="mun" class="form-label">Municipio:</label>
                                        <input class="form-control rounded-pill mb-3" type="text" id="mun"
                                            name="mun" value="" disabled />

                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <label for="telefono" class="form-label">Telefono:</label>
                                        <input class="form-control rounded-pill mb-3" type="tel"
                                            id="telefono" maxlength="10" name="telefono" pattern="[0-9]{10}"
                                            value="" disabled />

                                    </div>
                                    <div class="col-sm-12 col-lg-3">
                                        <label for="sexo" class="form-label">Sexo:</label>
                                        <input class="form-control rounded-pill mb-3" type="text" id="sexo"
                                            maxlength="2" name="sexo" pattern="[0-9]{10}"
                                            value="" disabled placeholder="M" />
                                    </div>
                                    <div class="col-12 my-2 text-center">
                                        <button id="btnSs" class="btn btn-outline-light px-2 py-1 border-0" style="color: #FF4500;" title="SIGUIENTE" type="button">
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
                                            name="especialidad" value=""
                                            disabled />
                                    </div>
                                    <div class="col-6 col-lg-4">
                                        <label for="semestre" class="form-label">Semestre:</label>
                                        <input class="form-control rounded-pill mb-3" type="text"
                                            id="semestre" name="semestre" value=""
                                            disabled />

                                    </div>
                                    <div class="col-6 col-lg-4">
                                        <label for="grupo" class="form-label">Grupo:</label>
                                        <input class="form-control rounded-pill mb-3" type="text" id="grupo"
                                            name="grupo" value="" disabled />

                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <label for="generacion" class="form-label">Generacion:</label>
                                        <input class="form-control rounded-pill mb-3" type="text"
                                            id="generacion" name="generacion"
                                            value="" disabled />

                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <label for="noctrl" class="form-label">No. ctrl:</label>
                                        <input type="text" class="form-control rounded-pill mb-3"
                                            id="noctrl" name="noctrl" maxlength="18" pattern="[0-9]{18}"
                                            value="" disabled />
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
                                    <button id="btn2" class="btn btn-outline-light px-2 py-1 border-0" style="color: #FF4500;" title="SIGUIENTE" type="button">
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
                                        <input type="text" class="form-control rounded-pill mb-3" id="idAlumno" name="idAlumno" value="" disabled />
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <label for="incentivo" class="form-label">Incentivo de $:</label>
                                        <input class="form-control rounded-pill mb-3" type="text" id="incentivo" name="incentivo" pattern="[$ ]*[0-9]+[\.0-9]{0,1}" placeholder="$0000" minlength="2" maxlength="6" disabled />
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <label for="departamento" class="form-label">Departamento:</label>
                                        <input class="form-control rounded-pill mb-3" type="text" id="departamento" name="departamento" pattern="[^\s][a-zA-ZáéíóúÁÉÍÓÚñÑ\s]*[\.]{0,1}" placeholder="Limpieza" minlength="3" maxlength="25" disabled /> 
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <label for="horarioInicio" class="form-label">Horario Inicio:</label>
                                                <input class="form-control rounded-pill mb-3" type="time" id="horarioInicio" name="horarioInicio" title="horarios permitidos de inicio (4:00 - 23:00)" min="04:00" max="23:00" disabled />
                                            </div>
                                            <div class="col-sm-12 col-md-6">    
                                                <label for="horarioInicio" class="form-label">Horario Termino:</label>
                                                <input class="form-control rounded-pill mb-3" type="time" id="horarioTermino" name="horarioTermino" title="horarios permitidos de conclusión (5:00 - 24:00)" min="05:00" max="24:00" disabled />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <label for="jefe_inmediato" class="form-label">Nombre del jefe inmediato:</label>
                                        <input type="text" class="form-control rounded-pill mb-3" id="jefe_inmediato" name="jefe_inmediato" pattern="[^\s][a-zA-ZáéíóúÁÉÍÓÚñÑ\s]*[\.]{0,1}" placeholder="Sam Puckett" minlength="3" maxlength="30" disabled />
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="giro" class="form-label">Giro:</label>
                                        <input type="text" class="form-control rounded-pill mb-3" id="giro" name="giro" placeholder="Educativo - Industrial - Comercial" pattern="[^\s][a-zA-ZáéíóúÁÉÍÓÚñÑ\s]*[\.]{0,1}" minlength="3" maxlength="10" disabled />
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <label for="inicio" class="form-label colorFondoDos">Inicio:</label>
                                        <input class="form-control rounded-pill mb-3" type="date" id="inicio" name="inicio" disabled /> 
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <label for="termino" class="form-label colorFondoDos">Termino:</label>
                                        <input class="form-control rounded-pill mb-3" type="date" id="termino" name="termino" disabled disabled/> 
                                    </div>
                                    <div class="col-12">
                                        <label for="actividades" class="form-label">Actividades:</label>
                                        <textarea name="actividades" id="actividades" rows="10" cols="40" class="form-control max_height_size_area rounded" disabled></textarea>
                                    </div>
                                </div>
                                <div class="col-12 my-2 text-center">
                                    <button id="volver3" class="btn btn-outline-light px-2 py-1 border-0" style="color: #FFD700;" title="ATRAS" type="button">
                                        <i class="fa-solid fa-circle-chevron-left fa-xl"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        

            <script src="solicitud.js"></script>
            <script src="../usr/plugins/jquery/jquery.min.js"></script>
            <script src="../usr/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="../usr/dist/js/adminlte.min.js"></script>
</body>
</html>