<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Publicar Vacante</title>
        <link rel="shortcut icon" href="images/icons/favicon.png">
        <link rel="stylesheet" type="text/css" href="css/registrarVacante.css?v=6">
        <?php
        // Verificar si la cookie de vinculación está presente
        if (isset($_COOKIE['empresa']) || isset($_COOKIE['vinculacion'])) {
            // La cookie de vinculación está presente, se permite el acceso
            // Aquí puedes colocar el código que deseas ejecutar para las personas con la cookie de vinculación
        } else {
            // La cookie de vinculación no está presente, se deniega el acceso
            // Aquí puedes colocar el código que deseas ejecutar para las personas sin la cookie de vinculación
            header("Location: login.php");
            exit();
        }
        ?>
    </head>

    <body>
        <?php include 'header.php';?>

        <h1 class= "titulo">Registrar Vacante</h1>
        <hr class="line">

        <form class="content" method="POST" action="methods/methodPublicarVacante.php">
            <div class="half">
                <input type="text" placeholder="Titulo" style="height: 40px;" name="titulo" autocomplete="off">
                <textarea type="text" placeholder="Descripción" style="height: 200px;" name="descripcion" autocomplete="off"></textarea>
                <input placeholder="Fecha de cierre" class="textbox-n" type="text" onfocus="(this.type='date')" id="date" style="height: 40px;" name="fechaCierre" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+6 months')); ?>" autocomplete="off">
                <input type="text" placeholder="Datos de contacto" style="height: 90px;" name="datosContacto" autocomplete="off">
                <input type="text" placeholder="Palabras clave" style="height: 90px;" name="categoria" autocomplete="off">
                <?php 
                    if (isset($_COOKIE['vinculacion'])) {
                        // La cookie de vinculación está presente, se permite el acceso
                        echo '<input type="text" placeholder="Folio de la empresa" style="height: 40px;" name="idEmpresa" autocomplete="off">';
                    }
                 ?>
            </div>

            <div class="halfLeft">
                <h1 class="titulo">Seleccione las carreras de interes</h1>
                <hr class="line">

                <div class="carreras">
                    <?php
                        include("methods/connect.php");
                        // Realizar la consulta
                        $sql = "SELECT nombre FROM carrera WHERE activa = 1 ORDER BY nombre ASC";
                        $result = $conn->query($sql);

                        // Verificar si se encontraron registros
                        if ($result->num_rows > 0) {
                            // Generar los checkboxes
                            while ($row = $result->fetch_assoc()) {
                                $nombreCarrera = $row["nombre"];
                                echo '<label>';
                                echo '<input type="checkbox" name="carreras[]" value="' . $nombreCarrera . '">';
                                echo $nombreCarrera;
                                echo '</label>';
                            }
                        } else {
                            echo "No se encontraron carreras.";
                        }

                        // Cerrar la conexión
                        $conn->close();
                    ?>

                </div>

                <h1 class="titulo">Seleccione las opciones de desarrollo de interes</h1>
                <hr class="line">
                <div class="desarrollo">
                    <label>
                        <input type="checkbox" id="servicio" name="servicio" value="1">
                        Servicio Social
                    </label>

                    <label>
                        <input type="checkbox" id="practicas" name="practicas" value="1">
                        Practicas Profesionales
                    </label>

                    <label>
                        <input type="checkbox" id="trabajo" name="trabajo" value="1">
                        Vacante laboral
                    </label>
                </div>

                <button class="publicar-boton">
                <span class="publicar-texto">Publicar</span>
                </button>
            </div>
        </form>

        <footer>
            <?php include 'footer.php';?>
        </footer>
    </body>
</html>