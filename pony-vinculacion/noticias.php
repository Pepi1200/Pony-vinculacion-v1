<style type="text/css" media="screen">
    .carousel-container {
      position: relative;
      width: 95%;
      margin: 0 auto;
      margin-top: 30px;
    }

    .carousel {
      margin-top: 30px;
      margin-bottom: 30px;
      display: flex;
      height: 400px;
      border-radius: 20px;
      box-shadow: 0px 0px 2px 2px rgba(0, 0, 0, 0.2);
    }

    .carousel div{
        width: 100%;
    }

    .carousel img {
      width: 100%;
      height: 400px;
      border-radius: 20px;
      background-size: cover;
      margin: 0;
    }

    .carouselButton {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background: transparent;
      border: none;
    }

    #retroceder {
      left: 10px;
    }

    #avanzar {
      right: 10px;
    }
</style>

<div class="carousel-container">
    <button id="retroceder" class="carouselButton"><img src="images/icons/anterior.png" height="40px" width="40px"></button>
    <div class="carousel">
        <div id="imagen"></div>
    </div>
    <button id="avanzar" class="carouselButton"><img src="images/icons/proximo.png" height="40px" width="40px"></button>
</div>

<script>
    window.onload = function () {
        const IMAGENES = [
            <?php 
            include("methods/connect.php");

            $sql = "SELECT * FROM noticias ORDER BY id DESC";
            $result = $conn->query($sql);

            // Verificar si se encontraron registros
            if ($result->num_rows > 0) {
                // Generar las opciones de selección
                while ($row = $result->fetch_assoc()) {
                    $imagenBlob = $row["imagen"];
                    $imagenData = base64_encode($imagenBlob);
                    $imagenSrc = "data:image/jpeg;base64," . $imagenData;
                    $link = $row["enlace"];

                    echo "{ src: '$imagenSrc', link: '$link' },";
                }
            } else {
                echo "{ src: 'images/icons/errorNoticias.png', link: '' },";
            }

            // Cerrar la conexión
            $conn->close();
            ?>
        ];
        const TIEMPO_INTERVALO_MILESIMAS_SEG = 10000;
        let posicionActual = 0;
        let $botonRetroceder = document.querySelector('#retroceder');
        let $botonAvanzar = document.querySelector('#avanzar');
        let $imagen = document.querySelector('#imagen');
        let intervalo;

        function pasarFoto() {
            if (posicionActual >= IMAGENES.length - 1) {
                posicionActual = 0;
            } else {
                posicionActual++;
            }
            renderizarImagen();
        }

        function retrocederFoto() {
            if (posicionActual <= 0) {
                posicionActual = IMAGENES.length - 1;
            } else {
                posicionActual--;
            }
            renderizarImagen();
        }

        function renderizarImagen() {
            const imagenActual = IMAGENES[posicionActual];
            $imagen.innerHTML = `<a href="${imagenActual.link}" target="_blank"><img src="${imagenActual.src}" alt="Imagen"></a>`;
        }

        // Eventos
        $botonAvanzar.addEventListener('click', pasarFoto);
        $botonRetroceder.addEventListener('click', retrocederFoto);

        // Iniciar
        renderizarImagen();
        intervalo = setInterval(pasarFoto, TIEMPO_INTERVALO_MILESIMAS_SEG);
    } 
</script>
