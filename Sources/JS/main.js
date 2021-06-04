/*onload = function() {
  load("reportes/listado-reportes.php");
}*/
function imagenpreview(){
  var inputImagen= document.getElementById("imagen");
  var imagenPreview= document.getElementById("imagePreview");
  const img =document.createElement("img");
  img.src=inputImagen.value;
  imagenPreview.appendChild(img);
  console.log(inputImagen.value);
}

function createPreview(file) {
  var imgCodified = URL.createObjectURL(file);
  var img = $('<img id="preview" src="' + imgCodified + '"class="imagen-about">');
  if(document.getElementById("preview")){
    document.getElementById("preview").remove();
    $(img).insertBefore("#imagePreview");
  }else{
    $(img).insertBefore("#imagePreview");
  }
    
}



$(document).on("change", "#imagen", function () {
    console.log("hey")
  console.log(this.files);
  var files = this.files;
  var element;
  var supportedImages = ["image/png"];
  var seEncontraronElementoNoValidos = false;

  for (var i = 0; i < files.length; i++) {
      element = files[i];
      if(document.getElementById("preview")){
        document.getElementById("preview").remove();
      }
      if (supportedImages.indexOf(element.type) != -1) {
        
          createPreview(element);
      }
      else {
          seEncontraronElementoNoValidos = true;
      }
  }

  if (seEncontraronElementoNoValidos) {
      showMessage("Archivo no valido.");
  }
  else {
      showMessage("");
  }

});
function showMessage(message) {
  $("#Message .tag").text(message);
  showModal("Message");
}
function showModal(card) {
  $("#" + card).show();
  $(".modal").addClass("show");
}

function closeModal() {
  $(".modal").removeClass("show");
  setTimeout(function () {
    $(".modal .modal-card").hide();
  }, 300);
}

function loading(status, tag) {
  if (status) {
    $("#loading .tag").text(tag);
    showModal("loading");
  }
  else {
    closeModal();
  }
}
function loadNew(articulo, usuario){
    
  url = "add.php?";
  url += "articulo=" + articulo;
  url += "&usuario=" + usuario;   
  location.href = url; 
}
function sendNCAForm() {
  var valido = true;
  if (valido) {
    document.getElementById("formulario-ACATG").submit();
  } else {
    alert("VALIDA LOS CAMPOS");
    return false;
  }
}
function agregarAtributo(){
  console.log("Agregando atributo...");
  var fila=document.createElement("tr");
  var valor=document.getElementById("newatributo").value;
  var inputnuevo='<label type="text">'+valor+'</label>'+'<input style="display:none;" type="text" name="'+valor+'" value="'+valor+'"></input">';
  fila.innerHTML='<td>'+inputnuevo+'</td><td>texto</td>';
  var tabla=document.getElementById("atributos-tabla");
  tabla.appendChild(fila);
}
