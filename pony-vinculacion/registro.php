<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Registro</title>
		<link rel="shortcut icon" href="images/icons/favicon.png">
		<link rel="stylesheet" type="text/css" href="css/registro.css?v=1">
	</head>

	<body>
		<header>
			<?php include("header.php") ?>
		</header>

		<?php include("chat.php"); ?>
		
		<p class="titulo">Registro</p>
		<hr class="line">

		<div class="container">
			<form class="registro"method="POST" action="methods/methodRegistro.php" enctype="multipart/form-data">
				<div class="usuario">
					<label for="alumno">
						<input type="radio" id="alumno" name="tipo" value="alumno" checked>
						Alumno
					</label>

					<label for="empresa">
						<input type="radio" id="empresa" name="tipo" value="empresa">
						Empresa
					</label>

					<label for="vinculacion">
						<input type="radio" id="vinculacion" name="tipo" value="vinculacion">
						Vinculación
					</label>
				</div>

				<div class="formulario">
					<div id="empresa1Form">
						<input type="text" placeholder="RFC" pattern="[A-Za-z]{4}[0-9]{6}[A-Za-z0-9]{3}" id="rfc" name="rfc">
						<input type="text" placeholder="Nombre Comercial" name="nombreComercial">
						<input type="text" placeholder="Razon Social" name="razonSocial">
						<input type="text" placeholder="Tipo de Empresa" name="tipoEmpresa">
						<input type="text" placeholder="Sector" name="sector">
						<input type="text" placeholder="Giro" name="giro">
						<input type="number" placeholder="Numero de Empleados" name="numeroEmpleados">
						<input type="file" placeholder="Foto de perfil" accept="image/*" name="fotoPerfil">
						<input type="password" placeholder="Contraseña" minlength="8" name="contrasenaEmpresa">
					</div>

					<div id="empresa2Form">
						<input type="text" placeholder="Direccion de la empresa" name="direccionEmpresa">
						<textarea placeholder="Descripción de la empresa" name="descripcionEmpresa"></textarea>
						<input type="url" placeholder="Sitio Web" name="sitioWeb">
						<input type="text" placeholder="Nombre de la persona encargada" name="nombrePersonaEncargada">
						<input type="text" placeholder="Puesto de la persona encargada" name="puestoPersonaEncargada">
						<input type="tel" placeholder="Telefono de contacto" pattern="[+]?[0-9]{1,3}[-\s.]?[0-9]{1,3}[-\s.]?[0-9]{1,4}[-\s.]?[0-9]{1,4}" name="telefonoContacto">
						<input type="email" placeholder="Correo de contacto" name="correoContacto">
						<input type="password" placeholder="Confirmar Contraseña" name="confirmarContrasenaEmpresa" oninput="checkPasswordMatch();">
						<span id="mismatchMessageEmpresa" style="display: none; font-family: arial; font-size: 11px;">Las contraseñas no coinciden</span>
					</div>

					<div id="vinculacionForm">
						<input type="text" placeholder="Correo institucional" pattern="[a-zA-Z0-9._%+-]+@morelia\.tecnm\.mx" name="correoInstitucional">
						<input type="text" placeholder="Nombre" name="nombreVinculacion">
						<input type="text" placeholder="Apellido Paterno" name="apellidoPaternoVinculacion">
						<input type="text" placeholder="Apellido Materno" name="apellidoMaternoVinculacion">
						<input type="text" placeholder="Puesto" name="puestoVinculacion">
						<input type="file" accept="image/*" placeholder="Foto de perfil" name="fotoPerfilVinculacion">
						<input type="url" placeholder="LinkedIn" name="linkedinVinculacion">
						<input type="tel" placeholder="Telefono de contacto" pattern="[+]?[0-9]{1,3}[-\s.]?[0-9]{1,3}[-\s.]?[0-9]{1,4}[-\s.]?[0-9]{1,4}" name="telefonoContactoVinculacion">
						<input type="text" placeholder="Codigo" name="codigoCarrera">
						<input type="password" placeholder="Contraseña" minlength="8" name="contrasenaVinculacion">
						<input type="password" placeholder="Confirmar Contraseña" name="confirmarContrasenaVinculacion" oninput="checkPasswordMatch();">
						<span id="mismatchMessageVinculacion" style="display: none; font-family: arial; font-size: 11px;">Las contraseñas no coinciden</span>
					</div>

					<div id="alumnoForm">
						<input type="text" placeholder="Numero de control" pattern="[0-9]{8}" name="numeroControl">
						<input type="text" placeholder="Correo institucional" pattern="[a-zA-Z0-9._%+-]+@morelia\.tecnm\.mx" name="correoInstitucionalAlumno">
						<input type="text" placeholder="Nombre" name="nombreAlumno">
						<input type="text" placeholder="Apellido Paterno" name="apellidoPaternoAlumno">
						<input type="text" placeholder="Apellido Materno" name="apellidoMaternoAlumno">
						<input type="url" placeholder="LinkedIn" name="linkedinAlumno">
						<input type="tel" placeholder="Telefono de contacto" pattern="[+]?[0-9]{1,3}[-\s.]?[0-9]{1,3}[-\s.]?[0-9]{1,4}[-\s.]?[0-9]{1,4}" name="telefonoContactoAlumno">
						<input type="file" accept="image/*" placeholder="Foto de perfil" name="fotoPerfilAlumno">
						<input type="password" placeholder="Contraseña" minlength="8" name="contrasenaAlumno">
						<input type="password" placeholder="Confirmar Contraseña" name="confirmarContrasenaAlumno" oninput="checkPasswordMatch();"><!--comparar con la contrase;a-->
						<span id="mismatchMessageAlumno" style="display: none; font-family: arial; font-size: 11px;">Las contraseñas no coinciden</span>
					</div>

					<button type="submit">Crear Cuenta</button>
				</div>
			</div>
		</form>

		<script src="js/registro.js?V=2"></script>

		<?php include("footer.php") ?>
	</body>
</html>
