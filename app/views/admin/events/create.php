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