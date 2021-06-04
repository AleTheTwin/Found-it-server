function sidebar_open() {
  var boton = document.getElementById("open");
  var sidebar = document.getElementById("sidebar");
  boton.classList.remove("rotate-90-degrees-reverse");

  boton.classList.add("rotate-90-degrees");

  sidebar.classList.remove("sidebar-close");
  sidebar.classList.add("sidebar-open"); 
  document.getElementById("open").onclick=sidebar_close;
}

function sidebar_close() {
  var boton = document.getElementById("open");
  boton.classList.remove("rotate-90-degrees");
  boton.classList.add("rotate-90-degrees-reverse");
  var sidebar = document.getElementById("sidebar");
  sidebar.classList.remove("sidebar-open");
  sidebar.classList.add("sidebar-close"); 
  document.getElementById("open").onclick=sidebar_open; 
}
console.log("sisisiis");