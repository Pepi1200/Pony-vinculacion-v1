	<!DOCTYPE html>
	<html>

		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="css/header.css">
			<link rel="shortcut icon" href="images/icons/favicon.png">
		</head>

		<body>
			<header>
				<div id="logo">
					<a id="logo" href="index.php" >
						<img src="images/logos/logoHeaderDepartamento.png"
						height="50" 
						width="50" align="left">
					</a>
				</div>

				<?php if (isset($_COOKIE['vinculacion']) || isset($_COOKIE['alumno']) || isset($_COOKIE['empresa'])) {
				    echo '<label>
							<button id="menuButton" class="menuButton" style="margin-left: calc(100% - 150px);">&nbsp</button> 
							</label>';
				} else {
					echo '<a href="login"><button class="loginButton">Iniciar sesion</button></a>';
					echo '<label>
							<button id="menuButton" class="menuButton">&nbsp</button> 
							</label>';
				}
				?>

				
			</header>

			<div class="side" id="side">
				<?php include("sideBar.php") ?>
			</div>

			<script src="js/header.js"></script>
		</body>
	</html>