<?php \components\ComponentManager::make('alert/alertas', ['alertas' => $alertas])->echo(); ?>
<div class="create-event-container">
    <!-- Header -->
    <div class="create-event-header">
        <div class="header-title">
            <a href="/admin/events" class="back-link">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h1>
                    <?php echo isset($event) ? 'Editar Evento' : 'Crear Nuevo Evento'; ?>
                </h1>
                <p>Completa la información del evento benéfico</p>
            </div>
        </div>
    </div>

    <!-- Formulario -->
    <form id="eventForm" class="event-form" method="POST">
        <!-- Información Básica -->
        <div class="form-section">
            <h2 class="section-title">
                <i class="fa-solid fa-circle-info"></i>
                Información Básica
            </h2>

            <div class="form-grid">
                <div class="form-group">
                    <label for="name">Nombre del Evento *</label>
                    <input type="text" id="name" name="name" value="<?php echo $event->name ?? ''; ?>"
                        placeholder="Ej: Festival Benéfico 2024" required>
                    <span class="form-error" id="name-error"></span>
                </div>
                <div class="form-group">
                    <label for="code">Código del Evento *</label>
                    <input type="text" id="code" name="code" value="<?php echo $event->code ?? ''; ?>"
                        placeholder="Ej: EVENT-001" required>
                    <span class="form-error" id="code-error"></span>
                </div>
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label for="restaurant_id">Restaurante *</label>
                    <select id="restaurant_id" name="restaurant_id" required>
                        <option value="">Seleccione un restaurante</option>
                        <?php foreach ($restaurants as $restaurant): ?>
                            <option value="<?php echo $restaurant->id; ?>" <?php echo (isset($Event_Restaurant->restaurant_id) && $event->id_restaurante == $restaurant->id) ? 'selected' : ''; ?>>
                                <?php echo $restaurant->name; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="form-error" id="restaurant_id-error"></span>
                </div>
                <div class="form-group">
                    <label for="status">Estado *</label>
                    <select id="status" name="status" required>
                        <option value="">Seleccione un estado</option>
                        <option value="1" <?php echo (isset($event->status) && $event->status == '1') ? 'selected' : ''; ?>>Activo</option>
                        <option value="0" <?php echo (isset($event->status) && $event->status == '0') ? 'selected' : ''; ?>>Inactivo</option>
                    </select>
                    <span class="form-error" id="status-error"></span>
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
                    <label for="start_date">Fecha de Inicio *</label>
                    <input type="date" id="start_date" name="start_date" value="<?php echo $event->start_date ?? ''; ?>"
                        required>
                    <span class="form-error" id="start_date-error"></span>
                </div>

                <div class="form-group">
                    <label for="end_date">Fecha de Fin *</label>
                    <input type="date" id="end_date" name="end_date" value="<?php echo $event->end_date ?? ''; ?>"
                        required>
                    <span class="form-error" id="end_date-error"></span>
                </div>


                <div class="form-group full-width">
                    <label for="school_name">Nombre de la Escuela / Ubicación *</label>
                    <input type="text" id="school_name" name="school_name"
                        value="<?php echo $event->school_name ?? ''; ?>" placeholder="Ej: Estadio Nacional, Ciudad"
                        required>
                    <span class="form-error" id="school_name-error"></span>
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
                        value="<?php echo $eventTickets ?? 0; ?>" min="1" placeholder="100" required>
                    <span class="form-error" id="total_boletos-error"></span>
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