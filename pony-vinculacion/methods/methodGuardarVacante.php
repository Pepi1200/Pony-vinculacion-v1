<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_vacante = $_GET['id_vacante'];    
    $titulo = $_POST["titulo"];
    $descripcion = str_replace(["\r\n", "\r", "\n"], "\\n", $_POST["descripcion"]);
    $fechaCierre = $_POST["fechaCierre"];
    $datosContacto = $_POST["datosContacto"];
    $categoria = $_POST["categoria"];
    $carreras = isset($_POST["carreras"]) ? $_POST["carreras"] : [];
    $jsonCarreras = json_encode($carreras, JSON_UNESCAPED_UNICODE);
    $servicioSocial = isset($_POST["servicio"]) ? $_POST["servicio"] : "0";
    $practicasProfesionales = isset($_POST["practicas"]) ? $_POST["practicas"] : "0";
    $vacanteLaboral = isset($_POST["trabajo"]) ? $_POST["trabajo"] : "0";

    include("connect.php");

    // Actualizar los datos en la base de datos
    $sql = "UPDATE vacante SET titulo = '$titulo', descripcion = '$descripcion', fecha_cierre = '$fechaCierre', datos_contacto = '$datosContacto',
            categoria = '$categoria', carreras = '$jsonCarreras', servicio_social = '$servicioSocial',
            practicas_profesionales = '$practicasProfesionales', vacante_laboral = '$vacanteLaboral'
            WHERE id_vacante = '$id_vacante'";

    if ($conn->query($sql) === TRUE) {
        // Guardar el log de la operación de actualización
        if(isset($_COOKIE['vinculacion'])){
            $usuario = openssl_decrypt($_COOKIE['vinculacion'], 'AES-256-CBC', 'aeroespacial', 0, '0123456789abcdef');
        }
        else if(isset($_COOKIE['empresa'])){
            $usuario = openssl_decrypt($_COOKIE['empresa'], 'AES-256-CBC', 'aeroespacial', 0, '0123456789abcdef');
        }
        $fecha = date("Y-m-d H:i:s");
        $mensaje = "$fecha: $usuario modifico una vacante (id: $id_vacante).\n";
        
        // Guardar el mensaje de log
        error_log($mensaje, 3, "../log/modificaciones.log");

        echo '<script>alert("La vacante se ha guardado correctamente.");';
        echo 'window.location.href = "../modificarVacante";</script>';
    } else {
        $mensaje = "Error al modificar vacante (id: $id_vacante):";
        error_log($mensaje, 3, "../log/publicaciones.log");
        echo '<script>alert("Error al guardar la vacante (id: '.$id_vacante.').");</script>';
    }

    // Cerrar la conexión
    $conn->close();
}
?>
