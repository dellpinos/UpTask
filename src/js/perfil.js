

const graficoTareas = document.querySelector('#grafico-tareas');
const graficoProyectos = document.querySelector('#grafico-proyectos');
const textoTotalTareas = document.querySelector('#total_tareas');
const textoTotalTareasCompletadas = document.querySelector('#total_tareas_completadas');
const textoTotalProyectos = document.querySelector('#total_proyectos');
const textoTotalProyectosCompletados = document.querySelector('#total_proyectos_completados');
obtenerContadores();

async function obtenerContadores() {

    try {
        const url = '/api/perfil';
        const respuesta = await fetch(url);
        const resultado = await respuesta.json();


        const totalProyectos = resultado.contadores.total_proyectos;
        const proyectosCompletados = resultado.contadores.total_proyectos_completados;
        const totalTareas = resultado.contadores.total_tareas;
        const tareasCompletadas = resultado.contadores.total_tareas_completadas;

        textoTotalTareas.textContent = totalTareas;
        textoTotalTareasCompletadas.textContent = tareasCompletadas;

        textoTotalProyectos.textContent = totalProyectos;
        textoTotalProyectosCompletados.textContent = proyectosCompletados;



        new Chart(graficoTareas, {
            type: 'pie',
            data: {
                labels: '',
                datasets: [{
                    label: '',
                    data: [tareasCompletadas, totalTareas - tareasCompletadas],
                    borderWidth: 1,
                    backgroundColor: [
                        '#0CAEE8',
                        '#FFA500',
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                scales: {
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
        new Chart(graficoProyectos, {
            type: 'pie',
            data: {
                labels: '',
                datasets: [{
                    label: '',
                    data: [proyectosCompletados, totalProyectos - proyectosCompletados],
                    borderWidth: 1,
                    backgroundColor: [
                        '#0CAEE8',
                        '#FFA500',
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                scales: {
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });






    } catch (error) {
        console.log(error);
    }
}





