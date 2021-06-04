updateM();

var botones = document.getElementById("botones-msg");
var reload = false;
var refill = true;
var remitente2="";
var elemento2 ="";
function closeMsgBox(){
    
    botones.classList.add("invisible");
    reload = false;
    var content = document.getElementById('msg-content');
    var chats = document.getElementsByClassName('msg-content2');
    
    if(content.classList.contains('msg-content-close')) {
        content.classList.remove('msg-content-close');
        content.classList.add('msg-content-open');
        chats[0].classList.remove('invisible');
        chats[1].classList.add('invisible');
    } else {
        
        content.classList.remove('msg-content-open');
        content.classList.add('msg-content-close');        
    }
}

function updateM() {
    if(reload) {
        openMsg(elemento2, remitente2);
    }
    setTimeout(updateM, 1000);
}

function scrollToBottom() {
    var chat = document.getElementById("message-list");
    chat.scrollTop = chat.scrollHeight;
}

function openMessage(elemento, remitente) {
    var mensajes = document.getElementById("message-list");
    var mensajes = document.getElementById("msg");
    mensajes.innerHTML="";
    
    refill = true;
    scrollToBottom();
    openMsg(elemento, remitente);
    url = "/Found-it/messages/botones.php?";
    var boton = document.getElementById("boton-send");
    axios.get(url)
    .then(function (response) {
       boton.innerHTML = response.data;
    })
    .catch(function (error) {
        console.log(error)
    })
    msg.focus();
}

function openMsg(elemento, remitente) {
    botones.classList.remove("invisible");
    var mensajes = document.getElementById("message-list");
    var conversacion = elemento.id;
    elemento2 = elemento;
    remitente2 = remitente;

    url = "/Found-it/messages/loadMessages.php?";
    url += "remitente=" + remitente;
    url += "&conversacion=" + conversacion;
    url += "&refill=" + refill;
    axios.get(url)
    .then(function (response) {
        if(response.data != 1 || refill) {
            mensajes.innerHTML = response.data;
            refill = false;
            scrollToBottom()
        } 
        
    })
    .catch(function (error) {
        console.log(error)
    })
    
    var chats = document.getElementsByClassName('msg-content2');
    chats[0].classList.add('invisible');
    chats[1].classList.remove('invisible');
    reload = true;
}

function closeMsg() {
    botones.classList.add("invisible");
    reload = false;
    var chats = document.getElementsByClassName('msg-content2');
    chats[0].classList.remove('invisible');
    chats[1].classList.add('invisible');
}

function sendMsg(remitente, conversacion) {
    var mensaje = document.getElementById('msg');
    var hoy = new Date();
    var hora = hoy.getHours() + ':' + hoy.getMinutes() + ':' + hoy.getSeconds();

    url = "/Found-it/messages/sendMessage.php?";
    url += "remitente=" + remitente;
    url += "&conversacion=" + conversacion;
    url += "&mensaje=" + mensaje.value;
    url += "&hora=" + hora;

    axios.get(url)
    .then(function (response) {
       mensaje.value="";
    })
    .catch(function (error) {
        console.log(error)
    })
}

function enviarMensaje(remitente, destinatario) {
    link = "/Found-it/messages/crear-conversacion.php?remitente=" + remitente + "&destinatario=" + destinatario;
    axios.get(link)
    .then(function (response) {
       console.log(response.data)
       if(response.data != "-1") {
           var mensajes = document.getElementById("msg-content");
           if(mensajes.classList.contains("msg-content-close")) {
               closeMsgBox();
           }
           var elemento = document.createElement("div");
           elemento.id = response.data;
           openMessage(elemento, remitente);
        } else {
            alert("Ha ocurrido un error, por favor recargue la página e intente de nuevo.")
        }
    })
    .catch(function (error) {
        console.log(error)
    })
}