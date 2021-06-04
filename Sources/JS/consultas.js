var contenido = document.getElementById("contenido");
var url = "";
// loadAgregarProce("Procesador", "i7-9700k");

function inicio() {
    
    borrarReload();
    url = "index-contenido.php";
    axios.get(url)
    .then(function (response) {
        contenido.innerHTML = response.data;    
    })
    .catch(function (error) {
        console.log(error)
    }) 
}

function load(link){
    url = link;
    axios.get(url)
    .then(function (response) {
        contenido.innerHTML = response.data;
    })
    .catch(function (error) {
        console.log(error)
    })  
}
function loadAdmin(){
    load("/Found-it/Admin/admin.php");
}
function loadAddArticulo(etiqueta,id){
    console.log("/Found-it/Admin/AdminSources/Procesos/addArticulo.php?"+etiqueta+"="+document.getElementById(id).value);
    url=("/Found-it/Admin/AdminSources/Ventanas/addArticulo.php?"+etiqueta+"="+document.getElementById(id).value);
    location.href =url;
}
function loadUptArticulo(etiqueta,id){
    console.log("/Found-it/Admin/AdminSources/Ventanas/updateArticulo.php?"+etiqueta+"="+document.getElementById(id).value);
    url=("/Found-it/Admin/AdminSources/Ventanas/updateArticulo.php?"+etiqueta+"="+document.getElementById(id).value);
    location.href =url;
}

function loadLogin(){
    location.href = "/Found-it/Login/login.php";
}

function loadRegister(){
    url = "register.php";
    axios.get(url)
    .then(function (response) {
        contenido.innerHTML = response.data;    
    })
    .catch(function (error) {
        console.log(error)
    })
}

function loadArticulo(categoria,modeloAlfanumerico) {
    url = "Articulos/Articulo.php?catg="+categoria+"&model="+modeloAlfanumerico;
    axios.get(url)
    .then(function (response) {
        contenido.innerHTML = response.data;    
    })
    .catch(function (error) {
        console.log(error)
    })
}

function loadProfile(usuario) {
    url = "/Found-it/profile/edit-profile.php?usuario="+usuario;
    console.log("hola");
    axios.get(url)
    .then(function (response) {
        if(response.data == "0") {
            loadLogin();
        } else {
            location.href = url;
        }   
    })
    .catch(function (error) {
        console.log(error)
    })
}

function buscar(busqueda) {
    location.href="/Found-it/Search/search.php?search="+busqueda;
}

function buscar2() {
    var busqueda = document.getElementById("search").value;
    location.href="/Found-it/Search/search.php?search="+busqueda;
}

async function loadPerfilVentas(usuario) {
    location.href = "/Found-it/profile/perfil-ventas.php?usuario=" + usuario;
    await sleep(1000);
    cargarReseñas(usuario);
}

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}
  
function report(reportador, reportado) {
    url = "../reportes/reportes.php?reportador=" + reportador + "&reportado=" + reportado;
    location.href = url;
}
function eliminarUsuario(usuario) {

    
    var botonEliminar = document.getElementById("eliminar")
    botonEliminar.classList.remove("report")
    botonEliminar.classList.add("invisible")
    var opciones = document.getElementById("opcionesReporte")
    var parrafo = document.createElement("p")
    parrafo.innerHTML = "¿Seguro que desea eliminar al usuario?"
    parrafo.style.color = "white"
    opciones.appendChild(parrafo)
    var botonConfirmar = document.createElement("a")
    botonConfirmar.classList.add("report")
    botonConfirmar.innerHTML = "Confirmar"
    botonConfirmar.setAttribute('onclick', 'confirmarEliminacion(' + "'" + usuario + "')");
    opciones.appendChild(botonConfirmar)

    
}
function confirmarEliminacion(usuario) {
    alert("Eliminé a " + usuario)
    location.href = "../";
    
}
function loadReporte(idReport) {
    url = "../reportes/reporte.php?id=" + idReport;
    axios.get(url)
    .then(function (response) {
        contenido.innerHTML = response.data; 
    })
    .catch(function (error) {
        console.log(error)
    })
}
//comentarios

var refill = true;
var reload = false;
var arti = "";

function update() {
    if(reload) {
        openComentario(arti);
    }
    setTimeout(update, 1000);
}
function sendComentario(articulo, usuario) {
    var comentario = document.getElementById('coment');
    reload=true;
    arti=articulo;
    url = "/Found-it/Sources/procesos/sendComent.php?";
    url += "articulo=" + articulo;
    url += "&usuario=" + usuario;
    url += "&comentario=" + comentario.value;
    if(comentario.value!=""){
        axios.get(url)
        .then(function (response) {
            comentario.value="";
        })
        .catch(function (error) {
            console.log(error)
        })
        openComentario(articulo);
    }
}

function openComentario(articulo) {
    var cajonComentarios = document.getElementById("cajonComentarios");
    reload=true;
    url = "/Found-it/Sources/procesos/loadComent.php?";
    url += "articulo=" + articulo;
    url += "&refill=" + refill;
    axios.get(url)
    .then(function (response) {
        refill = false; 
        if(response.data!="1"){
            cajonComentarios.innerHTML=response.data;
        }    
        
    })
    .catch(function (error) {
        console.log(error)
    })
}
//