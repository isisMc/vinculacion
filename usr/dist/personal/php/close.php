<?php
session_start();
session_unset();
session_destroy();

header('Location: vinculacion/usr/pages/personal/login.php');
exit();
