// (function () {
//     const flag = 1;
//     if(flag) {
//         console.log('Funcionando');
//         let url = "http://www.google.com/tarea";
//         const regex2 = /[(.|\/)][a-z]/;

//         const regex = /[.][a-z]/g;

//         let r = url.match(regex)
//             let resultado = url.split(regex);

//         console.log(r);
//     }
// })();
// console.log('End'); /// <<<<<<<<<<<<



(function () {

    // return; // <<<<<<<<<<<<<<

    obtenerTareas();

    let tareas = []; // Virtual DOM
    let filtradas = [];




    // Titulo del proyecto
    const nombrePagina = document.querySelector('#nombre-pagina');
    nombrePagina.ondblclick = function(){
        mostrarFormulario(); // <<<<<<
    }




    // Boton para mostrar modal - Agregar Tarea
    const nuevaTareaBtn = document.querySelector('#agregar-tarea');
    nuevaTareaBtn.addEventListener('click', function () {
        mostrarFormulario();
    });


    const filtros = document.querySelectorAll('#filtros input[type="radio"');
    filtros.forEach( radio => {
        radio.addEventListener('input', filtrarTareas);
    });


    function filtrarTareas (e) {
        const filtro = e.target.value;

        if(filtro !== '') {
            filtradas = tareas.filter(tarea => tarea.estado === filtro);
        } else {
            filtradas = [];
        }

        mostrarTareas();

    }

    async function obtenerTareas() {

        try {
            const id = obtenerProyecto();
            const url = `/api/tareas?id=${id}`;
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();

            tareas = resultado.tareas; // Asigno a variable global (Virtual DOM)

            mostrarTareas();

        } catch (error) {
            console.log(error);
        }
    }

    function mostrarTareas() {

        limpiarTareas();
        totalPendientes();
        totalCompletas();

        const arrayTareas = filtradas.length ? filtradas : tareas;

        if (arrayTareas.length === 0) {

            const contenedorTareas = document.querySelector('#listado-tareas');
            const textoNoTareas = document.createElement('LI');
            textoNoTareas.textContent = "No hay tareas, deberias agregar algunas";
            textoNoTareas.classList.add('no-tareas');
            contenedorTareas.appendChild(textoNoTareas);
            return;
        }

        const estados = {
            0: 'Pendiente',
            1: 'Completa'
        }
        arrayTareas.forEach(tarea => {

            const contenedorTarea = document.createElement('LI');
            contenedorTarea.dataset.tareaId = tarea.id; // Atributo HTML personalizado
            contenedorTarea.classList.add('tarea');

            const nombreTarea = document.createElement('P');
            nombreTarea.textContent = tarea.nombre;
            nombreTarea.onclick = function () {
                mostrarFormulario(editar = true, {...tarea});
            }

            const opcionesDiv = document.createElement('DIV');
            opcionesDiv.classList.add('opciones');

            // Botones
            const btnEstadoTarea = document.createElement('BUTTON');
            btnEstadoTarea.classList.add('estado-tarea');
            btnEstadoTarea.classList.add(`${estados[tarea.estado].toLowerCase()}`);
            btnEstadoTarea.textContent = estados[tarea.estado];
            btnEstadoTarea.dataset.estadoTarea = tarea.estado;
            btnEstadoTarea.ondblclick = function () {
                cambiarEstadoTarea({ ...tarea });


            }


            const btnEliminarTarea = document.createElement('BUTTON');
            btnEliminarTarea.classList.add('eliminar-tarea');
            btnEliminarTarea.dataset.idTarea = tarea.id;
            btnEliminarTarea.textContent = "Eliminar";
            btnEliminarTarea.onclick = function () {
                confirmarEliminarTarea({ ...tarea });
            }

            opcionesDiv.appendChild(btnEstadoTarea);
            opcionesDiv.appendChild(btnEliminarTarea);

            contenedorTarea.appendChild(nombreTarea);
            contenedorTarea.appendChild(opcionesDiv);

            const listadoTareas = document.querySelector('#listado-tareas');

            listadoTareas.appendChild(contenedorTarea);

        });
    }

    function totalPendientes() {
        const totalPendientes = tareas.filter( tarea => tarea.estado === '0' );
        const pendientesRadio = document.querySelector('#pendientes');

        if(totalPendientes.length === 0) {
            pendientesRadio.disabled = true;

        } else {
            pendientesRadio.disabled = false;

        }
    }

    function totalCompletas() {
        const totalCompletas = tareas.filter( tarea => tarea.estado === '1' );
        const compeltadasRadio = document.querySelector('#completadas');

        if(totalCompletas.length === 0) {

            compeltadasRadio.disabled = true;

        } else {
            compeltadasRadio.disabled = false;
        }

    }

    // Utilizar formulario de actualizar tarea para modificar los nombres de proyecto
    // Basicamente tengo que usar el mismo formulario pero tengo el problema de todas las menciones a 
    // "Tarea". La mayoria podria utilizarlo igual pero es incosistente con el codigo que una funcion
    // que diga "tarea" afecte a un proyecto, tengo que cambiar los nombres por algo mas generico. 
    // El otro problema es que esta funcion ya tiene una condicion entre crear/actualizar, no me hace falta
    // A menos que cambie la forma de crear proyectos (no lo haria porque esa parte tambien mejorar con otras
    //funcionalidades). Creo toda una función nueva duplicando código o modifico la existente con otros nombres
    // y nuevos parametros (tengo que tener en cuenta que los nombres de clase estan asiciados con CSS y Js) 

    function mostrarFormulario(editar = false, tarea) {

        const modal = document.createElement('DIV');
        modal.classList.add('modal');
        modal.innerHTML = `
            <form class="formulario nueva-tarea">
                <legend>${editar ? 'Editar Tarea' : 'Añade una nueva tarea'}</legend>
                <div class="campo">
                    <label>Tarea</label>
                    <input type="text" name="tarea" placeholder="${editar ? 'Nuevo nombre de la tarea' : 'Añadir tarea al proyecto actual'}" id="tarea" value='${editar ? tarea.nombre : ''}'/>
                </div>
                <div class="opciones">
                    <input type="submit" class="submit-nueva-tarea" value="${editar ? 'Guardar cambios' : 'Añadir Tarea'}"/>
                    <button type="button" class="cerrar-modal">Cancelar</button>
                </div>
            </form>
        `;


        setTimeout(() => {
            const formulario = document.querySelector('.formulario');
            formulario.classList.add('animar');
        }, 100);
        

        modal.addEventListener('click', function (e) {
            e.preventDefault();

            if (e.target.classList.contains('cerrar-modal')) {
                const formulario = document.querySelector('.formulario');
                formulario.classList.add('cerrar');
                setTimeout(() => {
                    modal.remove();
                }, 1000);
            }




            if (e.target.classList.contains('submit-nueva-tarea')) { /// <<<<

                const nombreTarea = document.querySelector('#tarea').value.trim();
                if (nombreTarea === '') {
                    // Mostrar alerta
                    mostrarAlerta('El nombre de la tarea es obligatorio', 'error', document.querySelector('.formulario legend'));
                    return;
                }
                if(editar) {
                    tarea.nombre = nombreTarea;
                    actualizarTarea(tarea);
                } else {
                    agregarTarea(nombreTarea);
                }
            }

        });

        document.querySelector('.dashboard').appendChild(modal);

        if(!editar){
            const inputTarea = document.querySelector('#tarea');
            inputTarea.focus();
        }        
    }

    function mostrarAlerta(mensaje, tipo, referencia) {
        // Previene la creación de multiples alertas
        const alertaPrevia = document.querySelector('.alerta');
        if (alertaPrevia) {
            alertaPrevia.remove();
        }
        const alerta = document.createElement('DIV');
        alerta.classList.add('alerta', tipo);
        alerta.textContent = mensaje;

        // Inserta la alerta entre el legend y el input
        referencia.parentElement.insertBefore(alerta, referencia.nextElementSibling);

        // Eliminar la alerta
        setTimeout(() => {
            alerta.remove();
        }, 4000);
    }
    // Consultar el servidor para añadir una tarea al proyecto
    async function agregarTarea(tarea) {
        // Construir la petición
        const datos = new FormData();
        datos.append('nombre', tarea);
        datos.append('proyectoId', obtenerProyecto());

        try {
            const url = 'https://uptask2.herokuapp.com/api/tarea';
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos

            });
            console.log(respuesta);

            const resultado = await respuesta.json();
            mostrarAlerta(resultado.mensaje, resultado.tipo, document.querySelector('.formulario legend'));

            if (resultado.tipo === 'exito') {
                const modal = document.querySelector('.modal');
                setTimeout(() => {
                    modal.remove();
                }, 1000);

                // Agregar el objeto de tarea al global de tareas
                const tareaObj = {
                    id: String(resultado.id),
                    estado: "0",
                    nombre: tarea,
                    proyectoId: resultado.proyectoId
                }

                tareas = [...tareas, tareaObj];

                mostrarTareas();
            }
        } catch (error) {
            console.log(error)
        }
    }

    function cambiarEstadoTarea(tarea) {

        const nuevoEstado = tarea.estado === "1" ? "0" : "1";
        tarea.estado = nuevoEstado;

        actualizarTarea(tarea);
        

    }
    async function actualizarTarea(tarea) {
        const { estado, id, nombre } = tarea;
        const datos = new FormData();
        datos.append('id', id);
        datos.append('nombre', nombre);
        datos.append('estado', estado);
        datos.append('proyectoId', obtenerProyecto());
        try {
            const url = "https://uptask2.herokuapp.com/api/tarea/actualizar";
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });
            const resultado = await respuesta.json();

            if (resultado.respuesta.tipo === 'exito') {
                Swal.fire(
                    resultado.respuesta.mensaje,
                    resultado.respuesta.mensaje,
                    'success'
                );

                const modal = document.querySelector('.modal');
                if(modal) modal.remove();
                
                tareas = tareas.map(tareaMemoria => {
                    if (tareaMemoria.id === id) {
                        tareaMemoria.estado = estado;
                        tareaMemoria.nombre = nombre;
                    }
                    return tareaMemoria;
                });
                mostrarTareas();
            }
        } catch (error) {
            console.log(error);
        }
    }

    function confirmarEliminarTarea(tarea) {
        Swal.fire({
            title: 'Eliminar Tarea?',
            text: "No hay vuelta atras...",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si! Muere!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                eliminarTarea(tarea);
            }
        });
    }

    async function eliminarTarea(tarea) {

        const { estado, id, nombre } = tarea;
        const datos = new FormData();
        datos.append('id', id);
        datos.append('nombre', nombre);
        datos.append('estado', estado);
        datos.append('proyectoId', obtenerProyecto());
        try {
            const url = "https://uptask2.herokuapp.com/api/tarea/eliminar";
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });
            const resultado = await respuesta.json();

            if (resultado.resultado) {
                // mostrarAlerta(resultado.mensaje, resultado.tipo, document.querySelector('.contenedor-nueva-tarea'));

                Swal.fire('Eliminado!', resultado.mensaje, 'success');
                tareas = tareas.filter(tareaMemoria => tareaMemoria.id !== tarea.id);
                mostrarTareas();
            } else {
                Swal.fire('Ups...', resultado.mensaje, 'error');
                // mostrarAlerta(resultado.mensaje, resultado.tipo, document.querySelector('.contenedor-nueva-tarea'));
            }
        } catch (error) {
            console.log(error);
        }
    }

    function obtenerProyecto() {
        const proyectoParams = new URLSearchParams(window.location.search);
        const proyecto = Object.fromEntries(proyectoParams.entries());
        return proyecto.id;
    }

    function limpiarTareas() {
        const listadoTareas = document.querySelector('#listado-tareas');

        while (listadoTareas.firstChild) {
            listadoTareas.removeChild(listadoTareas.firstChild);
        }
    }
    function resetFiltro(){
        const checkBoxSelected = document.querySelector('#todas');
        checkBoxSelected.checked = true;
    }
})(); // Este parentesis es para ejecutar la función inmediatamente