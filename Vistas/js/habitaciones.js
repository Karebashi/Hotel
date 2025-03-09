function mostrarFormularioReserva(habitacionId, nombre, descripcion, imagen, precio) {
    document.getElementById('habitacion-id').value = habitacionId;
    document.getElementById('vista-previa-nombre').innerText = nombre;
    document.getElementById('vista-previa-descripcion').innerText = descripcion;
    document.getElementById('vista-previa-imagen').src = 'data:image/jpeg;base64,' + imagen;
    document.getElementById('vista-previa-precio').innerText = 'Precio: $' + precio;
    document.getElementById('formulario-reserva').style.display = 'block';
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
    document.getElementById('sub-habitacion-id').value = element.querySelector('span').innerText.split(' ')[1];
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
        .then(response => response.text())
        .then(data => {
            alert(data);
            cerrarFormularioReserva();
        })
        .catch(error => {
            console.error('Error al realizar la reserva:', error);
        });
    });
});