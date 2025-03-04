document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('form-habitaciones');
    const listaHabitaciones = document.getElementById('lista-habitaciones');
    const listaReservas = document.getElementById('lista-reservas');

    const habitaciones = {
        estandar: {
            precio: 150,
            descripcion: 'Una habitación acogedora con vista al jardín, equipada con una cama Queen, aire acondicionado, Wi-Fi, TV de pantalla plana y minibar. Ideal para quienes buscan comodidad a un precio accesible.'
        },
        deluxe: {
            precio: 220,
            descripcion: 'Disfruta de una hermosa vista al océano desde tu balcón privado. La habitación cuenta con una cama King, área de descanso, baño de lujo con jacuzzi, minibar y servicio a la habitación 24/7.'
        },
        junior: {
            precio: 320,
            descripcion: 'Un espacio amplio y elegante con sala de estar, terraza privada con vista al mar, cama King, jacuzzi y acceso a zona VIP en la playa. Incluye desayuno buffet y traslado gratuito desde el aeropuerto.'
        },
        presidencial: {
            precio: 550,
            descripcion: 'La máxima experiencia de lujo. Amplia suite de dos habitaciones con vistas panorámicas, terraza con piscina privada, baño con jacuzzi, sala de estar con bar privado y mayordomo personal.'
        },
        bungalow: {
            precio: 700,
            descripcion: 'Un exclusivo bungalow de lujo sobre la arena, con acceso directo a la playa, piscina privada, terraza con hamacas, cocina equipada, baño de mármol y servicio de chef privado.'
        }
    };
    document.getElementById('tipo').addEventListener('change', function() {
        const tipo = this.value;
        if (tipo && habitaciones[tipo]) {
            document.getElementById('precio').value = habitaciones[tipo].precio;
            document.getElementById('descripcion').value = habitaciones[tipo].descripcion;
        } else {
            document.getElementById('precio').value = '';
            document.getElementById('descripcion').value = '';
        }
    });

    form.addEventListener('submit', (e) => {
        e.preventDefault();

        const tipo = document.getElementById('tipo').value;
        const precio = document.getElementById('precio').value;
        const disponibilidad = document.getElementById('disponibilidad').value;
        const descripcion = document.getElementById('descripcion').value;
        const imagenes = document.getElementById('imagenes').files;

        const habitacionDiv = document.createElement('div');
        habitacionDiv.innerHTML = `
            <span>Tipo: ${tipo}, Precio: ${precio}, Disponibilidad: ${disponibilidad}</span>
            <p>${descripcion}</p>
        `;

        Array.from(imagenes).forEach(imagen => {
            const reader = new FileReader();
            reader.onload = function(event) {
                const img = document.createElement('img');
                img.src = event.target.result;
                img.alt = `Imagen de ${tipo}`;
                habitacionDiv.appendChild(img);
            };
            reader.readAsDataURL(imagen);
        });

        const eliminarBtn = document.createElement('button');
        eliminarBtn.textContent = 'Eliminar';
        eliminarBtn.classList.add('eliminar');
        eliminarBtn.addEventListener('click', () => {
            listaHabitaciones.removeChild(habitacionDiv);
        });
        habitacionDiv.appendChild(eliminarBtn);

        listaHabitaciones.appendChild(habitacionDiv);

        form.reset();
    });

    // Simulación de datos de reservas
    const reservas = [
        { cliente: 'Juan Pérez', fechas: '2025-03-01 a 2025-03-05', estado: 'Activa', pago: 'Pagado' },
        { cliente: 'Ana Gómez', fechas: '2025-03-10 a 2025-03-15', estado: 'Cancelada', pago: 'Reembolsado' }
    ];

    reservas.forEach(reserva => {
        const reservaDiv = document.createElement('div');
        reservaDiv.innerHTML = `
            <span>Cliente: ${reserva.cliente}, Fechas: ${reserva.fechas}, Estado: ${reserva.estado}, Pago: ${reserva.pago}</span>
        `;
        listaReservas.appendChild(reservaDiv);
    });
});