<?php
// Verificar si la cookie de vinculación está presente
if (isset($_COOKIE['empresa']) || isset($_COOKIE['vinculacion'])) {
    // La cookie de vinculación está presente, se permite el acceso
    // Aquí puedes colocar el código que deseas ejecutar para las personas con la cookie de vinculación
    if (isset($_COOKIE['empresa'])) {
        $folioEmpresa = " = " . openssl_decrypt($_COOKIE['empresa'], 'AES-256-CBC', 'aeroespacial', 0, '0123456789abcdef');
        $carrera = " IS NOT NULL";
        $showButton = true;
        $modifyButton = true;
        $deleteButton = true;
        $acceptButton = false;
        $rejectButton = false;
    } else if (isset($_COOKIE['vinculacion']) && openssl_decrypt($_COOKIE['carrera'], 'AES-256-CBC', 'aeroespacial', 0, '0123456789abcdef') != 0) {
        include("connect.php");
        $carreraId = openssl_decrypt($_COOKIE['carrera'], 'AES-256-CBC', 'aeroespacial', 0, '0123456789abcdef');

        // Obtener el nombre de la carrera de la base de datos
        $sql = "SELECT nombre FROM carrera WHERE id_carrera = '$carreraId'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $carrera = "LIKE '%" . $row['nombre'] . "%'";
            $showButton = true;
            $modifyButton = false;
            $deleteButton = false;
            $acceptButton = false;
            $rejectButton = false;
        } else {
            // El ID de la carrera no se encontró en la base de datos
            $carrera = " IS NOT NULL";
            $showButton = false;
            $modifyButton = false;
            $deleteButton = false;
            $acceptButton = false;
            $rejectButton = false;
        }
        $folioEmpresa = " IS NOT NULL";
    } else if (isset($_COOKIE['vinculacion']) && openssl_decrypt($_COOKIE['carrera'], 'AES-256-CBC', 'aeroespacial', 0, '0123456789abcdef') == 0) {
        $carrera = " IS NOT NULL";
        $folioEmpresa = " IS NOT NULL";
        $showButton = true;
        $modifyButton = true;
        $deleteButton = true;
        $acceptButton = true;
        $rejectButton = true;
    }
} else {
    // La cookie de vinculación no está presente, se deniega el acceso
    // Aquí puedes colocar el código que deseas ejecutar para las personas sin la cookie de vinculación
    header("Location: login");
    exit();
}
?>

<?php
include("connect.php");

if (isset($_GET['search'])) {
    $terminoBusqueda = $_GET['search'];
} else {
    $terminoBusqueda = "";
}

// Variables para la paginación
$registrosPorPagina = 10;
$paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$offset = ($paginaActual - 1) * $registrosPorPagina;
$fechaActual = date('Y-m-d'); // Obtén la fecha actual

// Realizar la consulta para obtener las vacantes
$sql = "SELECT v.id_vacante, v.titulo, v.descripcion, e.nombre_comercial, v.servicio_social, v.practicas_profesionales, v.vacante_laboral, v.carreras, v.visible, e.logo_empresa, v.aceptada, v.fecha_cierre
    FROM vacante v
    INNER JOIN empresa e ON v.id_empresa = e.folio
    WHERE (v.titulo LIKE '%$terminoBusqueda%' OR v.descripcion LIKE '%$terminoBusqueda%' OR e.nombre_comercial LIKE '%$terminoBusqueda%')
    AND e.folio $folioEmpresa AND v.carreras $carrera AND v.fecha_cierre >= $fechaActual
    ORDER BY v.id_vacante DESC
    LIMIT $registrosPorPagina OFFSET $offset";

$result = $conn->query($sql);

