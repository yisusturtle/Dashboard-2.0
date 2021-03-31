<?php
    session_start();
    session_destroy();
    session_abort();
    unset($_SESSION['email']);
    header('location: ../pages/login-register.html');
?>