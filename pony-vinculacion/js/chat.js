//Button
const chatButton = document.getElementById('chatButton');
const chatbotContainer = document.getElementById('chatbot-container');
chatbotContainer.style.display='none';

chatButton.addEventListener('click', () => {
  chatButton.classList.toggle('active');

  if (chatbotContainer.style.display === 'none') {
    chatbotContainer.style.display = 'block';
  } 
  else {
    chatbotContainer.style.display = 'none';
  }

});


// Get chatbot elements
const chatbot = document.getElementById('chatbot');
const conversation = document.getElementById('conversation');
const inputForm = document.getElementById('input-form');
const inputField = document.getElementById('input-field');

// Add event listener to input form
inputForm.addEventListener('submit', function(event) {
  // Prevent form submission
  event.preventDefault();

  // Get user input
  const input = inputField.value;

  // Clear input field
  inputField.value = '';
  const currentTime = new Date().toLocaleTimeString([], { hour: '2-digit', minute: "2-digit" });

  // Add user input to conversation
  let message = document.createElement('div');
  message.classList.add('chatbot-message', 'user-message');
  message.innerHTML = `<p class="chatbot-text" sentTime="${currentTime}">${input}</p>`;
  conversation.appendChild(message);

  // Generate chatbot response
  const response = generateResponse(input);

  // Add chatbot response to conversation
  message = document.createElement('div');
  message.classList.add('chatbot-message','chatbot');
  message.innerHTML = `<p class="chatbot-text" sentTime="${currentTime}">${response}</p>`;
  conversation.appendChild(message);
  message.scrollIntoView({behavior: "smooth"});
});

const removeAccents = (str) => {
  return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
} 

// Generate chatbot response function
function generateResponse(input) {
    input=input.toLowerCase();
    input=removeAccents(input);

    if(input.includes('hola', 0) || input.includes('hi', 0) || input.includes('que tal') || input.includes('buenas') || input.includes('buenos')){
      const responses = [
            "¡Hola! ¿Cómo puedo ayudarte hoy?",
            "¡Hola! ¿En qué puedo asistirte?",
            "Saludos. ¿En qué puedo colaborar?",
            "¡Hola! Bienvenido/a. ¿En qué puedo ser de utilidad?",
            "Hola, ¿cómo estás? ¿En qué puedo ayudarte hoy?",
            "Hola, ¿en qué puedo colaborar contigo?",
            "¡Saludos! ¿Cómo puedo ayudarte en este momento?",
            "¡Hola! ¿Qué te trae por aquí?"
          ];
          return responses[Math.floor(Math.random() * responses.length)];
    }

    if(input.includes('quien eres') || input.includes('que haces') || input.includes('que puedes hacer')){
      const responses = [
            "Soy PonyChat, un chatbot creado para ayudarte con consultas relacionadas con trámites del servicio social y la búsqueda de jefe de vinculación, dependiendo de tu carrera.",
            "Bienvenido a PonyChat, un asistente virtual diseñado para brindarte información y apoyo en asuntos relacionados con el servicio social y la ubicación de jefes de vinculación en diversas carreras.",
            "Soy un chatbot llamado PonyChat, especializado en brindar asistencia en trámites del servicio social y en ayudarte a encontrar a tu jefe de vinculación, dependiendo de tu área de estudio.,",
            "Me llamo PonyChat y soy un chatbot de inteligencia artificial creado específicamente para ayudarte con preguntas y trámites relacionados con el servicio social y la localización de tu jefe de vinculación, adaptándome a tu carrera específica."
          ];
          return responses[Math.floor(Math.random() * responses.length)];
    }

    if(input.includes('como te llamas') || input.includes('cual es tu nombre')){
      const responses = [
          "Me llamo PonyChat, el chatbot diseñado para ayudarte con trámites del servicio social y la búsqueda de tu jefe de vinculación, según tu carrera.",
          "Soy conocido como PonyChat, el asistente virtual especializado en brindar información y apoyo en temas relacionados con el servicio social y la ubicación de jefes de vinculación en diferentes carreras.",
          "Mi nombre es PonyChat, el chatbot creado para ser tu guía en asuntos relacionados con el servicio social y para ayudarte a encontrar a tu jefe de vinculación, según la carrera que estés cursando.",
          "Me llamo PonyChat, el chatbot de confianza que te brinda respuestas y orientación en trámites del servicio social y te asiste en la búsqueda de tu jefe de vinculación, adaptándome a tus necesidades académicas."
          ];
          return responses[Math.floor(Math.random() * responses.length)];
    }

    if(input.includes('como estas') || input.includes('como te sientes')){
      const responses = [
          "Como soy un chatbot, no tengo emociones, pero estoy aquí listo para ayudarte en lo que necesites.",
          "Como soy un programa de inteligencia artificial, no tengo una condición física o emocional, pero estoy a tu disposición para responder tus preguntas.",
          "No tengo emociones, pero estoy aquí para ayudarte en lo que necesites. ¿En qué puedo asistirte hoy?",
          "Como soy un chatbot, no tengo estados de ánimo, pero estoy listo para atender tus consultas y brindarte la información que necesitas."
          ];
          return responses[Math.floor(Math.random() * responses.length)];
    }

    if(input.includes('puedes ayudar') || input.includes('ayuda')){
      const responses = [
          "¡Por supuesto! Estoy aquí para ayudarte. Cuéntame en qué puedo asistirte o qué información estás buscando.",
          "¡Claro! Estoy aquí precisamente para brindarte ayuda. ¿En qué puedo colaborar contigo hoy?",
          "¡Absolutamente! Estoy a tu disposición para ayudarte en lo que necesites. ¿Qué necesitas o qué pregunta tienes?",
          "Por supuesto, puedo ayudarte. Explícame qué tipo de asistencia necesitas y haré todo lo posible por ofrecerte la información o la guía adecuada."
          ];
          return responses[Math.floor(Math.random() * responses.length)];
    }

    if(input.includes('como') && (input.includes('liberar') || input.includes('libero') || input.includes('liberas')) && input.includes('servicio')){
      return "Para liberar tu servicio, necesitarás completar ciertos requisitos establecidos por el Instituto Tecnológico de Morelia y la oficina de vinculación. Te recomendaría visitar el siguiente enlace para obtener información específica sobre los pasos a seguir: "+"Servicio Social".link("servicio");
    }

    if(input.includes('como') && (input.includes('liberar') || input.includes('libero') || input.includes('liberas')) && (input.includes('practicas')  || input.includes('residencias')) ){
      return "Para liberar tus practicas profesionales, necesitarás completar ciertos requisitos establecidos por el Instituto Tecnológico de Morelia y la oficina de vinculación. Te recomendaría visitar el siguiente enlace para obtener información específica sobre los pasos a seguir: "+"Servicio de Promocion Profesional".link("promocion");
    }

    const responses = [
        "Lamentablemente, no dispongo de la información que estás buscando en este momento. Te sugiero que consultes con tu institución educativa o con el departamento encargado del servicio social para obtener una respuesta precisa.",
        "Parece que no he entendido completamente tu pregunta. ¿Podrías proporcionar más detalles o reformularla para que pueda ayudarte de manera más efectiva?",
        "Me disculpo, pero no tengo la respuesta que buscas en este momento. Te recomendaría buscar información adicional en fuentes confiables o consultar con un profesional en el área correspondiente.",
        "Parece que la pregunta no está clara para mí. Por favor, reformúlala de manera más específica o proporciona más detalles para que pueda brindarte una respuesta adecuada."
    ];
    return responses[Math.floor(Math.random() * responses.length)];
}
  
