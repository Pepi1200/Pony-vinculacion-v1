<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pony-vinculacion";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
    //agregar pagina de error en base de datos
}
?>