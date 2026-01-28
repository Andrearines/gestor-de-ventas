<div class="audit-container">
    <!-- Header -->
    <div class="audit-header">
        <div class="header-title">
            <h1>Auditoría de Sistema</h1>
            <p>Registro cronológico de todas las acciones y eventos relevantes del sistema.</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-secondary"><i class="fa-solid fa-download"></i> Descargar Logs</button>
        </div>
    </div>

    <!-- Audit Timeline/Table -->
    <div class="table-card">
        <div class="table-responsive">
            <table class="audit-table">
                <thead>
                    <tr>
                        <th>Fecha y Hora</th>
                        <th>Usuario</th>
                        <th>Acción</th>
                        <th>Detalle</th>
                        <th>Nivel</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($logs as $log): ?>
                        <tr>
                            <td><span class="timestamp">
                                    <?php echo $log['fecha']; ?>
                                </span></td>
                            <td>
                                <div class="user-info">
                                    <div class="avatar-xs">
                                        <?php echo substr($log['usuario'], 0, 1); ?>
                                    </div>
                                    <span>
                                        <?php echo $log['usuario']; ?>
                                    </span>
                                </div>
                            </td>
                            <td><span class="action-tag">
                                    <?php echo $log['accion']; ?>
                                </span></td>
                            <td><span class="detail-text">
                                    <?php echo $log['detalle']; ?>
                                </span></td>
                            <td>
                                <span class="level-badge level-<?php echo $log['tipo']; ?>">
                                    <?php echo strtoupper($log['tipo']); ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>