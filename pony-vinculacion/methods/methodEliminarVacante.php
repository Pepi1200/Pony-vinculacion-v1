<?php
	include("connect.php");

	if (isset($_POST['vacante_id'])) {
	  $vacante_id = $_POST['vacante_id'];
	  $sql = "DELETE FROM vacante WHERE id_vacante = $vacante_id";
	  
	  if ($conn->query($sql) === TRUE) {
	  	// Guardar el log de la operación de actualización
	    if(isset($_COOKIE['vinculacion'])){
	        $usuario = openssl_decrypt($_COOKIE['vinculacion'], 'AES-256-CBC', 'aeroespacial', 0, '0123456789abcdef');
	    }
		else if(isset($_COOKIE['empresa'])){
		    $usuario = openssl_decrypt($_COOKIE['empresa'], 'AES-256-CBC', 'aeroespacial', 0, '0123456789abcdef');
		}
		    $fecha = date("Y-m-d H:i:s");
		    $mensaje = "$fecha: $usuario elimino la vacante (id: $vacante_id).\n";
        
		// Guardar el mensaje de log
		error_log($mensaje, 3, "../log/vacante.log");
	    echo '<script>alert("La vacante se eliminado correctamente.");';
        echo 'window.location.href = "../modificarVacante";</script>';
	  } else {
	  	$mensaje = "Error al eliminar la vacante (id: $id_vacante): $error";
        error_log($mensaje, 3, "../log/vacante.log");
	    echo '<script>alert("Error al eliminar la vacante: " '. $conn->error.');';
        echo 'window.location.href = "../modificarVacante";</script>';
	  } 
	} 
	$conn->close();
?>
