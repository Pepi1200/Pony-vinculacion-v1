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

// Realizar la consulta para obtener las empresas con aceptada = 0
$sql = "SELECT e.folio, e.rfc, e.nombre_comercial, e.razon_social, e.tipo_empresa, e.sector, e.giro, e.numero_empleados,
        e.direccion_empresa, e.descripcion_empresa, e.sitio_web, e.nombre_encargado, e.puesto_encargado, e.telefono_empresa, e.correo_empresa,
        e.logo_empresa
        FROM empresa e
        WHERE e.status = 0 
        ORDER BY e.folio ASC
        LIMIT $registrosPorPagina OFFSET $offset";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Generar el código HTML para cada empresa
    while ($row = $result->fetch_assoc()) {
        $folioEmpresa = $row["folio"];
        $rfc = $row["rfc"];
        $nombreComercial = $row["nombre_comercial"];
        $razonSocial = $row["razon_social"];
        $tipoEmpresa = $row["tipo_empresa"];
        $sector = $row["sector"];
        $giro = $row["giro"];
        $numeroEmpleados = $row["numero_empleados"];
        $direccion = $row["direccion_empresa"];
       $descripcion = nl2br(str_replace('\n', "\n", htmlspecialchars($row["descripcion_empresa"])));
        $sitioWeb = $row["sitio_web"];
        $nombreEncargado = $row["nombre_encargado"];
        $puestoEncargado = $row["puesto_encargado"];
        $telefono = $row["telefono_empresa"];
        $correo = $row["correo_empresa"];
        $logo = $row['logo_empresa'];

        // Generar el código HTML para la empresa
        echo '<div class="empresa">';
        if($logo != null){echo '<img src="data:image/jpeg;base64,' . base64_encode($logo) . '" alt="Imagen">';}
        else{echo '<img src="images/default/empresaDefault.png">';}
        echo '<div class="datos">';
        echo '<p>RFC: ' . $rfc . '</p>';
        echo '<p>Nombre Comercial: ' . $nombreComercial . '</p>';
        echo '<p>Razón Social: ' . $razonSocial . '</p>';
        echo '<p>Tipo de Empresa: ' . $tipoEmpresa . '</p>';
        echo '<p>Sector: ' . $sector . '</p>';
        echo '<p>Giro: ' . $giro . '</p>';
        echo '<p>Número de Empleados: ' . $numeroEmpleados . '</p>';
        echo '</div>';
        echo '<div class="datos">';
        echo '<p>Dirección: ' . $direccion . '</p>';
        echo '<p>Descripción: ' . $descripcion . '</p>';
        echo '<p>Sitio Web: ' . $sitioWeb . '</p>';
        echo '<p>Nombre de la Persona Encargada: ' . $nombreEncargado . '</p>';
        echo '<p>Puesto de la Persona Encargada: ' . $puestoEncargado . '</p>';
        echo '<p>Teléfono: ' . $telefono . '</p>';
        echo '<p>Correo: ' . $correo . '</p>';
        echo '</div>';
        echo '<div class="buttons">';
        echo '<form method="post" action="methods/methodAceptarEmpresa.php">';
        echo '<input type="hidden" name="folio_empresa" value="' . $folioEmpresa . '">';
        echo '<button type="submit" name="aceptarEmpresa">Aceptar</button>';
        echo '</form>';
        echo '<form method="post" action="methods/methodRechazarEmpresa.php">';
        echo '<input type="hidden" name="folio_empresa" value="' . $folioEmpresa . '">';
        echo '<button type="submit" name="rechazarEmpresa">Rechazar</button>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
    }

    // Generar la paginación
    $sql = "SELECT COUNT(*) AS total FROM empresa WHERE status = 0";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $totalRegistros = $row['total'];
    $totalPaginas = ceil($totalRegistros / $registrosPorPagina);

    echo '<div class="pagination">';
    for ($i = 1; $i <= $totalPaginas; $i++) {
        echo '<a href="empresas?pagina=' . $i . '">' . $i . '</a>';
    }
    echo '</div>';
} else {
    echo '<p>No se encontraron empresas.</p>';
}
$conn->close();
?>