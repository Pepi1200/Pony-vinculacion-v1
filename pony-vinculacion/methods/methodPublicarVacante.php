<?php
        // Verificar si la cookie de vinculación está presente
        if (isset($_COOKIE['empresa']) || isset($_COOKIE['vinculacion'])) {
            // La cookie de vinculación está presente, se permite el acceso
            // Aquí puedes colocar el código que deseas ejecutar para las personas con la cookie de vinculación
        } else {
            // La cookie de vinculación no está presente, se deniega el acceso
            // Aquí puedes colocar el código que deseas ejecutar para las personas sin la cookie de vinculación
            header("Location: login");
            exit();
        }
        ?>
<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $titulo = $_POST["titulo"];
    $descripcion = str_replace(["\r\n", "\r", "\n"], "\\n", $_POST["descripcion"]);
    $fechaCierre = $_POST["fechaCierre"];
    $datosContacto = $_POST["datosContacto"];
    $categoria = $_POST["categoria"];
    $carreras = isset($_POST["carreras"]) ? $_POST["carreras"] : [];
    $jsonCarreras = json_encode($carreras,JSON_UNESCAPED_UNICODE);
    $servicioSocial = isset($_POST["servicio"]) ? $_POST["servicio"] : "0";
    $practicasProfesionales = isset($_POST["practicas"]) ? $_POST["practicas"] : "0";
    $vacanteLaboral = isset($_POST["trabajo"]) ? $_POST["trabajo"] : "0";
    if (isset($_COOKIE['empresa'])) {
        $id_empresa=openssl_decrypt($_COOKIE['empresa'], 'AES-256-CBC', 'aeroespacial', 0, '0123456789abcdef');
    }
    if (isset($_COOKIE['vinculacion'])) {
        $id_empresa=$_POST["idEmpresa"];
    }

    include("connect.php");

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO vacante (titulo, descripcion, fecha_cierre, datos_contacto, categoria, carreras, servicio_social, practicas_profesionales, vacante_laboral, aceptada , visible, id_empresa)
            VALUES ('$titulo', \"$descripcion\", '$fechaCierre', '$datosContacto', '$categoria', '$jsonCarreras', '$servicioSocial', '$practicasProfesionales', '$vacanteLaboral', 0, 0, $id_empresa)";

    if ($conn->query($sql) === TRUE) {
        // Guardar el log de la operación de actualización
        if(isset($_COOKIE['vinculacion'])){
            $usuario = openssl_decrypt($_COOKIE['vinculacion'], 'AES-256-CBC', 'aeroespacial', 0, '0123456789abcdef');
        }
        else if(isset($_COOKIE['empresa'])){
            $usuario = openssl_decrypt($_COOKIE['empresa'], 'AES-256-CBC', 'aeroespacial', 0, '0123456789abcdef');
        }
        $fecha = date("Y-m-d H:i:s");
        $mensaje = "$fecha: $usuario agrego una vacante (titulo: $titulo, fecha de cierre: $fechaCierre).\n";
        
        // Guardar el mensaje de log
        error_log($mensaje, 3, "../log/publicaciones.log");

        echo '<script>alert("La vacante se ha guardado correctamente.");';
        echo 'window.location.href = "../modificarVacante";</script>';
    } else {
        $mensaje = "Error al agregar vacante (id: $id_vacante):";
        error_log($mensaje, 3, "../log/publicaciones.log");
        echo '<script>alert("Error al guardar la vacante (titulo: $titulo, fecha de cierre: $fechaCierre).");</script>';
    }


    // Cerrar la conexión
    $conn->close();
}
?>