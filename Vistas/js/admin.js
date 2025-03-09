document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('form-habitaciones');
    const listaHabitaciones = document.getElementById('lista-habitaciones');
    const listaReservas = document.getElementById('lista-reservas');

    const habitaciones = {
        sencilla : {
            precio: 150,
            descripcion: 'Una elegante habitación con cama King, diseñada para ofrecer comodidad y sofisticación. Está equipada con aire acondicionado, Wi-Fi, TV de pantalla plana, minibar y servicio de desayuno en la habitación. Perfecta para viajeros de negocios o parejas que buscan una estancia placentera.'
        },
        doble: {
            precio: 220,
            descripcion: 'Habitación cómoda y luminosa con una cama doble y una individual, ideal para hasta cuatro personas. Equipada con aire acondicionado, ropa de cama de calidad y decoración elegante con detalles florales.'
        },
        deluxe: {
            precio: 320,
            descripcion: 'Amplia y cómoda habitación ideal para familias o grupos. Cuenta con dos camas dobles y dos individuales, con capacidad para hasta seis personas. Equipada con aire acondicionado, ropa de cama premium y grandes ventanales que brindan luz natural. Su decoración elegante y detalles florales crean un ambiente acogedor.'
        },
        confort: {
            precio: 550,
            descripcion: 'Moderna y acogedora, ideal para parejas o viajeros. Cuenta con una cama doble, escritorio elegante y una pantalla plana. La luz natural fluye a través de amplias ventanas con cortinas traslúcidas, brindando un ambiente cálido y relajante. Equipada con aire acondicionado y ropa de cama de alta calidad.'
        },
    };

    document.getElementById('tipo').addEventListener('change', function() {
        const tipo = this.value;
        if (tipo && habitaciones[tipo]) {
            document.getElementById('nombre').value = tipo;
            document.getElementById('precio').value = habitaciones[tipo].precio;
            document.getElementById('descripcion').value = habitaciones[tipo].descripcion;
        } else {
            document.getElementById('precio').value = '';
            document.getElementById('descripcion').value = '';
        }
    });

    form.addEventListener('submit', (e) => {
        e.preventDefault();

        const formData = new FormData(form); // Capturar los datos del formulario

        fetch("guardar_habitacion.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            alert("Habitación agregada correctamente.");
            location.reload(); // Recargar la página para mostrar la nueva habitación
        })
        .catch(error => {
            console.error("Error al guardar la habitación:", error);
        });
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

