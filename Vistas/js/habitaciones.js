function mostrarFormularioReserva(habitacionId, nombre, descripcion, imagen, precio) {
    document.getElementById('habitacion-id').value = habitacionId;
    document.getElementById('vista-previa-nombre').innerText = nombre;
    document.getElementById('vista-previa-descripcion').innerText = descripcion;
    document.getElementById('vista-previa-imagen').src = '../../' + imagen; // Ajuste aquí
    document.getElementById('vista-previa-precio').innerText = 'Precio: $' + precio;
    document.getElementById('formulario-reserva').style.display = 'block';

    // Cargar sub-habitaciones
    fetch(`../../Back-end/php/obtener_sub_habitaciones.php?habitacion_id=${habitacionId}`)
        .then(response => response.json())
        .then(data => {
            const subHabitacionesDiv = document.getElementById('sub-habitaciones');
            subHabitacionesDiv.innerHTML = '';
            data.forEach(subHabitacion => {
                const subHabitacionDiv = document.createElement('div');
                subHabitacionDiv.classList.add('sub-habitacion');
                if (subHabitacion.estado === 'ocupada') {
                    subHabitacionDiv.classList.add('ocupada');
                }
                subHabitacionDiv.setAttribute('data-id', subHabitacion.id);
                subHabitacionDiv.innerHTML = `
                    <span>Habitación ${subHabitacion.id}</span>
                    <span class="estado">${subHabitacion.estado === 'ocupada' ? 'Ocupada' : 'Disponible'}</span>
                `;
                subHabitacionDiv.addEventListener('click', () => seleccionarSubHabitacion(subHabitacionDiv));
                subHabitacionesDiv.appendChild(subHabitacionDiv);
            });
        })
        .catch(error => {
            console.error('Error al cargar las sub-habitaciones:', error);
        });
}

function cerrarFormularioReserva() {
    document.getElementById('formulario-reserva').style.display = 'none';
}

function seleccionarSubHabitacion(element) {
    const subHabitaciones = document.querySelectorAll('.sub-habitacion');
    subHabitaciones.forEach(subHabitacion => {
        subHabitacion.classList.remove('reservada');
    });
    element.classList.add('reservada');
    document.getElementById('sub-habitacion-id').value = element.getAttribute('data-id');
}
document.addEventListener('DOMContentLoaded', () => {
    const formReserva = document.getElementById('form-reserva');
    formReserva.addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new FormData(formReserva);
        fetch(formReserva.action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                mostrarError(data.error, data.options);
            } else if (data.success) {
                alert(data.success);
                cerrarFormularioReserva();
            }
        })
        .catch(error => {
            console.error('Error al realizar la reserva:', error);
        });
    });
});

function mostrarError(mensaje, opciones) {
    const errorContainer = document.getElementById('error-container');
    errorContainer.innerHTML = `<p>${mensaje}</p>`;
    if (opciones) {
        const listaOpciones = document.createElement('ul');
        opciones.forEach(opcion => {
            const item = document.createElement('li');
            item.textContent = opcion;
            listaOpciones.appendChild(item);
        });
        errorContainer.appendChild(listaOpciones);
    }
    errorContainer.style.display = 'block';
}

function cerrarFormularioReserva() {
    document.getElementById('formulario-reserva').style.display = 'none';
    document.getElementById('error-container').style.display = 'none';
}