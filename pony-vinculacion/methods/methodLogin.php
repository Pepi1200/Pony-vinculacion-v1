<?php
// Verificar si se recibió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Obtener el tipo de usuario seleccionado
  $tipoUsuario = $_POST["tipo"];

  // Obtener el valor ingresado en el campo de usuario
  $usuario = $_POST["usuario"];

  // Realizar acciones específicas según el tipo de usuario
  switch ($tipoUsuario) {
    case "alumno":
      // Obtener los datos del formulario del alumno
      $contrasenaAlumno = $_POST["password"];

      // Conectar a la base de datos
      include("connect.php");

      // Verificar si el usuario y la contraseña son válidos y existen en la base de datos
      $sql = "SELECT * FROM alumno WHERE no_control = '$usuario'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        // Se encontró un registro con el usuario proporcionado
        $row = $result->fetch_assoc();
        $hashedPassword = $row["hash"];

        if (password_verify($contrasenaAlumno, $hashedPassword)) {
          // La contraseña es correcta, autenticación exitosa
          // Generar la cookie del nombre de usuario
          $cookieName = "alumno";
          $cookieValue = openssl_encrypt($usuario, 'AES-256-CBC', 'aeroespacial', 0, '0123456789abcdef');
          $cookieExpiration = ($_POST["recuerdame"] === "recuerdame") ? time() + (30 * 24 * 60 * 60) : time() + 3600; // La cookie expirará en 30 días si está seleccionado el checkbox "Recuérdame", de lo contrario, expirará en 1 hora
          $cookiePath = "/"; // La cookie es válida para todo el sitio
          // Generar la cookie
          setcookie($cookieName, $cookieValue, $cookieExpiration, $cookiePath);

          // Redirigir al alumno a la página correspondiente después de la autenticación exitosa
          header("Location: ../index.php");
          exit(); // Asegurarse de que el código no siga ejecutándose después de la redirección
        } else {
          // La contraseña es incorrecta
          header("Location: ../login?error=Contraseña incorrecta&tipo=$tipoUsuario&usuario=$usuario");
          exit();
        }
      } else {
        // No se encontró un registro con el usuario proporcionado
        header("Location: ../login?error=El usuario no existe&tipo=$tipoUsuario&usuario=$usuario");
        exit();
      }

      // Cerrar la conexión a la base de datos
      $conn->close();

      break;

    case "empresa":
      // Obtener los datos del formulario de la empresa
      $contrasenaEmpresa = $_POST["password"];

      // Conectar a la base de datos
      include("connect.php");

      // Verificar si el usuario y la contraseña son válidos y existen en la base de datos
      $sql = "SELECT * FROM empresa WHERE folio = '$usuario'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        // Se encontró un registro con el usuario proporcionado
        $row = $result->fetch_assoc();
        $hashedPassword = $row["hash"];
        $status = $row["status"];

        if (password_verify($contrasenaEmpresa, $hashedPassword)) {
          if ($status == 1) {
            // La contraseña es correcta, autenticación exitosa
            // Generar la cookie del nombre de usuario
            $cookieName = "empresa";
            $cookieValue = openssl_encrypt($usuario, 'AES-256-CBC', 'aeroespacial', 0, '0123456789abcdef');
            $cookieExpiration = ($_POST["recuerdame"] === "recuerdame") ? time() + (30 * 24 * 60 * 60) : time() + 3600; // La cookie expirará en 30 días si está seleccionado el checkbox "Recuérdame", de lo contrario, expirará en 1 hora
            $cookiePath = "/"; // La cookie es válida para todo el sitio
            // Generar la cookie
            setcookie($cookieName, $cookieValue, $cookieExpiration, $cookiePath);

            // Redirigir al alumno a la página correspondiente después de la autenticación exitosa
            header("Location: ../index.php");
            exit(); // Asegurarse de que el código no siga ejecutándose después de la redirección
          } else if($status == 0){
            header("Location: ../login?error=¡Buenas noticias! Estamos verificando tus datos para garantizar la seguridad de nuestra plataforma. Pronto podrás acceder sin problemas. ¡Gracias por tu paciencia!&tipo=$tipoUsuario&usuario=$usuario");
            exit();
          }else if($status == 3){
            header("Location: ../login?error=Lamentamos informarte que, tras una cuidadosa revisión, tu solicitud de acceso a nuestra plataforma ha sido rechazada. Nuestro equipo ha verificado los datos y hemos tomado esta medida para garantizar la seguridad de nuestra comunidad.Agradecemos tu comprensión y te invitamos a contactarnos si tienes alguna pregunta o inquietud. Estamos aquí para ayudarte en lo que podamos.¡Gracias por tu interés y apoyo!&tipo=$tipoUsuario&usuario=$usuario");
            exit();
          }
        } else {
          // La contraseña es incorrecta
          header("Location: ../login?error=Contraseña incorrecta&tipo=$tipoUsuario&usuario=$usuario");
          exit();
        }
      } else {
        // No se encontró un registro con el usuario proporcionado
        header("Location: ../login?error=El usuario no existe&tipo=$tipoUsuario&usuario=$usuario");
        exit();
      }

      // Cerrar la conexión a la base de datos
      $conn->close();

      break;

    case "vinculacion":
      // Obtener los datos del formulario del alumno
      $contrasenaVinculacion = $_POST["password"];

      // Conectar a la base de datos
      include("connect.php");

      // Verificar si el usuario y la contraseña son válidos y existen en la base de datos
      $sql = "SELECT * FROM vinculacion WHERE correo_institucional = '$usuario'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        // Se encontró un registro con el usuario proporcionado
        $row = $result->fetch_assoc();
        $hashedPassword = $row["hash"];
        $carrera = $row["carrera"];

        if (password_verify($contrasenaVinculacion, $hashedPassword)) {
          // La contraseña es correcta, autenticación exitosa
          // Generar la cookie del nombre de usuario
          $cookieName = "vinculacion";
          $cookieValue = openssl_encrypt($usuario, 'AES-256-CBC', 'aeroespacial', 0, '0123456789abcdef');
          $cookieExpiration = ($_POST["recuerdame"] === "recuerdame") ? time() + (30 * 24 * 60 * 60) : time() + 3600; // La cookie expirará en 30 días si está seleccionado el checkbox "Recuérdame", de lo contrario, expirará en 1 hora
          $cookiePath = "/"; // La cookie es válida para todo el sitio
          // Generar la cookie
          setcookie($cookieName, $cookieValue, $cookieExpiration, $cookiePath);

          // Generar la cookie de carrera
          $cookieName = "carrera";
          $cookieValue = openssl_encrypt($carrera, 'AES-256-CBC', 'aeroespacial', 0, '0123456789abcdef');
          $cookieExpiration = ($_POST["recuerdame"] === "recuerdame") ? time() + (30 * 24 * 60 * 60) : time() + 3600; // La cookie expirará en 30 días si está seleccionado el checkbox "Recuérdame", de lo contrario, expirará en 1 hora
          $cookiePath = "/"; // La cookie es válida para todo el sitio
          // Generar la cookie
          setcookie($cookieName, $cookieValue, $cookieExpiration, $cookiePath);

          // Redirigir al alumno a la página correspondiente después de la autenticación exitosa
          header("Location: ../index.php");
          exit(); // Asegurarse de que el código no siga ejecutándose después de la redirección
        } else {
          // La contraseña es incorrecta
          header("Location: ../login?error=Contraseña incorrecta&tipo=$tipoUsuario&usuario=$usuario");
          exit();
        }
      } else {
        // No se encontró un registro con el usuario proporcionado
        header("Location: ../login?error=El usuario no existe&tipo=$tipoUsuario&usuario=$usuario");
        exit();
      }

      // Cerrar la conexión a la base de datos
      $conn->close();

      break;

    default:
      // Tipo de usuario no válido
      header("Location: ../login");
      exit();
  }
}
?>
