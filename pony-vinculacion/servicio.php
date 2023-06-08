<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Servicio Social</title>
		<link rel="shortcut icon" href="images/icons/favicon.png">
		<link rel="stylesheet" href="css/service.css">
		<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v16.0" nonce="ddg5W2SQ"></script>
	</head>

	<body>

		<header>
            <?php 
				$userLevel=null;
				include("header.php");?>
        </header>

		<?php include("chat.php"); ?>
		
        <?php 
			$page="servicio";
			include("cover.php"); 
		?>

		<div class="pasos">
			<p>Pasos para el proceso del Servicio Social</p>
		</div>

		<div class="card-left">
			<img src="images/servicio/requisitos.png" align="left">
			<div>
				<p class="card-title">Requisitos para realizar el servicio social</p>
				<ul>
					<li>Cumplir el 70% de avance academico.</li>
					<li>Registrase en el formulario que se indique.</li>
					<li>Tomar la platica de inducción del SS.</li>
					<li>Tiempo mínimo para realizar el servicio social, 6 meses y máximo 2 años</li>
					<li>500 horas en total (480 horas en la dependecia que elija y 20 horas de servicio comunitario) </li>
				</ul>
			</div>
		</div>

		<div class="right">
			<div class="textRight">
				<p class="card-title">Liberación del servicio comunitario 20 hrs.</p>
				<ol>
					<li>Busca las, convocatorias en nuestro portal de facebook.</li>
					<li> Llenar los formularios corresponientes en Google Forms.</li>
					<li>Acudir al lugar, fecha y hora establecida de la Actividad.</li>
					<li>Llenar una hoja con tus datos nombre completo, número de control, carrera y un celular.</li>
				</ol>
				<p class="card-boldText">Puedes realizar el servicio comunitario al final o durante el proceso del servicio social</p>
				<p class="card-boldText">¡NOS PONDREMOS EN CONTACTO CONTIGO!</p>
			</div>
			<img src="images/servicio/comunitario.jpeg" align="right" class="card-right-img">
		</div>

		<div class="card-left">
			<img src="images/servicio/expediente.jpeg" align="left">
			<div>
				<p class="card-title">Requisitos para abrir expediente</p>
				<ul>
					<li>Copia del Acta de Nacimiento.</li>
					<li>Carta de Aceptación.</li>
					<li>Constancia de avance académico.</li>
					<li>Carta solicitud.</li>
					<li>Carta Compromiso.</li>
				</ul>
			</div>

			<div class="buttons" style="margin-left: 10%;">
				<a href="documents/solicitudInternaServicio.docx" download="ITMORELIA-IT-VI-002-02 SOLICITUD INTERNA DE SERVIDORES SOCIALES.docx"><button>Solicitud Interna</button></a>
				<a href="documents/solicitudExternaServicio.docx" download="ITMORELIA-IT-VI-002-01 SOLICITUD EXTERNA DE SERVIDORES SOCIALES.docx"><button>Solicitud Externa</button></a>
			</div>
		</div>

		<div class="right">
			<div class="textRight">
				<p class="card-title">Reportes bimestrales</p>
				<p class="text">Aquí puedes descargar los reportes Bimestrales que debes entregar en el transcurso del semestre en curso de tu Servicio Social.<br>Una vez llenado estos reportes deben ser subidos a tu carperta compartida</p>
				<p class="card-boldText">No olvides enviarlos a tiempo.</p>
			</div>

			<div class="buttons">
				<a href="/documents/reporteServicio.docx" download="ITMORELIA-IT-VI-002-05 REPORTE Y EVALUACION DE SERVICIO SOCIAL.docx"><button>Reporte Bimestral</button></a>
			</div>

			<img src="images/servicio/reportes.png" align="right" class="card-right-img">
		</div>

		<div class="card-left">
			<img src="images/servicio/carta.png" align="left">
			<div class="text-left">
				<p class="card-title">Constancias de termino</p>
				<p class="text">Una vez que hayas concluido tu trámite, es importante que tengas en cuenta que la constancia de término correspondiente será subida a tu carpeta compartida en un plazo de tiempo razonable.<br>Recuerda que mantener un buen seguimiento de tus trámites y la documentación relacionada es clave para evitar inconvenientes y asegurar que todo se lleve a cabo de manera correcta y oportuna.</p>
				<p class="card-boldText">¡Mucho éxito en tu trámite!</p>
			</div>
		</div>

		<p class="titulo">Redes sociales</p>
		<hr class="line">
		<div class="content-facebook">
			<div class="fb-page" data-href="https://www.facebook.com/itm.vinculacion.promocion.profesional" data-tabs="timeline" data-width="305" data-height="430" data-small-header="false" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/itm.vinculacion.promocion.profesional" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/itm.vinculacion.promocion.profesional">ITM Vinculación - Promoción Profesional</a></blockquote></div>

			<div class="fb-page" data-href="https://www.facebook.com/ITMSeguimientoDeEgresadosOficial/" data-tabs="timeline" data-width="305" data-height="430" data-small-header="false" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/itm.vinculacion.promocion.profesional" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/itm.vinculacion.promocion.profesional">ITM Vinculación - Promoción Profesional</a></blockquote></div>

			<div class="fb-page" data-href="https://www.facebook.com/profile.php?id=100067030401583" data-tabs="timeline" data-width="305" data-height="430" data-small-header="false" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/itm.vinculacion.promocion.profesional" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/itm.vinculacion.promocion.profesional">ITM Vinculación - Promoción Profesional</a></blockquote></div>
		</div>

		<?php include("footer.php"); ?>

		
	</body>
</html>