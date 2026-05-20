<?php
    session_start();
    unset($_SESSION["admin"]);
    header("Location: ../login-admin.php");
    exit();
?>