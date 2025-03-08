<?php 
    session_start();
    
    if (isset($_SESSION['usr_log'])) {
        header('location:usr/index.php');
    } else if (isset($_SESSION['adm_log'])) {
        header('location:adm/index.php');
    } else {
        header('location:guess/guess.php');
    }