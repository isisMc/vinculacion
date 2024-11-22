<?php
session_start();
session_unset();
session_destroy();

// Redireccionar al login después de cerrar la sesión
header('Location: ../pages/login.php');
exit();
