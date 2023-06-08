<?php
  // Verificar si se recibió una solicitud POST
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener los valores del formulario
    $imagen = file_get_contents($_FILES["imagen"]["tmp_name"]);
    $enlace = $_POST["enlace"];

    // Conectar a la base de datos
    include("connect.php");

    // Preparar la consulta SQL
    $stmt = $conn->prepare("INSERT INTO noticias (imagen, enlace) VALUES (?, ?)");
    $stmt->bind_param("ss", $imagen, $enlace);

    // Ejecutar la consulta
    $stmt->execute();

    // Guardar el log de la operación de actualización
        $usuario = openssl_decrypt($_COOKIE['vinculacion'], 'AES-256-CBC', 'aeroespacial', 0, '0123456789abcdef');
        $fecha = date("Y-m-d H:i:s");
        $mensaje = "$fecha: $usuario agrego una noticia.\n";
        
        // Guardar el mensaje de log
        error_log($mensaje, 3, "../log/noticia.log");

    // Cerrar la conexión a la base de datos
    $stmt->close();
    $conn->close();

    // Redirigir al usuario a la página de agregar noticia después de agregarla
    header("Location: ../addNotice");
    exit(); // Asegurarse de que el código no siga ejecutándose después de la redirección
  }
?>
