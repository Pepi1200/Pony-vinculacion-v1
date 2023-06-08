<?php
include("connect.php");

if (isset($_POST['folio_empresa'])) {
    $folio_empresa = $_POST['folio_empresa'];

    $updateSql = "UPDATE empresa SET status = 3 WHERE folio = '$folio_empresa'";
    if ($conn->query($updateSql) === TRUE) {
        // Guardar el log de la operación de actualización
        $usuario = openssl_decrypt($_COOKIE['vinculacion'], 'AES-256-CBC', 'aeroespacial', 0, '0123456789abcdef');
        $fecha = date("Y-m-d H:i:s");
        $mensaje = "$fecha: $usuario actualizó el estado de la empresa (folio: $folio_empresa) a Rechazada.\n";
        
        // Guardar el mensaje de log
        error_log($mensaje, 3, "../log/empresa.log");
        echo '<script>alert("La empresa ha sido rechazada.");';
        echo 'window.location.href = "../empresas";</script>';
    } else {
        $mensaje = "Error al actualizar la empresa (folio: $folio_empresa): $error";
        error_log($mensaje, 3, "../log/empresa.log");
        echo '<script>alert("Error al actualizar la empresa:'. $conn->error.'.");';
        echo 'window.location.href = "../empresas";</script>';
    }
}

$conn->close();
?>