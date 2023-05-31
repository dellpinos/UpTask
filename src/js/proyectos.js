(function () {


    obtenerProyectos();

    let proyectos = []; // Virtual DOM
    let tareas = [];



    async function obtenerProyectos() {

        try {
            // console.log('Huola Front');

            // const url = "http://127.0.0.1:3000/api/proyectos";
            const url = "http://127.0.0.1:3000/api/proyectos";

            const respuesta = await fetch(url);

            const resultado = await respuesta.json();

            proyectos = resultado.proyectos; // Asigno a variable global (Virtual DOM)
            tareas = resultado.tareas;


            // console.log(proyectos);
            // console.log(tareas);


            mostrarProyectos();

        } catch (error) {
            console.log(error);
        }
    }

    function mostrarProyectos() {

        // console.log('Desde proyectos');

        limpiarProyectos();

        if (proyectos.length === 0) {
            const contenedorProyectos = document.querySelector('.contenido');
            const textoNoProyectos = document.createElement('LI');
            textoNoProyectos.textContent = "No hay proyectos, deberias agregar alguno";

            textoNoProyectos.classList.add('no-proyectos');

            contenedorProyectos.appendChild(textoNoProyectos);
            return;
        }


        const estados = {
            0: 'Pendiente',
            1: 'Completa'
        }

        proyectos.forEach(proyecto => {

            let tareasProyecto = tareas.filter(tarea => tarea.proyectoId === proyecto.id);
            let tareasCompletadas = tareasProyecto.filter(tarea => tarea.estado === "1");
        

            const contenedorProyecto = document.createElement('LI');
            contenedorProyecto.dataset.proyectoId = proyecto.id; // Atributo HTML personalizado
            contenedorProyecto.classList.add('proyecto');
            if(tareasCompletadas.length === tareasProyecto.length) {
                contenedorProyecto.classList.add('proyecto-completo');
            }

            const nombreProyecto = document.createElement('P');
            nombreProyecto.textContent = proyecto.proyecto;

            const enlaceProyecto = document.createElement('A');
            enlaceProyecto.setAttribute('href', `/proyecto?id=${proyecto.url}`);

            const listadoTareas = document.createElement('P');
            listadoTareas.classList.add('numero-tareas');
            listadoTareas.textContent = tareasCompletadas.length + "/" + tareasProyecto.length;


            contenedorProyecto.appendChild(nombreProyecto);
            contenedorProyecto.appendChild(listadoTareas);

            enlaceProyecto.appendChild(contenedorProyecto);

            


            const listadoProyecto = document.querySelector('#listado-proyectos');
            listadoProyecto.appendChild(enlaceProyecto);

            tareasProyecto = [];

            // console.log('Este es el listado proyecto>>', listadoProyecto);

        });
    }


    function limpiarProyectos() {
        const listadoProyectos = document.querySelector('#listado-proyectos');

        while (listadoProyectos.firstChild) {
            listadoProyectos.removeChild(listadoProyectos.firstChild);
        }
    }

})();