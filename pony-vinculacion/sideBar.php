<style type="text/css">
	.sideBar {
        width: 200px;
        height: 80vh;
        background: transparent;
        position: fixed;
        margin-left: 100%;
        overflow-y: scroll;
    }

	.sideBar a{
		color: white;
		text-decoration: none;
		font-family: 'arial';
		font-size: 16px;
		flex-wrap: wrap;
	}

	.sideBar ul{
		list-style: none;
		margin-top: 0;
	}

	.sideBar li{
		background-color: #1A386A;
		border-bottom: 1px solid #ffffff;
		border-top: 1px solid #ffffff;
		height: 70px;

		display: flex;
		justify-content: center;
		align-items: center;
	}

	.sideBar li:hover{
		transform: translateX(-6%);
		transition: transform 0.25s;
	}
</style>

<div class="sideBar">
	<ul class="menu">
		<?php
	        // Menu lateral Empresa
	        if (isset($_COOKIE['empresa'])) {
	        	echo '<li><a href="index.php" tabindex="-1">Departamento de Gestión Estrategica</a></li>';
	        	echo '<li><a href="servicio" tabindex="-1">Servicio Social</a></li>';
	        	echo '<li><a href="Promocion" tabindex="-1">Promocion profesional</a></li>';
	        	echo '<li><a href="egresados" tabindex="-1">Seguimiento a Egresados</a></li>';
	        	echo '<li><a href="bolsa" tabindex="-1">Bolsa de trabajo</a></li>';
	        	echo '<li><a href="registrarVacante" tabindex="-1">Publicar Vacante</a></li>';
	        	echo '<li><a href="modificarVacante" tabindex="-1">Modificar Vacantes</a></li>';
	        	echo '<li><a href="methods/methodLogout" tabindex="-1">Cerrar Sesion</a></li>';
	        }
	        else if (isset($_COOKIE['vinculacion'])) {
	        	echo '<li><a href="index.php" tabindex="-1">Departamento de Gestión Estrategica</a></li>';
	        	echo '<li><a href="servicio" tabindex="-1">Servicio Social</a></li>';
	        	echo '<li><a href="Promocion" tabindex="-1">Promocion profesional</a></li>';
	        	echo '<li><a href="egresados" tabindex="-1">Seguimiento a Egresados</a></li>';
	        	echo '<li><a href="bolsa" tabindex="-1">Bolsa de trabajo</a></li>';
	        	echo '<li><a href="registrarVacante" tabindex="-1">Publicar Vacante</a></li>';
	        	echo '<li><a href="modificarVacante" tabindex="-1">Modificar Vacantes</a></li>';
	        	echo '<li><a href="empresas" tabindex="-1">Empresas</a></li>';
	        	echo '<li><a href="addNotice" tabindex="-1">Noticias</a></li>';
	        	echo '<li><a href="methods/methodLogout" tabindex="-1">Cerrar Sesion</a></li>';
	        } 
	        else if (isset($_COOKIE['alumno'])) {
	        	echo '<li><a href="index.php" tabindex="-1">Departamento de Gestión Estrategica</a></li>';
	        	echo '<li><a href="servicio" tabindex="-1">Servicio Social</a></li>';
	        	echo '<li><a href="Promocion" tabindex="-1">Promocion profesional</a></li>';
	        	echo '<li><a href="egresados" tabindex="-1">Seguimiento a Egresados</a></li>';
	        	echo '<li><a href="bolsa" tabindex="-1">Bolsa de trabajo</a></li>';
	        	echo '<li><a href="methods/methodLogout" tabindex="-1">Cerrar Sesion</a></li>';
	        } 
	        else{
	        	echo '<li><a href="registro" tabindex="-1">Registrate</a></li>';
	        	echo '<li><a href="index.php" tabindex="-1">Departamento de Gestión Estrategica</a></li>';
	        	echo '<li><a href="servicio" tabindex="-1">Servicio Social</a></li>';
	        	echo '<li><a href="Promocion" tabindex="-1">Promocion profesional</a></li>';
	        	echo '<li><a href="egresados" tabindex="-1">Seguimiento a Egresados</a></li>';
	        }

	   ?>
	</ul>
</div>
