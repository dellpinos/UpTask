!function(){!async function(){try{const o=location.origin+"/api/proyectos",c=await fetch(o),n=await c.json();t=n.proyectos,e=n.tareas,function(){if(function(){const t=document.querySelector("#listado-proyectos");for(;t.firstChild;)t.removeChild(t.firstChild)}(),0===t.length){const t=document.querySelector(".contenido"),e=document.createElement("LI");return e.textContent="No hay proyectos, deberias agregar alguno",e.classList.add("no-proyectos"),void t.appendChild(e)}t.forEach(t=>{let o=e.filter(e=>e.proyectoId===t.id),c=o.filter(t=>"1"===t.estado);const n=document.createElement("LI");n.dataset.proyectoId=t.id,n.classList.add("proyecto");const a=document.createElement("LI");a.classList.add("proyecto-elementos");const s=document.createElement("A");s.setAttribute("href","/tasktrack/proyecto?id="+t.url);const d=document.createElement("P");d.textContent=t.proyecto;const r=document.createElement("P");r.classList.add("numero-tareas"),r.textContent="Tareas: "+c.length+"/"+o.length;const l=document.createElement("P");l.classList.add("contenedor-numero-tareas"),c.length===o.length&&o.length>0&&(n.classList.add("proyecto-completo"),d.classList.add("proyecto-completo--nombre"),r.classList.add("proyecto-completo--tareas")),o.length<1&&(n.classList.add("proyecto-incompleto"),d.classList.add("proyecto-incompleto--nombre"),r.classList.add("proyecto-incompleto--tareas"),r.textContent="Todavia no hay ideas"),l.appendChild(r),a.appendChild(d),a.appendChild(l),n.appendChild(a),s.appendChild(n);document.querySelector("#listado-proyectos").appendChild(s),o=[]})}()}catch(t){console.log(t)}}();let t=[],e=[]}();