(function () {



    obtenerProyectos();

    let proyectos = []; // Virtual DOM
    let tareas = [];



    async function obtenerProyectos() {

        try {
            const url = "http://127.0.0.1:3000/api/proyectos";

            const respuesta = await fetch(url);
            const resultado = await respuesta.json();

            proyectos = resultado.proyectos; // Asigno a variable global (Virtual DOM)
            tareas = resultado.tareas;


            mostrarProyectos();

        } catch (error) {
            console.log(error);
        }
    }

    function mostrarProyectos() {

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

            const contenedorElementos = document.createElement('LI');
            contenedorElementos.classList.add('proyecto-elementos');


            const enlaceProyecto = document.createElement('A');
            enlaceProyecto.setAttribute('href', `/tasktrack/proyecto?id=${proyecto.url}`);


            const nombreProyecto = document.createElement('P');
            nombreProyecto.textContent = proyecto.proyecto;


            const listadoTareas = document.createElement('P');
            listadoTareas.classList.add('numero-tareas');
            listadoTareas.textContent = "Tareas: " + tareasCompletadas.length + "/" + tareasProyecto.length;

            const contenedorListadoTareas = document.createElement('P');
            contenedorListadoTareas.classList.add('contenedor-numero-tareas');

            if (tareasCompletadas.length === tareasProyecto.length && tareasProyecto.length > 0) {
                contenedorProyecto.classList.add('proyecto-completo');
                nombreProyecto.classList.add('proyecto-completo--nombre');
                listadoTareas.classList.add('proyecto-completo--tareas');
            } if (tareasProyecto.length < 1) {
                contenedorProyecto.classList.add('proyecto-incompleto');
                nombreProyecto.classList.add('proyecto-incompleto--nombre');
                listadoTareas.classList.add('proyecto-incompleto--tareas');
                listadoTareas.textContent = "Todavia no hay ideas";
            }

            contenedorListadoTareas.appendChild(listadoTareas);
            contenedorElementos.appendChild(nombreProyecto);
            contenedorElementos.appendChild(contenedorListadoTareas);

            contenedorProyecto.appendChild(contenedorElementos);

            enlaceProyecto.appendChild(contenedorProyecto);

            const listadoProyecto = document.querySelector('#listado-proyectos');
            listadoProyecto.appendChild(enlaceProyecto);

            tareasProyecto = [];

        });
    }

    function limpiarProyectos() {
        const listadoProyectos = document.querySelector('#listado-proyectos');

        while (listadoProyectos.firstChild) {
            listadoProyectos.removeChild(listadoProyectos.firstChild);
        }
    }

})();