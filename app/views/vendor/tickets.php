<div class="vendor-tickets-container">
    <div class="header">
        <h1>Mis Boletos Asignados</h1>
        <p>Listado de boletos físicos bajo tu responsabilidad.</p>
    </div>

    <div class="table-card">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Número</th>
                    <th>Evento</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tickets as $ticket): ?>
                    <tr>
                        <td>
                            <span class="ticket-number">#<?php echo $ticket['numero']; ?></span>
                        </td>
                        <td>
                            <?php echo $ticket['evento']; ?>
                        </td>
                        <td>
                            <span class="status-badge status-<?php echo $ticket['status']; ?>">
                                <?php echo ucfirst($ticket['status']); ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>