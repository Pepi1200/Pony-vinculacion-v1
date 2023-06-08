<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Modificar Vacante</title>
        <link rel="stylesheet" type="text/css" href="css/modificarVacante.css?v=1">
        <link rel="shortcut icon" href="images/icons/favicon.png">
    </head>
    <?php
        // Verificar si la cookie de vinculación está presente
        if (isset($_COOKIE['empresa']) || isset($_COOKIE['vinculacion'])) {
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

<body>
    <?php include 'header.php'; ?>

    <h1 class= "titulo">Modificar Vacantes</h1>
    <hr class="line">

    <form class="search" action="modificarVacante.php">
        <input type="text" placeholder="Buscar... " name="search">
        <button>Buscar</button>
    </form>

    <?php include("methods/methodModificarVacante.php"); ?>

    <footer>
        <?php include 'footer.php';?>    
    </footer>
    
</body>
</html>