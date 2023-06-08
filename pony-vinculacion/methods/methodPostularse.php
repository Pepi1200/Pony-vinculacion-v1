<?php
include("connect.php");
if (isset($_GET['id'])) {
  $id_vacante = $_GET['id'];
  $id_alumno = openssl_decrypt($_COOKIE['alumno'], 'AES-256-CBC', 'aeroespacial', 0, '0123456789abcdef');

  // Consultar la información de la vacante y empresa asociada
  $sql = "SELECT v.id_vacante, v.titulo, v.descripcion, e.nombre_comercial, e.correo_empresa, a.curriculum
    FROM vacante v
    INNER JOIN empresa e ON v.id_empresa = e.folio
    INNER JOIN alumno a ON a.no_control = '$id_alumno'
    WHERE v.id_vacante = $id_vacante";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $titulo = $row["titulo"];
    $nombreEmpresa = $row["nombre_comercial"];
    $correoEmpresa = $row["correo_empresa"];
    $curriculum = $row["curriculum"];

    // Enviar correo electrónico con el archivo adjunto
    $to = $correoEmpresa;
    $subject = "Solicitud de empleo para la vacante: " . $titulo;
    $message = "Estimado(a) " . $nombreEmpresa . ",\n\nAdjunto encontrarás mi solicitud de empleo para la vacante: " . $titulo . ".\n\nSaludos cordiales,\n[Nombre del solicitante]";

    $headers = "From: [Tu dirección de correo electrónico]";

    // Verificar si el candidato adjuntó el archivo de curriculum
    if ($curriculum != null) {
      $file = 'ruta/al/directorio/' . $curriculum; // Ruta al directorio donde se guarda el archivo de curriculum
      $filename = 'nombre_del_archivo.pdf'; // Nombre que se asignará al archivo adjunto

      $file_content = file_get_contents($file);
      $file_content = chunk_split(base64_encode($file_content));

      $boundary = md5(time());

      $headers .= "\nMIME-Version: 1.0\n";
      $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\n";
      $headers .= "This is a multi-part message in MIME format.\n";

      $message = "--$boundary\n";
      $message .= "Content-Type: text/plain; charset=\"iso-8859-1\"\n";
      $message .= "Content-Transfer-Encoding: 7bit\n\n";
      $message .= $message . "\n\n";

      $message .= "--$boundary\n";
      $message .= "Content-Type: application/octet-stream; name=\"$filename\"\n";
      $message .= "Content-Transfer-Encoding: base64\n";
      $message .= "Content-Disposition: attachment\n\n";
      $message .= $file_content . "\n";
      $message .= "--$boundary--";
    }

    // Enviar el correo electrónico
    if (mail($to, $subject, $message, $headers)) {
      echo "Correo electrónico enviado correctamente.";
    } else {
      echo "Error al enviar el correo electrónico.";
    }
  } else {
    echo "Vacante no encontrada.";
  }
} else {
  echo "ID de vacante no especificado.";
}
?>
