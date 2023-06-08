<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Iniciar Sesión</title>
  <link rel="shortcut icon" href="images/icons/favicon.png">
  <link rel="stylesheet" type="text/css" href="css/login.css?v=1">
  <?php
	// Verificar si existe una cookie y redirigir al index
	if (isset($_COOKIE['alumno']) || isset($_COOKIE['empresa']) || isset($_COOKIE['vinculacion'])) {
	  header("Location: index.php");
	  exit();
	}
	?>
</head>

<body>
  <header>
    <?php include("header.php") ?>
  </header>

  <?php include("chat.php"); ?>

  <div class="background">
    <img src="images/icons/pony.png" class="profile">

    <div class="login">
      <form action="methods/methodLogin.php" method="POST">
        <div class="usuario">
          <label for="alumno">
            <input type="radio" id="alumno" name="tipo" value="alumno" <?php echo (isset($_GET['tipo']) && $_GET['tipo'] === 'alumno') ? 'checked' : 'checked' ?>>
            Alumno
          </label>

          <label for="empresa">
            <input type="radio" id="empresa" name="tipo" value="empresa" <?php echo (isset($_GET['tipo']) && $_GET['tipo'] === 'empresa') ? 'checked' : '' ?>>
            Empresa
          </label>

          <label for="vinculacion">
            <input type="radio" id="vinculacion" name="tipo" value="vinculacion" <?php echo (isset($_GET['tipo']) && $_GET['tipo'] === 'vinculacion') ? 'checked' : '' ?>>
            Vinculación
          </label>
        </div>

        <div class="inputs">
          <input type="text" name="usuario" placeholder="Usuario" value="<?php echo isset($_GET['usuario']) ? $_GET['usuario'] : '' ?>" autocomplete="off">
          <input type="password" name="password" placeholder="Contraseña">
        </div>

        <div class="recuerdame">
          <label for="recuerdame">
            <input type="checkbox" id="recuerdame" name="recuerdame" value="recuerdame">
            Recuérdame
          </label>
          <div>
            <!--<a href="password.php">Olvidé mi Contraseña</a>-->
            <a href="registro">Regístrate</a>
          </div>
        </div>

        <button type="submit" class="logIn">Iniciar Sesión</button>
      </form>
    </div>
  </div>

  <footer>
    <?php include("footer.php") ?>
  </footer>

</body>

<script>
    // Obtener el parámetro de error de la URL (si existe)
    const urlParams = new URLSearchParams(window.location.search);
    const error = urlParams.get('error');
    
    // Mostrar una alerta si hay un error
    if (error) {
      alert(error);
    }
 </script>
</html>
