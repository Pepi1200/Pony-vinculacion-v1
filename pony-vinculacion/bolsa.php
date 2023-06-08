<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Bolsa de Trabajo ITM</title>
		<?php
			$address1=[["Campus I", "Avenida Tecnólogico", "#1500","Col. Lomas de Santiaguito","Morelia","Michoacán"],["Campus II", "Camino de la Arboleada", "S/N", "Residencial San Jose de la Huerta","Morelia","Michoacán"]];
		?>
		<link rel="shortcut icon" href="images/icons/favicon.png">
		<link rel="stylesheet" href="css/bolsa.css?v=1">
		<?php
		// Verificar si la cookie de vinculación está presente
		if (isset($_COOKIE['alumno']) || isset($_COOKIE['empresa']) || isset($_COOKIE['vinculacion'])) {
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
		
		<?php 
			$page="bolsa";
			include("cover.php"); 
		?>

		<div class="search">
			<form action="bolsa.php">
				<input type="text" id="palabraClave" name="palabraClave" placeholder="Palabra Clave" class="palabraInput" autocomplete="off">

				<select name="carrera" id="carrera" class="carreraInput">
					<option value="" disabled selected hidden> Carrera </option>
					<?php
				        include("methods/connect.php");
				        // Realizar la consulta
				        $sql = "SELECT nombre FROM carrera WHERE activa = 1 ORDER BY nombre ASC";
				        $result = $conn->query($sql);

				        // Verificar si se encontraron registros
				        if ($result->num_rows > 0) {
				            // Generar las opciones de selección
				            while ($row = $result->fetch_assoc()) {
				                $nombreCarrera = $row["nombre"];
				                echo '<option value="' . $nombreCarrera . '">' . $nombreCarrera . '</option>';
				            }
				        } else {
				            echo '<option value="" disabled>No se encontraron carreras.</option>';
				        }

				        // Cerrar la conexión
				        $conn->close();
				    ?>

				</select>

				<select name="opcionesDesarrollo" id="opcionesDesarrollo" class="opcionDesarrolloInput">
					<option value="" disabled selected hidden> Opciones de desarrollo</option>
					<option value="v.servicio_social">Servicio Social</option>
					<option value="v.practicas_profesionales">Practicas Profesionales</option>
					<option value="v.vacante_laboral">Vacante Laboral</option>
				</select>

				<button>Buscar</button>
			</form>
		</div>

		<?php include("methods/methodBolsa.php") ?>

		<footer>
            <?php include("footer.php") ?>
        </footer>

	</body>
</html>