!function(){const e=document.querySelector("#mobile-menu"),t=document.querySelector("#cerrar-menu"),c=document.querySelector(".sidebar");e&&e.addEventListener("click",(function(){c.classList.add("mostrar")})),t&&t.addEventListener("click",(function(){c.classList.add("ocultar"),setTimeout(()=>{c.classList.remove("mostrar"),c.classList.remove("ocultar")},800)})),window.addEventListener("resize",(function(){document.body.clientWidth>=768&&c.classList.remove("mostrar")}))}();