<?php
	include("connect.php");

	if (isset($_POST['vacante_id'])) {
	    $vacante_id = $_POST['vacante_id'];

	    $updateSql = "UPDATE vacante SET aceptada = 1 WHERE id_vacante = '$vacante_id'";
	        if ($conn->query($updateSql) === TRUE) {
	            echo '<script>alert("La vacante se ha actualizado correctamente.");';
	            echo 'window.location.href = "../modificarVacante";</script>';

	            // Guardar el log de la operación de actualización
	            if(isset($_COOKIE['vinculacion'])){
	            	$usuario = openssl_decrypt($_COOKIE['vinculacion'], 'AES-256-CBC', 'aeroespacial', 0, '0123456789abcdef');
	            }
		        else if(isset($_COOKIE['empresa'])){
		        	$usuario = openssl_decrypt($_COOKIE['empresa'], 'AES-256-CBC', 'aeroespacial', 0, '0123456789abcdef');
		        }
		        $fecha = date("Y-m-d H:i:s");
		        $mensaje = "$fecha: $usuario actualizó el estado de la vacante (id: $vacante_id) a Aceptada.\n";
        
		        // Guardar el mensaje de log
		        error_log($mensaje, 3, "../log/vacante.log");
	        } else {
	        	$mensaje = "Error al actualizar la vacante (id: $id_vacante): $error";
        		error_log($mensaje, 3, "../log/vacante.log");
	            echo '<script>alert("Error al actualizar la vacante:'. $conn->error.'.");';
	            echo 'window.location.href = "../modificarVacante";</script>';
	        }
	}

	$conn->close();
?>