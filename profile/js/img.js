
// var usuario = document.getElementById("user").value;
// loadImagen("AleTheTwin");
function loadImagen(usuario) {
    url = "display-image.php";
    // url = "get-image.php?usuario="+usuario;
    axios.get(url)
    .then(function (response) {
        var imgUser = document.getElementById("imagen-usuario");
        imgUser = response.data;    
        // imgUser.innerHTML = response.data;    
    })
    .catch(function (error) {
        console.log(error)
    })
}

function cambiarFoto(file) {
    var img = document.getElementById("image");
    var imgCodified = URL.createObjectURL(file);
    img.src = imgCodified;
}
  
$(document).on("change", "#file", function () {
    var img = document.getElementById("image");
    var files = this.files;
    var element;
    var supportedImages = ["image/jpeg", "image/png"];
    var seEncontraronElementoNoValidos = true;

    for (var i = 0; i < files.length; i++) {
        element = files[i];

        for(var i=0; i<supportedImages.length; i++) {
            if((supportedImages[i].indexOf(element.type) != -1)) {
                seEncontraronElementoNoValidos = false;
                break;
            }
        }

        if(seEncontraronElementoNoValidos) {
            alert("Solo se admiten archivos .png");
        } else {
            encodeImage();
        }

        // if ((supportedImages.indexOf(element.type) != -1) ) {
        //     console.log("hora de cambiarFoto")
        //     encodeImage();
        //     // cambiarFoto(element);
        // }
        // else {
        //     seEncontraronElementoNoValidos = true;
        // }
    }

    // if (seEncontraronElementoNoValidos) {
    //     alert("Solo se admiten archivos .png")
    // }
});

function encodeImage() {
    var img = document.getElementById("image");
    var file = document.getElementById("file").files[0];
    var supportedImages = ["image/jpeg"];
    
    var imagePath = URL.createObjectURL(file);
    img.src = imagePath;
}

function saveImage() {
    var image = document.getElementById("image");
    if(image.src == "http://localhost/Found-it/profile/prueba-img.html") {
        console.log("no hay img");
    } else {
        var width = 100;
        var height = 100;
        
        var canvas = document.createElement('canvas');  // Dynamically Create a Canvas Element
        canvas.width  = width;  // Set the width of the Canvas
        canvas.height = height;  // Set the height of the Canvas
        var ctx = canvas.getContext("2d");  // Get the "context" of the canvas 
        ctx.drawImage(image,0,0,width,height);  // Draw your image to the canvas


        var jpegFile = canvas.toDataURL("image/png");
        // imagen.src = jpegFile;
        var formulario = document.getElementById("nueva_imagen");
        formulario.value = jpegFile;

        

    }
}


function rate(star) {
    var stars = document.getElementsByClassName("star");
    for (var i = 0; i<stars.length; i++) {
        stars[i].innerHTML="star_border"
    }
    var num = 0;
    switch(star) {
        case "1": 
            num = 1;
            break;
        case "2": 
            num = 2;
            break;
        case "3": 
            num = 3;
            break;
        case "4": 
            num = 4;
            break;
        case "5": 
            num = 5;
            break;
    }
    for (var i = 0; i<num; i++) {
        stars[i].innerHTML="star"
    }
}