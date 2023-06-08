<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style type="text/css">
			.cover{
				display: flex;
			  	flex-wrap: wrap;
			  	align-items: center;
			  	justify-content: space-evenly;
				margin-left: 0px;
				margin-right: 0px;
				background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), URL('images/backgroundTec.png');
				background-repeat: no-repeat;
				background-size: cover;
				background-color: black;
				background-position-x: center;
				min-height: 600px;
				text-align: center;
				border-radius: 0px 0px 50% 0px;
				-webkit-border-radius: 0px 0px 50% 0px;
				-moz-border-radius: 0px 0px 50% 0px;
				border-bottom: 4px solid #ffffff;
			}
			#div-cover{
				color: white;
				max-width: 580px;
			}
			.text-cover-title{
				font-family: arial;
				font-size: 3rem;
				font-weight: bold;
			}
			#text-cover{
				font-family: arial;
				font-size: 1rem;
				font-style: normal;
			}
		</style>
	</head>

	<body>
		<div class="cover">
			<div id="div-cover">		
				<?php 
					if ($page == "index") {
						echo "<p class=\"text-cover-title\">Departamento de Gestión Tecnológica y Vinculación</p>";
						echo "<p id=\"text-cover\">Podras encontrar, la página de Promoción Profesional, Servicio Social y Seguimiento de Egresados así como Reportes y Encuestas. Tambien puedes ver la sección de Noticias.</p>";
					} 
					elseif ($page == "servicio") {
						echo "<p class=\"text-cover-title\">Servicio Social</p> <br>";
						echo "<p id=\"text-cover\">Es la actividad profesional que el estudiante realiza en una institución gubernamental de tal forma que su aportación a la sociedad tiene reciprocidad en su formación profesional, identificando problemáticas y resolviéndolas, generando una conciencia de servicio, solidaridad y compromiso con la sociedad.</p>";
					}
					elseif($page=="promocion"){
						echo "<p class=\"text-cover-title\">Servicio de Promoción Profesional</p>";
						echo "<p id=\"text-cover\">Diferentes programas, para estudiantes con diferentes empresas, revisa los programas para este periodo escolar.</p>";
					}
					elseif($page=="bolsa"){
						echo "<p class=\"text-cover-title\">Bolsa de Trabajo del ITMorelia</p>";
						echo "<p id=\"text-cover\">Aquí podrás encontrar ofertas laborales para diferentes áreas profesionales, así como oportunidades para residentes profesionales y servidores sociales. Nuestro objetivo es ofrecer un ambiente de trabajo dinámico y desafiante, que fomente el crecimiento personal y profesional de nuestros colaboradores.</p>";
					}
					elseif($page=="egresados"){
						echo "<p class=\"text-cover-title\">Seguimiento a Egresados</p> <br>";
						echo "<p id=\"text-cover\">Podrás disfrutar de los videos de los egresados en diferentes partes del mundo, además de ver los reportes de seguimiento a egresados, #PonysParaElMundo</p>";
					}
				?>
			</div>
		</div>
	</body>
</html>
