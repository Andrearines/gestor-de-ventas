// Validación del formulario
function handleSubmit(e) {
    e.preventDefault();

    // Limpiar errores previos
    document.querySelectorAll('.form-error').forEach(el => el.textContent = '');
    document.querySelectorAll('.form-group').forEach(el => el.classList.remove('has-error'));

    let isValid = true;

    // Validar nombre
    const nombre = document.getElementById('nombre');
    if (nombre.value.trim().length < 3) {
        showError('nombre', 'El nombre debe tener al menos 3 caracteres');
        isValid = false;
    }

    // Validar fecha (no puede ser en el pasado)
    const fecha = document.getElementById('fecha');
    const selectedDate = new Date(fecha.value);
    const today = new Date();
    today.setHours(0, 0, 0, 0);

    if (selectedDate < today) {
        showError('fecha', 'La fecha no puede ser en el pasado');
        isValid = false;
    }

    // Validar total de boletos
    const totalBoletos = document.getElementById('total_boletos');
    if (parseInt(totalBoletos.value) < 1) {
        showError('total_boletos', 'Debe haber al menos 1 boleto');
        isValid = false;
    }

    // Validar precio
    const precio = document.getElementById('precio_boleto');
    if (parseFloat(precio.value) < 0) {
        showError('precio_boleto', 'El precio no puede ser negativo');
        isValid = false;
    }

    if (isValid) {
        // Enviar formulario
        submitForm();
    }
}

function showError(fieldId, message) {
    const errorEl = document.getElementById(`${fieldId}-error`);
    const fieldEl = document.getElementById(fieldId);

    errorEl.textContent = message;
    fieldEl.closest('.form-group').classList.add('has-error');
}

function submitForm() {
    const form = document.getElementById('eventForm');
    const formData = new FormData(form);
    const data = Object.fromEntries(formData);

    // Mostrar loading
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Guardando...';

    // Simular envío (aquí iría la llamada AJAX real)
    fetch('/admin/events/store', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                // Redirigir con mensaje de éxito
                window.location.href = '/admin/events?created=1';
            } else {
                alert('Error al guardar el evento');
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al guardar el evento');
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        });
}

// Auto-completar hora actual si está vacía
document.addEventListener('DOMContentLoaded', function () {
    const horaInput = document.getElementById('hora');
    if (!horaInput.value) {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        horaInput.value = `${hours}:${minutes}`;
    }
});