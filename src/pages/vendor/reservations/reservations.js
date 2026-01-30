
function openReservationModal() {
    const modal = document.getElementById('reservationModal');
    if (modal) modal.style.display = 'flex';
}

function closeReservationModal() {
    const modal = document.getElementById('reservationModal');
    if (modal) modal.style.display = 'none';
}

function handleResSubmit(e) {
    e.preventDefault();
    alert('Reserva creada exitosamente (Simulación)');
    closeReservationModal();
}
