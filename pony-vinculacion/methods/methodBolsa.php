<?php
include("connect.php");

if (isset($_GET['palabraClave'])) {
  $palabraClave = $_GET['palabraClave'];
} else {
  $palabraClave = "";
}
if (isset($_GET['carrera'])) {
  $carrera = $_GET['carrera'];
} else {
  $carrera = "";
}
if (isset($_GET['opcionesDesarrollo'])) {
  $opcionesDesarrollo = $_GET['opcionesDesarrollo'];
} else {
  $opcionesDesarrollo = "1";
}

$fechaActual = date('Y-m-d'); // Obtén la fecha actual

$desplazamiento = 0; // Variable para desplazamiento de resultados
$vacantesPorPagina = 5; // Número de vacantes a mostrar por página

// Calcular el número total de vacantes
$sqlTotal = "SELECT COUNT(*) AS total FROM vacante v
    WHERE v.titulo LIKE '%$palabraClave%' and v.carreras LIKE '%$carrera%' and $opcionesDesarrollo = 1 AND v.visible=1 AND v.aceptada=1
    AND v.fecha_cierre >= '$fechaActual'";
$resultadoTotal = $conn->query($sqlTotal);
$filaTotal = $resultadoTotal->fetch_assoc();
$totalVacantes = $filaTotal['total'];

$totalPaginas = ceil($totalVacantes / $vacantesPorPagina); // Calcular el número total de páginas

// Obtener el número de página actual
if (isset($_GET['pagina'])) {
  $paginaActual = $_GET['pagina'];
} else {
  $paginaActual = 1;
}

$desplazamiento = ($paginaActual - 1) * $vacantesPorPagina; // Calcular el desplazamiento para la consulta SQL

// Realizar la consulta para obtener las vacantes correspondientes a la página actual
$sql = "SELECT v.id_vacante, v.titulo, v.descripcion, e.nombre_comercial, v.servicio_social, v.practicas_profesionales, v.vacante_laboral, v.carreras, v.visible,v.categoria, v.aceptada, e.logo_empresa, v.datos_contacto
    FROM vacante v
    INNER JOIN empresa e ON v.id_empresa = e.folio
    WHERE (v.titulo LIKE '%$palabraClave%' OR v.descripcion LIKE '%$palabraClave%' OR v.categoria LIKE '%$palabraClave%' OR e.nombre_comercial LIKE '%$palabraClave%' )and v.carreras LIKE '%$carrera%' and $opcionesDesarrollo = 1 AND v.visible=1 AND v.aceptada=1
    AND v.fecha_cierre >= '$fechaActual'
    ORDER BY v.id_vacante DESC
    LIMIT $desplazamiento, $vacantesPorPagina";

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
        $logo = $row['logo_empresa'];
        $datos_contacto = $row['datos_contacto'];

        // Generar el código HTML para la vacante
        echo "<div class=\"modificarVacante\">";
        echo '<div class="vacante">';
        echo '<div class="superior">';
        if($logo != null){echo '<img src="data:image/jpeg;base64,' . base64_encode($logo) . '" alt="Imagen">';}
        else{echo '<img src="images/default/empresaDefault.png">';}
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
        echo '<p>' . $descripcion;
        echo '<br><br> Datos de contacto:<br>' . $datos_contacto . '</p>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "No se encontraron vacantes.";
}

// Generar la paginación
echo '<div class="paginacion">';
echo '<ul>';

// Mostrar enlaces a las páginas disponibles
for ($i = 1; $i <= $totalPaginas; $i++) {
  // Agregar la clase "active" al enlace de la página actual
  $activeClass = ($i == $paginaActual) ? "active" : "";
  echo '<li><a href="bolsa?palabraClave=' . $palabraClave . '&carrera=' . $carrera . '&opcionesDesarrollo=' . $opcionesDesarrollo . '&pagina=' . $i . '" class="' . $activeClass . '">' . $i . '</a></li>';
}

echo '</ul>';
echo '</div>';

// Cerrar la conexión
$conn->close();
?>
