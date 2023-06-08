<?php 
	$id_vacante = $_GET['id_vacante'];
	if (isset($id_vacante) && !empty($id_vacante)) {
		include("connect.php");
		// Realizar la para validar que se puede realizar laaccion
		$sql = "SELECT * FROM vacante WHERE id_vacante='$id_vacante'";
		$result = $conn->query($sql);

		// Verificar si se encontraron vacantes
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$id_empresa=$row["id_empresa"];

	        if ((isset($_COOKIE['empresa']) && openssl_decrypt($_COOKIE['empresa'], 'AES-256-CBC', 'aeroespacial', 0, '0123456789abcdef') == $id_empresa) || isset($_COOKIE['vinculacion'])) {
	            $titulo=$row["titulo"];
				$descripcion = $row["descripcion"];
				$fecha_cierre=$row["fecha_cierre"];
				$categoria=$row["categoria"];
				$carreras=$row["carreras"];
				$datos_contacto=$row["datos_contacto"];
				$save="methods/methodGuardarVacante.php?id_vacante=$id_vacante";

				$servicio_social=$row["servicio_social"];
				$practicas_profesionales=$row["practicas_profesionales"];
				$vacante_laboral=$row["vacante_laboral"];
	            
	        } else {
	            // La cookie de vinculación o empresa no está presente, se deniega el acceso
	            header("Location: modificarVacante");
	            exit();
	        }
    	}
    	else {
            // La cookie de vinculación o empresa no está presente, se deniega el acceso
            header("Location: modificarVacante");
            exit();
   		}
	}
	else {
            // La cookie de vinculación o empresa no está presente, se deniega el acceso
            header("Location: modificarVacante");
            exit();
   	}
?>