// Verificar si se encontraron vacantes
if ($result->num_rows > 0) {
    // Generar el código HTML para cada vacante
    while ($row = $result->fetch_assoc()) {
        $id_vacante = $row["id_vacante"];
        $titulo = $row["titulo"];
        $nombreEmpresa = $row["nombre_comercial"];
        $servicioSocial = $row["servicio_social"];
        $practicasProfesionales = $row["practicas_profesionales"];
        $vacanteLaboral = $row["vacante_laboral"];
        $descripcion = nl2br(str_replace('\n', "\n", htmlspecialchars($row["descripcion"])));
        $carreras = $row["carreras"];
        $visible = $row["visible"];
        $logo = $row['logo_empresa'];

        // Generar el código HTML para la vacante
        echo "<div class=\"modificarVacante\">";
        echo '<div class="vacanteModify">';
        echo '<div class="superior">';
        if ($logo != null) {
            echo '<img src="data:image/jpeg;base64,' . base64_encode($logo) . '" alt="Imagen">';
        } else {
            echo '<img src="images/default/empresaDefault.png">';
        }
        echo '<div>';
        echo '<h1>' . $titulo . '</h1>';
        echo '<h2>' . $nombreEmpresa . '</h2>';
        echo '</div>';
        echo '<ul>';
        if ($servicioSocial == 1) {
            echo '<li>Servicio Social</li>';
        }
        if ($practicasProfesionales == 1) {
            echo '<li>Practicas Profesionales</li>';
        }
        if ($vacanteLaboral == 1) {
            echo '<li>Vacante Laboral</li>';
        }
        echo '</ul>';
        echo '</div>';
        echo '<div class="inferior">';
        echo '<ul>';

        $array = json_decode($carreras, true);

        if (is_array($array)) {
            for ($i = 0; $i < count($array); $i++) {
                echo '<li>' . $array[$i] . '</li>';
            }
        } else {
            echo "";
        }

        echo '</ul>';
        echo '<p>' . $descripcion . '</p>';
        echo '</div>';
        echo '</div>';
        echo "<div class=\"buttons\">";
        
        if ($showButton) {
            echo "<form method=\"post\" action=\"methods/methodMostrarVacante.php\">
                  <input type=\"hidden\" name=\"vacante_id\" value=\"$id_vacante\">
                  <button type=\"submit\" name=\"mostrar\">";
            if ($visible == 0) {
                echo "Mostrar";
            } else {
                echo "Ocultar";
            }
            echo "</button> </form>";
        }
        
        if ($modifyButton) {
            echo "<form method=\"post\" action=\"modificarVacanteGuardar?id_vacante=$id_vacante\">
                  <input type=\"hidden\" name=\"vacante_id\" value=\"$id_vacante\">
                  <button type=\"submit\" name=\"mostrar\">Modificar</button>
                </form>";
        }
        
        if ($deleteButton) {
            echo "<form method=\"post\" action=\"methods/methodEliminarVacante.php\">
                  <input type=\"hidden\" name=\"vacante_id\" value=\"$id_vacante\">
                  <button type=\"submit\" name=\"mostrar\">Eliminar</button>
                </form>";
        }
        
        // Botón "Aceptar"
        if ($acceptButton && $row["aceptada"] != 1) {
            echo "<form method=\"post\" action=\"methods/methodAceptarVacante.php\">
                  <input type=\"hidden\" name=\"vacante_id\" value=\"$id_vacante\">
                  <button type=\"submit\" name=\"mostrar\">Aceptar</button>
                </form>";
        } elseif ($acceptButton && $row["aceptada"] == 1) {
            echo "<button disabled>Aceptar</button>";
        }
        
        if ($rejectButton) {
            echo "<form method=\"post\" action=\"methods/methodRechazarVacante.php\">
                  <input type=\"hidden\" name=\"vacante_id\" value=\"$id_vacante\">
                  <button type=\"submit\" name=\"mostrar\">Rechazar</button>
                </form>";
        }
        
        echo "
        </div>
        </div>
        </div>";
    }


    // Generar la paginación
    $sql = "SELECT COUNT(*) AS total FROM vacante v
            INNER JOIN empresa e ON v.id_empresa = e.folio
            WHERE (v.titulo LIKE '%$terminoBusqueda%' OR v.descripcion LIKE '%$terminoBusqueda%' OR e.nombre_comercial LIKE '%$terminoBusqueda%')
            AND e.folio $folioEmpresa AND v.carreras $carrera";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $totalRegistros = $row['total'];
    $totalPaginas = ceil($totalRegistros / $registrosPorPagina);

    echo '<div class="paginacion">';
    echo '<ul>';
    for ($i = 1; $i <= $totalPaginas; $i++) {
        echo "<li><a href=\"?pagina=$i&search=$terminoBusqueda\">$i</a></li>";
    }
    echo '</ul>';
    echo '</div>';
} else {
    echo "No se encontraron vacantes.";
    $conn->close();
}
?>
