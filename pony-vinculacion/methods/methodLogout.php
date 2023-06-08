<?php
// Eliminar las cookies activas
if (isset($_COOKIE['empresa'])) {
    unset($_COOKIE['empresa']);
    setcookie('empresa', '', time() - 2592000, '/');
}

if (isset($_COOKIE['vinculacion'])) {
    unset($_COOKIE['vinculacion']);
    setcookie('vinculacion', '', time() - 2592000, '/');

    unset($_COOKIE['carrera']);
    setcookie('carrera', '', time() - 2592000, '/');
}

if (isset($_COOKIE['alumno'])) {
    unset($_COOKIE['alumno']);
    setcookie('alumno', '', time() - 2592000, '/');
}

// Redireccionar a index.php
header("Location: ../index.php");
exit();
?>