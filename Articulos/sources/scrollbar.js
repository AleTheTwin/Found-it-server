var last_known_scroll_position = 0;
var ticking = false;
//Objetos
var imagen= document.getElementById("Imagen");
var nombreM= document.getElementById("nombres");
var desRes= document.getElementById("DesRes");
//
var escala=1;
var intensidad=0;
var intensidadNombres=0;
var scrollaux=0;
var anteriorScroll=0;
var subiendo= true;
var escalonSubir=0;
var escalonBajar=0;
var pasosTexto=0;
//
var vAncho=innerWidth;    
var anchoVentana=desRes.style.width;      
desRes.style.right=((vAncho-anchoVentana)/3)+'px';
//listener de scrollbar
window.addEventListener('scroll', function(e) {
  last_known_scroll_position = window.scrollY;
  if (!ticking) {
    window.requestAnimationFrame(function() {
      scrollAccion(last_known_scroll_position);
      ticking = false;
    });
  }
  ticking = true;
});
//Funcion
function scrollAccion(scroll_pos) {
  console.log(scroll_pos);
  if(anteriorScroll<scroll_pos){subiendo = false;}else{subiendo = true;}
    if(scroll_pos<900){
      intensidad=0;
      if(scroll_pos>500){
        intensidadNombres=((scroll_pos-500)*.004);
        nombreM.style.opacity=intensidadNombres; 
      }else{
        imagenAparece500(scroll_pos);
      }
      imagen.style.position = 'absolute';
      imagen.style.top = scroll_pos +'px';
      imagen.style.width =(scroll_pos)+"px";
      }else{
        if(scroll_pos<1250 && subiendo){
          document.getElementById("nombres").style.transform = 'translateY('+(0)+'px)';
          document.getElementById("nombres").style.bottom='20%';
          escalonBajar=0;
          escalonSubir=0;
        }
        if(scroll_pos>917 && scroll_pos<1250){  scrollaux=1250; }else{
          if(scroll_pos<1250){  scrollaux=900;  
            desRes.style.top ="100%";
            pasosTexto=100;
            desRes.style.opacity=0;}
          imagenScale900(scroll_pos);
          nombreM.style.opacity=1;
          
          if(scroll_pos>1250 && scroll_pos<1740){
            nombretoUP(scroll_pos);
            desRes.style.opacity=1;
            //textoUp(scroll_pos);
          }
          if(scroll_pos>1740){
              nombreM.style.transform = 'translateY('+(0)+'px)';
              nombreM.style.bottom=innerHeight-(180+60)+"px";
              nombreM.classList.add('encabezado');
              escalonBajar=0;
              escalonSubir=-(window.innerHeight*.6);
              
          }else{
            nombreM.classList.remove('encabezado');
          }
          
        }
        
      }
  anteriorScroll=scroll_pos;
}
function imagenAparece500(scroll_pos){
  intensidadNombres=0
  nombreM.style.opacity=intensidadNombres;
  if(scroll_pos<200+10){
    header.style="filter:alpha(opacity="+(100)+"); opacity:"+(1)+";"
    }else{
        if(scroll_pos>200+10){
            header.style="filter:alpha(opacity="+(100-10)+"); opacity:"+(1-.1)+";"
        }
        if(scroll_pos>200+40){
            header.style="filter:alpha(opacity="+(100-20)+"); opacity:"+(1-.2)+";"
        }
        if(scroll_pos>200+90){
            header.style="filter:alpha(opacity="+(100-30)+"); opacity:"+(1-.3)+";"
        }
        if(scroll_pos>200+140){
            header.style="filter:alpha(opacity="+(100-40)+"); opacity:"+(1-.4)+";"
            header.style.zIndex=1;
        }
        if(scroll_pos>200+200){
            header.style="filter:alpha(opacity="+(100-50)+"); opacity:"+(1-.5)+";"
            header.style.zIndex=1;
        }
        if(scroll_pos>100){
            imagen.style.width =(scroll_pos)+"px";
          }
    } 
}
function imagenScale900(scroll_pos){
  imagen.style.top = 0+'px';
  imagen.style.position = 'fixed';
  escala=((scroll_pos-scrollaux)*.01)+1;
  imagen.style.transform = 'scale('+escala+')';
  imagen.style.opacity =1-intensidad;
  intensidad=((scroll_pos-scrollaux)*.004);
    if(intensidad>.9){
          intensidad=1;
    }
    if(intensidad==1){
      imagen.style.transform = 'scale('+0+')';
    }
}
function nombretoUP(scroll_pos){
  if(!subiendo){
    if(escalonSubir<=-(window.innerHeight*.6)){
    }else{
      escalonSubir-=10;
      escalonBajar=-escalonSubir;
      if(escalonSubir>=0){
        escalonSubir=-escalonSubir;
      }
      nombreM.style.transform = 'translateY('+(escalonSubir)+'px)';
    }
  }else{
    if(escalonBajar>=(window.innerHeight*.6)){
    }else{
      escalonBajar+=10;
      escalonSubir=-escalonBajar;
      if(escalonBajar<=0){
        escalonBajar=escalonBajar+'px';
      }
      nombreM.style.transform = 'translateY('+(escalonBajar)+'px)';
    }
  }
}
function textoUp(scroll_pos){
  if(scroll_pos>=1520){
    
  }else{
  pasosTexto=pasosTexto+(scroll_pos-anteriorScroll);
  desRes.style.transform = 'translateY('+(pasosTexto*-1.3)+'px)';
  }
  
}