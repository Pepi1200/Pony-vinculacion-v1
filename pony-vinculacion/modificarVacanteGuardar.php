<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Modificar Vacante</title>
        <link rel="shortcut icon" href="images/icons/favicon.png">
        <link rel="stylesheet" type="text/css" href="css/registrarVacante.css?v=6">
        <?php include("methods/methodUpdateVacante.php") ?>
    </head>

    <body>

        <?php include 'header.php';?>

        <h1 class= "titulo">Modificar Vacante</h1>
        <hr class="line">

        <form class="content" method="POST" action="<?php echo $save; ?>">
            <div class="half">
                <input type="text" placeholder="Titulo" style="height: 40px;" name="titulo" autocomplete="off" value="<?php echo $titulo; ?>">

                <textarea type="text" placeholder="Descripción" style="height: 200px;" name="descripcion" autocomplete="off"><?php echo $descripcion; ?></textarea>

                <input placeholder="Fecha de cierre" class="textbox-n" type="text" onfocus="(this.type='date')" id="date" style="height: 40px;" name="fechaCierre" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+6 months')); ?>" autocomplete="off" value="<?php echo $fecha_cierre; ?>">

                <input type="text" placeholder="Datos de contacto" style="height: 90px;" name="datosContacto" autocomplete="off" value="<?php echo $datos_contacto; ?>">

                <input type="text" placeholder="Categoría" style="height: 90px;" name="categoria" autocomplete="off" value="<?php echo $categoria; ?>">
                <?php 
                    if (isset($_COOKIE['vinculacion'])) {
                        // La cookie de vinculación está presente, se permite el acceso
                        echo '<input type="text" placeholder="Folio de la empresa" style="height: 40px;" name="idEmpresa" autocomplete="off" value="'.$id_empresa.'">';
                    }
                 ?>
            </div>

            <div class="halfLeft">
                <h1 class="titulo">Seleccione las carreras de interes</h1>
                <hr class="line">

                <div class="carreras">
                    <?php
                        include("methods/connect.php");

                        // Obtener los valores seleccionados de la base de datos
                        $sql = "SELECT carreras FROM vacante WHERE id_vacante = '$id_vacante'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $carreras = json_decode($row["carreras"], true); // Decodificar la cadena JSON como un arreglo

                            // Realizar la consulta de las carreras disponibles
                            $sqlCarreras = "SELECT nombre FROM carrera WHERE activa = 1 ORDER BY nombre ASC";
                            $resultCarreras = $conn->query($sqlCarreras);

                            // Verificar si se encontraron registros
                            if ($resultCarreras->num_rows > 0) {
                                // Generar los checkboxes
                                while ($rowCarreras = $resultCarreras->fetch_assoc()) {
                                    $nombreCarrera = $rowCarreras["nombre"];
                                    $isChecked = false;

                                    if (!is_null($carreras)) {
                                        $isChecked = in_array($nombreCarrera, $carreras);
                                    }

                                    echo '<label>';
                                    echo '<input type="checkbox" name="carreras[]" value="' . $nombreCarrera . '"';
                                    if ($isChecked) {
                                        echo ' checked'; // Marcar como seleccionado si está presente en las carreras seleccionadas
                                    }
                                    echo '>';
                                    echo $nombreCarrera;
                                    echo '</label>';
                                }
                            } else {
                                echo "No se encontraron carreras.";
                            }

                        }

                        // Cerrar la conexión
                        $conn->close();
                    ?>

                </div>

                <h1 class="titulo">Seleccione las opciones de desarrollo de interes</h1>
                <hr class="line">
                <div class="desarrollo">
                    <label>
                        <input type="checkbox" id="servicio" name="servicio" value="1" <?php if($servicio_social==1)echo "checked"; ?>>
                        Servicio Social
                    </label>

                    <label>
                        <input type="checkbox" id="practicas" name="practicas" value="1" <?php if($practicas_profesionales==1)echo "checked"; ?>>
                        Practicas Profesionales
                    </label>

                    <label>
                        <input type="checkbox" id="trabajo" name="trabajo" value="1" <?php if($vacante_laboral==1)echo "checked"; ?>>
                        Vacante laboral
                    </label>
                </div>

                <button class="save-boton">
                <span class="save-texto">Guardar</span>
                </button>
            </div>
        </form>

        <footer>
            <?php include 'footer.php';?>
        </footer>
    </body>
</html>