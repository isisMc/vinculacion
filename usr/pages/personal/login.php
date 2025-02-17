<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>

    <link rel="shortcut icon" href="../../dist/img/logotipo.png" type="image/x-icon">

    <link rel="stylesheet" href="../../dist/css/login_style.css">
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

</head>
<body>
    
    <div class="container">
        <div class="curved-shaped"></div>
        <div class="form-box Login">
            <h2 class="txt">COMIENZA TU CAMINO PROFESIONAL</h2>
            <form id="form">
                <div class="input-box">
                    <input type="text" id="curp" name="curp" pattern="[A-Z]{4}[0-9]{6}([A-Z]{3, 4}[1-9]|[A-Z]{2}[1-9]{2})" minlength="18" maxlength="18" required>
                    <label for="">CURP</label>
                    <i class="fa fa-id-card"></i>
                </div>
                <div class="input-box">
                    <input type="text"  id="noctrl" name="noctrl" minlength="14" maxlength="14" pattern="[0-9]{14}"  required>
                    <label for="noctrl">NO.CTRL</label>
                    <i class="fa fa-hashtag"></i>
                </div>
                <div class="input-box">
                    <button class="btn text-light" type="submit">ACCEDER</button>
                </div>
                <div class="regi-link">
                    <p>Iniciar sesion como <a href="../../../adm/pages/personal/login.php" class="SignUpLink">Administrador</a></p>
                </div>
            </form>
        </div>
    </div>
    <div class="theme-switcher">
        <div class="toggle">
            <div class="circle"></div>
            <i class="fa fa-moon" id="dark-mode-icon"></i>
            <i class="fa fa-sun" id="light-mode-icon"></i>
        </div>
    </div>
    <!-- MODAL -->
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body d-flex align-items-center">
                    <div class="row">
                        <div class="col-5">
                            <img src="../../dist/img/notfound.jpg" class="rounded-pill mb-3" alt="Usuario no encontrado" style="width: 150px; height: 150px;">
                        </div>
                        <div class="col-7 my-auto">
                            <h3 class="modal-title text-danger" id="errorModalLabel">Error</h3>
                            <h4>Usuario no encontrado.</h4>
                        </div>
                        <div class="col-12 text-center">
                            <span>(Presione cualquier lugar afuera de la ventana para salir)</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- FIN MODAL -->

    <script src="../../dist/js/login_app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>