<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/chat.css">
    </head>

    <body>
        <div class="chatbot-container" id="chatbot-container">

            <div id="header">
                <img src="images/icons/pony.png">
                <h1>Pony-Chat</h1>
            </div>

            <div id="chatbot">
                <div id="conversation">
                  <div class="chatbot-message">
                    <p class="chatbot-text">Bienvenido a este tu PonyChat, podemos ayudarte unicamente con tramites del servicio social y para la busqueda de tu jefe de vinculación, dependendiendo de tu carrera</p>
                  </div>
                </div>

            <form id="input-form">
                <message-container>
                    <input id="input-field" type="text" placeholder="Haz una pregunta..." autocomplete="off">
                    <button id="submit-button" type="submit">
                      <img class="send-icon" src="images/icons/enviarMensaje.png" alt="">
                    </button>
                </message-container>   
            </form>

                
            </div>
        </div>

        <div>
           <button class="chatButton" id="chatButton"></button>
        </div> 

        <script src="js/chat.js"></script>
    </body>
</html>