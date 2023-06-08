<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gestión tecnológica</title>
        <link rel="shortcut icon" href="images/icons/favicon.png">
        <link rel="stylesheet" href="css/index.css?v=3">
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v16.0" nonce="ddg5W2SQ"></script>
    </head>

    <body>
        <header>
            <?php 
                $userLevel=null;
                include("header.php");?> 
        </header>

        <?php include("chat.php"); ?>

        <!--Banner, cambiar texto-->
        <div class="container">
            <?php 
                $page="index";
                include("cover.php"); 
            ?>

        <div class="cont">

            <a href="promocion">
                <div class="clas">
                    <img src="images/index/Promocion.png" alt="Promoción">
                    <h1>Promoción Profesional</h1>
                    <p>Conoce los diferentes programas como el TechTalent, SAIL, 
                        BolsaTEC, entre muchos otros Tu oportunidad te esta esperando.</p>
                </div>
            </a>

            <a href="servicio">
                <div class="clas">
                    <img src="images/index/Servicio.png" alt="servicio">
                    <h1>Servicio Social</h1>
                    <p>Si piensas realizar tu servicio social en el siguiente periodo, 
                        revisa los Requisitos y pregunta por tus dudas a nuestro ChatBot.</p>
                </div>
            </a>
            
            <a href="egresados">
                <div class="clas">
                    <img src="images/index/Egresados.png" alt="Egresados">
                    <h1>Seguimiento a Egresados</h1>
                    <p>Conoce a nuestros PONYS egresado, realiza tú encuesta de egresados
                         y conoce los reportes estadisticos de nuestros egresados.</p>
                </div>
            </a>
        </div>

        <p class="titulo">Noticias</p>
        <hr class="line">

        <?php include("noticias.php") ?>

        <h1 class="titulo">Redes sociales</h1>
        <hr class="line">

        <div class="content-facebook">

            <div class="fb-page" data-href="https://www.facebook.com/itm.vinculacion.promocion.profesional" data-tabs="timeline" data-width="305" data-height="430" data-small-header="false" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/itm.vinculacion.promocion.profesional" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/itm.vinculacion.promocion.profesional">ITM Vinculación - Promoción Profesional</a></blockquote></div>

            <div class="fb-page" data-href="https://www.facebook.com/ITMSeguimientoDeEgresadosOficial/" data-tabs="timeline" data-width="305" data-height="430" data-small-header="false" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/itm.vinculacion.promocion.profesional" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/itm.vinculacion.promocion.profesional">ITM Vinculación - Promoción Profesional</a></blockquote></div>

            <div class="fb-page" data-href="https://www.facebook.com/profile.php?id=100067030401583" data-tabs="timeline" data-width="305" data-height="430" data-small-header="false" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/itm.vinculacion.promocion.profesional" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/itm.vinculacion.promocion.profesional">ITM Vinculación - Promoción Profesional</a></blockquote></div>
        </div>

        <footer>
            <?php include("footer.php") ?>
        </footer>

    </body>
</html>