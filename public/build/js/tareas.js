!function(){!async function(){try{const e="/api/tareas?id="+t(),a=await fetch(e),n=await a.json(),{tareas:o}=n;!function(e){console.log("Mostrando",e)}(o)}catch(e){console.log(e)}}();function e(e,t,a){const n=document.querySelector(".alerta");n&&n.remove();const o=document.createElement("DIV");o.classList.add("alerta",t),o.textContent=e,a.parentElement.insertBefore(o,a.nextElementSibling),setTimeout(()=>{o.remove()},4e3)}function t(){const e=new URLSearchParams(window.location.search);return Object.fromEntries(e.entries()).id}document.querySelector("#agregar-tarea").addEventListener("click",(function(){const a=document.createElement("DIV");a.classList.add("modal"),a.innerHTML='\n            <form class="formulario nueva-tarea">\n                <legend>Añade una nueva tarea</legend>\n                <div class="campo">\n                    <label>Tarea</label>\n                    <input type="text" name="tarea" placeholder="Añadir tarea al proyecto actual" id="tarea"/>\n                </div>\n                <div class="opciones">\n                    <input type="submit" class="submit-nueva-tarea" value="Añadir Tarea"/>\n                    <button type="button" class="cerrar-modal">Cancelar</button>\n                </div>\n            </form>\n        \n        ',setTimeout(()=>{document.querySelector(".formulario").classList.add("animar")},100),a.addEventListener("click",(function(n){if(n.preventDefault(),n.target.classList.contains("cerrar-modal")){document.querySelector(".formulario").classList.add("cerrar"),setTimeout(()=>{a.remove()},300)}n.target.classList.contains("submit-nueva-tarea")&&function(){const a=document.querySelector("#tarea").value.trim();if(""===a)return void e("El nombre de la tarea es obligatorio","error",document.querySelector(".formulario legend"));!async function(a){const n=new FormData;n.append("nombre",a),n.append("proyectoId",t());try{const t="http://127.0.0.1:3000/api/tarea",a=await fetch(t,{method:"POST",body:n}),o=await a.json();if(e(o.mensaje,o.tipo,document.querySelector(".formulario legend")),"exito"===o.tipo){const e=document.querySelector(".modal");setTimeout(()=>{e.remove()},1e3)}}catch(e){console.log(e)}}(a)}()})),document.querySelector(".dashboard").appendChild(a)}))}();