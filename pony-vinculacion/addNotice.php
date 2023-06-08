<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Agregar Noticia</title>
		<link rel="shortcut icon" href="images/icons/favicon.png">
		<link rel="stylesheet" type="text/css" href="css/addNotice.css?v=1">
		<?php
		// Verificar si la cookie de vinculación está presente
		if (isset($_COOKIE['vinculacion'])) {
		    // La cookie de vinculación está presente, se permite el acceso
		    // Aquí puedes colocar el código que deseas ejecutar para las personas con la cookie de vinculación
		    // Por ejemplo, mostrar contenido especial o permitir acciones específicas
		} else {
		    // La cookie de vinculación no está presente, se deniega el acceso
		    // Aquí puedes colocar el código que deseas ejecutar para las personas sin la cookie de vinculación
		    header("Location: login.php");
		    exit();
		}
		?>
	</head>

	<body>
		<header>
			<?php include("header.php");?>
		</header>

		<?php include("chat.php"); ?>

		<h1 class="titulo">Nueva noticia</h1>
		<hr class="line">
		    
		<form class="formNotice" action="methods/methodAddNotice.php" method="POST" enctype="multipart/form-data">
		  <input type="file" accept="image/png, image/jpeg, image/jpg" name="imagen"><!--configurar max_allowed_packet en la base de datos-->
		  <input type="text" placeholder="Enlace" name="enlace" autocomplete="off">
		  <button class="submitButton" type="submit">Publicar</button>
		</form>

	    <h1 class="titulo">Noticias</h1>
	    <hr class="line">

	    <?php
		    // Conectar a la base de datos
		    include("methods/connect.php");

		    // Obtener las noticias de la base de datos
		    $sql = "SELECT * FROM noticias ORDER BY id DESC";
		    $result = $conn->query($sql);

		    // Verificar si hay noticias disponibles
		    if ($result->num_rows > 0) {
		        // Iterar sobre las noticias y mostrarlas
		        while ($row = $result->fetch_assoc()) {
		            $id = $row["id"];
		            $imagen = $row["imagen"];
		            $enlace = $row["enlace"];

		            // Si se ha enviado una solicitud para eliminar la noticia, procesarla
		            if (isset($_POST["eliminar"]) && $_POST["eliminar"] == $id) {
		                // Eliminar la noticia de la base de datos
		                $sql_delete = "DELETE FROM noticias WHERE id = '$id'";
		                if ($conn->query($sql_delete) === true) {
		                    // Redirigir a la misma página para actualizar la lista de noticias
		                    // Guardar el log de la operación de actualización
					        $usuario = openssl_decrypt($_COOKIE['vinculacion'], 'AES-256-CBC', 'aeroespacial', 0, '0123456789abcdef');
					        $fecha = date("Y-m-d H:i:s");
					        $mensaje = "$fecha: $usuario elimino una noticia (id: $id).\n";
					        
					        // Guardar el mensaje de log
					        error_log($mensaje, 3, "../log/noticia.log");
		                    echo "<script>window.location.reload();</script>";
       						exit();
		                } else {
		                	$mensaje = "Error al eliminar noticia (id: $id_vacante): $error";
        					error_log($mensaje, 3, "../log/noticia.log");
		                    echo "<p>Error al eliminar la noticia: " . $conn->error . "</p>";
		                }
		            }
		    ?>

		    <div class="noticia">
		        <img src="data:image/jpeg;base64,<?php echo base64_encode($imagen); ?>">
		        <a href="<?php echo $enlace; ?>"><?php echo $enlace; ?></a>
		        <div>
		            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		                <input type="hidden" name="eliminar" value="<?php echo $id; ?>">
		                <button type="submit">Eliminar</button>
		            </form>
		        </div>
		    </div>

		    <?php
		        }
		    } else {
		        // No hay noticias disponibles
		        echo "<p>No hay noticias disponibles.</p>";
		    }

		    // Cerrar la conexión a la base de datos
		    $conn->close();
	    ?>

		<footer>
			<?php include("footer.php") ?>
		</footer>

	</body>
</html>