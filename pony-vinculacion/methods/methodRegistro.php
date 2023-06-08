<?php
include("connect.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Obtener el tipo de registro seleccionado
  $tipoRegistro = $_POST["tipo"];

  // Realizar acciones específicas según el tipo de registro
  switch ($tipoRegistro) {
    case "alumno":
        // Obtener los datos del formulario del alumno
        $numeroControl = $_POST["numeroControl"];
        $correoInstitucional = $_POST["correoInstitucionalAlumno"];
        $nombreAlumno = $_POST["nombreAlumno"];
        $apellidoPaternoAlumno = $_POST["apellidoPaternoAlumno"];
        $apellidoMaternoAlumno = $_POST["apellidoMaternoAlumno"];
        $linkedinAlumno = $_POST["linkedinAlumno"];
        $telefonoContactoAlumno = $_POST["telefonoContactoAlumno"];
        $archivoAlumno = $_FILES["fotoPerfilAlumno"]["tmp_name"];
        if (!empty($archivoAlumno)) {
          $fotoPerfilAlumno = file_get_contents($archivoAlumno);
        } else {
          $fotoPerfilAlumno = null;
        }
        $contrasenaAlumno = password_hash($_POST["contrasenaAlumno"], PASSWORD_DEFAULT);
        $confirmarContrasenaAlumno = $_POST["confirmarContrasenaAlumno"];

        // Verificar si ya existe alguien registrado con el mismo número de control
        $sql_verificacion = "SELECT * FROM alumno WHERE no_control = '$numeroControl'";
        $result_verificacion = $conn->query($sql_verificacion);

        if ($result_verificacion->num_rows > 0) {
          // Ya existe un registro con el mismo número de control, mostrar advertencia
          echo '<script>alert("Ya existe un alumno registrado con el mismo número de control.");';
          echo 'window.location.href = "../login";</script>';
        } else {
          // No existe un registro con el mismo número de control, realizar el registro
          $sql = "INSERT INTO alumno (no_control, correo_institucional, nombre, apellido_paterno, apellido_materno, linkedin, telefono, foto_perfil, hash) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("sssssssss", $numeroControl, $correoInstitucional, $nombreAlumno, $apellidoPaternoAlumno, $apellidoMaternoAlumno, $linkedinAlumno, $telefonoContactoAlumno, $fotoPerfilAlumno, $contrasenaAlumno);
          $stmt->execute();

          if ($stmt->affected_rows > 0) {
            echo '<script>alert("Registro de alumno exitoso.");';
            echo 'window.location.href = "../login";</script>';
          } else {
            echo '<script>alert("Error al registrar el alumno.");';
            echo 'window.location.href = "../Registro";</script>';
          }

          $stmt->close();

        }
      break;

    case "empresa":
        // Obtener los datos del formulario de la empresa
        $rfc = strtoupper($_POST["rfc"]);
        $nombreComercial = $_POST["nombreComercial"];
        $razonSocial = $_POST["razonSocial"];
        $tipoEmpresa = $_POST["tipoEmpresa"];
        $sector = $_POST["sector"];
        $giro = $_POST["giro"];
        $numeroEmpleados = $_POST["numeroEmpleados"];

        $archivoEmpresa = $_FILES["fotoPerfil"]["tmp_name"];
        if (!empty($archivoEmpresa)) {
          $fotoPerfil = file_get_contents($archivoEmpresa);
        } else {
          $fotoPerfil = null;
        }

        $contrasena = password_hash($_POST["contrasenaEmpresa"], PASSWORD_DEFAULT);
        $confirmarContrasena = $_POST["confirmarContrasenaEmpresa"];
        $direccionEmpresa = $_POST["direccionEmpresa"];
        $descripcionEmpresa = $_POST["descripcionEmpresa"];
        $sitioWeb = $_POST["sitioWeb"];
        $nombrePersonaEncargada = $_POST["nombrePersonaEncargada"];
        $puestoPersonaEncargada = $_POST["puestoPersonaEncargada"];
        $telefonoContacto = $_POST["telefonoContacto"];
        $correoContacto = $_POST["correoContacto"];
        $anioActual = date("Y");
        $folio = generateFolio($anioActual);
        $status=0;

        // Verificar si ya existe una empresa registrada con el mismo RFC
        $sql_verificacion = "SELECT * FROM empresa WHERE rfc = '$rfc'";
        $result_verificacion = $conn->query($sql_verificacion);

        if ($result_verificacion->num_rows > 0) {
          // Ya existe una empresa registrada con el mismo RFC, mostrar advertencia
          echo '<script>alert("Ya existe una empresa registrada con el mismo RFC.");';
          echo 'window.location.href = "../login";</script>';
        } else {
          // No existe una empresa registrada con el mismo RFC, realizar el registro
          $sql = "INSERT INTO empresa (folio, rfc, nombre_comercial, razon_social, tipo_empresa, sector, giro, numero_empleados, logo_empresa, hash, direccion_empresa, descripcion_empresa, sitio_web, nombre_encargado, puesto_encargado, telefono_empresa, correo_empresa, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssssssssssssssi", $folio, $rfc, $nombreComercial, $razonSocial, $tipoEmpresa, $sector, $giro, $numeroEmpleados, $fotoPerfil, $contrasena, $direccionEmpresa, $descripcionEmpresa, $sitioWeb, $nombrePersonaEncargada, $puestoPersonaEncargada, $telefonoContacto, $correoContacto, $status);
            $stmt->execute();

          if ($stmt->affected_rows > 0) {
            echo '<script>alert("Registro de empresa exitoso.");';
            echo 'window.location.href = "../login";</script>';
          } else {
            echo '<script>alert("Error al registrar la empresa.");';
            echo 'window.location.href = "../Registro";</script>';
          }

          $stmt->close();
        }

      break;

    case "vinculacion":
      // Obtener los datos del formulario de vinculación
      $correoInstitucional = $_POST["correoInstitucional"];
      $nombreVinculacion = $_POST["nombreVinculacion"];
      $apellidoPaternoVinculacion = $_POST["apellidoPaternoVinculacion"];
      $apellidoMaternoVinculacion = $_POST["apellidoMaternoVinculacion"];
      $puestoVinculacion = $_POST["puestoVinculacion"];

      $archivoVinculacion = $_FILES["fotoPerfilVinculacion"]["tmp_name"];
        if (!empty($archivoVinculacion)) {
          $fotoPerfilVinculacion = file_get_contents($archivoVinculacion);
        } else {
          $fotoPerfilVinculacion = null;
        }

      $linkedinVinculacion = $_POST["linkedinVinculacion"];
      $telefonoContactoVinculacion = $_POST["telefonoContactoVinculacion"];
      $carreraVinculacion = $_POST["codigoCarrera"];
      $contrasenaVinculacion = password_hash($_POST["contrasenaVinculacion"], PASSWORD_DEFAULT);
      $confirmarContrasenaVinculacion = $_POST["confirmarContrasenaVinculacion"];

      // Verificar si ya existe alguien registrado con el mismo correo institucional
      $sql_verificacion = "SELECT * FROM vinculacion WHERE correo_institucional = '$correoInstitucional'";
      $result_verificacion = $conn->query($sql_verificacion);

      if ($result_verificacion->num_rows > 0) {
        // Ya existe un registro con el mismo correo institucional, mostrar advertencia
        echo '<script>alert("Ya existe un vinculación registrado con el mismo correo institucional.");';
        echo 'window.location.href = "../login";</script>';
      } else {
        // No existe un registro con el mismo correo institucional, realizar el registro
        $sql = "INSERT INTO vinculacion (correo_institucional, nombre, apellido_paterno, apellido_materno, puesto, foto_perfil, linkedin, telefono, hash, carrera) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssss", $correoInstitucional, $nombreVinculacion, $apellidoPaternoVinculacion, $apellidoMaternoVinculacion, $puestoVinculacion, $fotoPerfilVinculacion, $linkedinVinculacion, $telefonoContactoVinculacion, $contrasenaVinculacion, $carreraVinculacion);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
          echo '<script>alert("Registro de vinculación exitoso.");';
          echo 'window.location.href = "../login";</script>';
        } else {
          echo '<script>alert("Error al registrar la vinculación.");';
          echo 'window.location.href = "../Registro";</script>';
        }

        $stmt->close();

      }

      break;
  }
}

function generateFolio($anioActual) {
  include("connect.php");
  $sql = "SELECT MAX(SUBSTRING(folio, 5)) AS maxFolio FROM empresa";
  $result = $conn->query($sql);
  $maxFolio = 0;

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $maxFolio = intval($row["maxFolio"]);
  }

  $maxFolio++;
  $folio = $anioActual . str_pad($maxFolio, 6, "0", STR_PAD_LEFT);

  return $folio;
}
?>
