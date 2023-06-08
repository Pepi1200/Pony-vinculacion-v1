<?php
	include("connect.php");

	if (isset($_POST['vacante_id'])) {
	    $vacante_id = $_POST['vacante_id'];

	    $sql = "SELECT visible FROM vacante WHERE id_vacante = '$vacante_id'";
	    $result = $conn->query($sql);

	    // Verificar si se encontraron vacantes
	    if ($result->num_rows > 0) {
	        $row = $result->fetch_assoc();
	        $visible = $row['visible'];

	        // Invertir el valor de la columna visible
	        if ($visible == 0) {
	            $mostrar = 1;
	            $visibilidad = "Visible";
	        } elseif ($visible == 1) {
	            $mostrar = 0;
	            $visibilidad = "Oculta";
	        }

	        $updateSql = "UPDATE vacante SET visible = '$mostrar' WHERE id_vacante = '$vacante_id'";
	        if ($conn->query($updateSql) === TRUE) {
	        	// Guardar el log de la operación de actualización
	            if(isset($_COOKIE['vinculacion'])){
	            	$usuario = openssl_decrypt($_COOKIE['vinculacion'], 'AES-256-CBC', 'aeroespacial', 0, '0123456789abcdef');
	            }
		        else if(isset($_COOKIE['empresa'])){
		        	$usuario = openssl_decrypt($_COOKIE['empresa'], 'AES-256-CBC', 'aeroespacial', 0, '0123456789abcdef');
		        }
		        $fecha = date("Y-m-d H:i:s");
		        $mensaje = "$fecha: $usuario actualizó el estado de la vacante (id: $vacante_id) a $visibilidad.\n";
        
		        // Guardar el mensaje de log
		        error_log($mensaje, 3, "../log/vacante.log");

	            echo '<script>alert("La vacante se ha actualizado correctamente.");';
	            echo 'window.location.href = "../modificarVacante";</script>';
	        } else {
	        	$mensaje = "Error al actualizar la vacante (id: $id_vacante): $error";
        		error_log($mensaje, 3, "../log/vacante.log");
	            echo '<script>alert("Error al actualizar la vacante:'. $conn->error.'.");';
	            echo 'window.location.href = "../modificarVacante";</script>';
	        }
	    }
	}

	$conn->close();
?>