<div class="create-event-container">
    <!-- Header -->
    <div class="create-event-header">
        <div class="header-title">
            <a href="/admin/events" class="back-link">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h1><?php echo isset($event) ? 'Editar Evento' : 'Crear Nuevo Evento'; ?></h1>
                <p>Completa la información del evento benéfico</p>
            </div>
        </div>
    </div>

    <!-- Formulario -->
    <form id="eventForm" class="event-form" onsubmit="handleSubmit(event)">
        <!-- Información Básica -->
        <div class="form-section">
            <h2 class="section-title">
                <i class="fa-solid fa-circle-info"></i>
                Información Básica
            </h2>

            <div class="form-grid">
                <div class="form-group full-width">
                    <label for="nombre">Nombre del Evento *</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo $event['nombre'] ?? ''; ?>"
                        placeholder="Ej: Festival Benéfico 2024" required>
                    <span class="form-error" id="nombre-error"></span>
                </div>
            </div>
        </div>

        <!-- Fecha y Ubicación -->
        <div class="form-section">
            <h2 class="section-title">
                <i class="fa-solid fa-calendar-days"></i>
                Fecha y Ubicación
            </h2>

            <div class="form-grid">
                <div class="form-group">
                    <label for="fecha">Fecha del Evento *</label>
                    <input type="date" id="fecha" name="fecha" value="<?php echo $event['fecha'] ?? ''; ?>" required>
                    <span class="form-error" id="fecha-error"></span>
                </div>

                <div class="form-group">
                    <label for="hora">Hora *</label>
                    <input type="time" id="hora" name="hora" value="<?php echo $event['hora'] ?? ''; ?>" required>
                </div>

                <div class="form-group full-width">
                    <label for="ubicacion">Ubicación *</label>
                    <input type="text" id="ubicacion" name="ubicacion" value="<?php echo $event['ubicacion'] ?? ''; ?>"
                        placeholder="Ej: Estadio Nacional, Ciudad" required>
                    <span class="form-error" id="ubicacion-error"></span>
                </div>

            </div>
        </div>

        <!-- Boletos -->
        <div class="form-section">
            <h2 class="section-title">
                <i class="fa-solid fa-ticket"></i>
                Configuración de Boletos
            </h2>

            <div class="form-grid">
                <div class="form-group">
                    <label for="total_boletos">Total de Boletos *</label>
                    <input type="number" id="total_boletos" name="total_boletos"
                        value="<?php echo $event['total_boletos'] ?? ''; ?>" min="1" placeholder="100" required>
                    <span class="form-error" id="total_boletos-error"></span>
                </div>

                <div class="form-group">
                    <label for="precio_boleto">Precio por Boleto *</label>
                    <div class="input-group">
                        <span class="input-prefix">$</span>
                        <input type="number" id="precio_boleto" name="precio_boleto"
                            value="<?php echo $event['precio_boleto'] ?? ''; ?>" min="0" step="0.01" placeholder="0.00"
                            required>
                    </div>
                    <span class="form-error" id="precio_boleto-error"></span>
                </div>
            </div>
        </div>

        <!-- Botones de acción -->
        <div class="form-actions">
            <a href="/admin/events" class="btn btn-secondary">
                <i class="fa-solid fa-xmark"></i>
                Cancelar
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-check"></i>
                <?php echo isset($event) ? 'Actualizar Evento' : 'Crear Evento'; ?>
            </button>
        </div>
    </form>
</div>

<script>
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
</script>