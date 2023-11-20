(function () {


    const boton = document.querySelector('#btn-tareas__sugeridas');
    const inputTest = document.querySelector('#nombre-pagina');
    const outputTest = document.querySelector('#tareas-ia-generadas');

    boton.addEventListener('click', enviarPrompt);

    function enviarPrompt(e) {
        while (outputTest.firstChild) {
            outputTest.removeChild(outputTest.firstChild);
        }
        haceConsulta();
    }

    async function haceConsulta() {

        const datos = new FormData();
        datos.append('prompt', inputTest.value);

        try {
            const url = 'http://127.0.0.1:3000/tasktrack/prueba';
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos

            });

            let resultado = await respuesta.json();
            resultado = resultado.replace(/\./g, ""); // eliminar los puntos
            const lista = resultado.split('-');

            if (lista.length !== 0) {
                lista.forEach(e => {

                    const tarea = document.createElement('LI');
                    tarea.textContent = e;
                    tarea.classList.add('tareas__ia-generada');
                    outputTest.appendChild(tarea);
                    tarea.onclick = function () {
                        mostrarFormulario(); // <<<<<<
                    }
                });

            }

        } catch (error) {
            console.log(error);
        }
    }

    function mostrarFormulario(tarea) {

        const modal = document.createElement('DIV');
        modal.classList.add('modal');
        modal.innerHTML = `
        <form class="formulario nueva-tarea">
            <legend>'Añade una nueva tarea'</legend>
            <div class="campo">
                <label>Tarea</label>
                <input type="text" name="tarea" id="tarea" value='tarea.nombre'/>
            </div>
            <div class="opciones">
                <input type="submit" class="submit-nueva-tarea" value="Añadir Tarea"/>
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
                agregarTarea(nombreTarea);
            }

        });

        document.querySelector('.dashboard').appendChild(modal);
            const inputTarea = document.querySelector('#tarea');
            inputTarea.focus();
    }


    async function agregarTarea(tarea) {
        // Construir la petición
        const datos = new FormData();
        datos.append('nombre', tarea);
        datos.append('proyectoId', obtenerProyecto());

        try {
            const url = 'http://127.0.0.1:3000/api/tarea';
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos

            });

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
    function obtenerProyecto() {
        const proyectoParams = new URLSearchParams(window.location.search);
        const proyecto = Object.fromEntries(proyectoParams.entries());
        return proyecto.id;
    }


})();
