
function login() {
    var alerta = document.getElementById("alerta");
    alerta.classList.add("invisible");
    var email = document.getElementById("emailInput").value;
    var password = document.getElementById("passwordInput").value;
    if(email == "" || password== "") {
        alerta.innerHTML = "Rellene todos los campos";
        alerta.classList.remove("invisible");
    } else {
        url = "../Sources/procesos/login.php";
        url += "?email=" + email + "&";
        url += "password=" + password;
        axios.get(url)
        .then(function (response) {
            var res = response.data;
            console.log(res);
            if(res == "1") {
                alerta.innerHTML = "El email no está registrado";
                alerta.classList.remove("invisible");
            } else if(res == "2") {
                alerta.innerHTML = "La contraseña es incorrecta";
                alerta.classList.remove("invisible");
            } else if(res == "3") {
                console.log("Si se pudo");
                location.href = "../";
            }
        })
        .catch(function (error) {
            console.log(error)
        })
    }
}

function register() {
    var alerta = document.getElementById("alerta");
    alerta.classList.add("visually-hidden");
    var nombre = document.getElementById("nameInput").value;
    var usuario = document.getElementById("userInput").value;
    var email = document.getElementById("emailInput").value;
    var password = document.getElementById("passwordInput").value;
    var passwordConfirm = document.getElementById("passwordConfirmInput").value;
    if(email == "" || password== "" || nombre == "" || usuario == "" || passwordConfirm == "") {
        alerta.innerHTML = "Rellene todos los campos";
        alerta.classList.remove("visually-hidden");
    } else if(password != passwordConfirm) {
        alerta.innerHTML = "Las contraseñas no coinciden";
        alerta.classList.remove("visually-hidden");
    } else {
        url = "../Sources/procesos/register.php?";
        url += "email=" + email + "&";
        url += "nombre=" + nombre + "&";
        url += "usuario=" + usuario + "&";
        url += "passwordConfirm=" + passwordConfirm + "&";
        url += "password=" + password;
        axios.get(url)
        .then(function (response) {
            var res = response.data;
            console.log(res);
            if(res == "1") {
                alerta.innerHTML = "El email ya está registrado";
                alerta.classList.remove("visually-hidden");
            } else if(res == "2") {
                alerta.innerHTML = "El nombre de usuario ya está registrado";
                alerta.classList.remove("visually-hidden");
            } else if(res == "3") {
                location.href = "../";
            } else {
                alerta.innerHTML = "Ha ocurrido un error inesperado, por favor intente más tarde";
                alerta.classList.remove("visually-hidden");
            }
        })
        .catch(function (error) {
            console.log(error)
        })
    }
}


function sendProfile() {
    var nombre = document.getElementById("nombre").value
    var usuario = document.getElementById("usuario").value
    var email = document.getElementById("email").value
    var password = document.getElementById("password").value
    var passwordConfirm = document.getElementById("passwordConfirm").value
    var alerta = document.getElementById("alerta")
    alerta.innerHTML = ""
    alerta.classList.add("invisible")

    if(nombre=="" || usuario=="" || email == "") {
        alerta.innerHTML = "No puede dejar Email, Usuario o Nombre vacíos"
        alerta.classList.remove("invisible")
        return false;
    }
    if(password != passwordConfirm && password != "") {
        alerta.innerHTML = "Las contraseñas no coinciden"
        alerta.classList.remove("invisible")
        return false;
    }
    return true;
}

function enviarReseña(reseñador, reseñado) {
    var reseña = document.getElementById("reseña")
    var stars = document.getElementsByClassName("star")
    var rate = 0
    for (var i = 0; i<stars.length; i++) {
        if(stars[i].innerHTML == "star") {
            rate++;
        }
    }
    url = "../Sources/procesos/reseñas.php?reseñador=" + reseñador + "&reseñado=" + reseñado + "&reseña=" + reseña.value + "&rate=" + rate + "&metodo=guardar";
    axios.get(url)
    .then(function (response) {
       var code = response.data;
       if(code == "1") {
           cargarReseñas(reseñado);
       } else {
           alert("Ha ocurrido un error al guardar su reseña, por favor intente de nuevo más tarde");
       }
       reseña.value = "";
    })
    .catch(function (error) {
        console.log(error);
    })
}

function cargarReseñas(reseñado) {
    var listado = document.getElementById("listado");
    url = "../Sources/procesos/reseñas.php?metodo=cargar&reseñado="+reseñado;
    axios.get(url)
    .then(function (response) {
       var code = response.data;
       if(code != "4") {
           listado.innerHTML = response.data;
       } else {
        listado.innerHTML = "Ha ocurrido un error al cargar las reseñas, por favor intente de nuevo más tarde";
       }
    })
    .catch(function (error) {
        console.log(error);
    })
}


function sendReporte(usuario, reportado) {
    var asunto = document.getElementById('asunto');
    var descripcion = document.getElementById('descripcion');
    url = "/Found-it/reportes/sendReport.php?";
    url += "usuario=" + usuario;
    url += "&reportado=" + reportado;
    url += "&asunto=" + asunto.value;
    url += "&descripcion=" + descripcion.value;
console.log(url);
    if(descripcion.value!=""){
        axios.get(url)
        .then(function (response) {
            descripcion.value="";
            console.log(reportado)
            loadPerfilVentas(reportado);
            alert("Reporte enviado");
        })
        .catch(function (error) {
            console.log(error);
        });
    }
}