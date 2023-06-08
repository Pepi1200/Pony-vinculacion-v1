<?php
include("connect.php");

if (isset($_POST['folio_empresa'])) {
    $folio_empresa = $_POST['folio_empresa'];

    $updateSql = "UPDATE empresa SET status = 1 WHERE folio = '$folio_empresa'";
    if ($conn->query($updateSql) === TRUE) {
        echo '<script>alert("La empresa ha sido aceptada correctamente.");';
        echo 'window.location.href = "../empresas";</script>';
    } else {
        echo '<script>alert("Error al actualizar la empresa:'. $conn->error.'.");';
        echo 'window.location.href = "../empresas";</script>';
    }
}

$conn->close();
?>

<?php
include("connect.php");

if (isset($_POST['folio_empresa'])) {
    $folio_empresa = $_POST['folio_empresa'];

    $updateSql = "UPDATE empresa SET status = 1 WHERE folio = '$folio_empresa'";
    if ($conn->query($updateSql) === TRUE) {
        // Guardar el log de la operación de actualización
        $usuario = openssl_decrypt($_COOKIE['vinculacion'], 'AES-256-CBC', 'aeroespacial', 0, '0123456789abcdef');
        $fecha = date("Y-m-d H:i:s");
        $mensaje = "$fecha: $usuario actualizó el estado de la empresa (folio: $folio_empresa) a Aceptada.\n";
        
        // Guardar el mensaje de log
        error_log($mensaje, 3, "../log/empresa.log");

        echo '<script>alert("La empresa ha sido aceptada correctamente.");';
        echo 'window.location.href = "../empresas";</script>';
    } else {
        // Si ocurre un error, guardar un mensaje de error en los logs
        $error = $conn->error;
        $mensaje = "Error al actualizar la empresa (folio: $folio_empresa): $error";
        error_log($mensaje, 3, "../log/empresa.log");

        echo '<script>alert("Error al actualizar la empresa:'. $error .'.");';
        echo 'window.location.href = "../empresas";</script>';
    }
}

$conn->close();
?>
