<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Empresas</title>
		<link rel="stylesheet" type="text/css" href="css/empresas.css">
		<link rel="shortcut icon" href="images/icons/favicon.png">
		<?php
			// Verificar si existe una cookie y redirigir al index
			if (isset($_COOKIE['vinculacion'])) {
			}
			else{
				header("Location: index.php");
			  	exit();
			}
		?>
	</head>

	<body>
		<header>
			<?php include("header.php"); ?>
		</header>

		<p class="titulo">Solicitud de registro</p>
		<hr class="line">

		<?php include("methods/methodEmpresas.php"); ?>

		<footer>
			<?php include("footer.php") ?>
		</footer>
	</body>
</html>