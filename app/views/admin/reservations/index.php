<div class="reservations-admin-container">
    <div class="header">
        <h1>Control de Reservas</h1>
        <p>Administración y seguimiento de apartados de boletos.</p>
    </div>

    <div class="table-card">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Vendedor</th>
                    <th>Cliente</th>
                    <th>Boletos</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $res): ?>
                    <tr>
                        <td>#
                            <?php echo $res['id']; ?>
                        </td>
                        <td>
                            <?php echo $res['vendedor']; ?>
                        </td>
                        <td>
                            <?php echo $res['cliente']; ?>
                        </td>
                        <td>
                            <?php echo $res['boletos']; ?>
                        </td>
                        <td>
                            <span class="status-badge status-<?php echo $res['status']; ?>">
                                <?php echo ucfirst($res['status']); ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    .reservations-admin-container {
        padding: 2rem;
    }

    .header {
        margin-bottom: 2rem;
    }

    .table-card {
        background: white;
        border-radius: 1rem;
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        padding: 1rem;
    }

    .admin-table {
        width: 100%;
        border-collapse: collapse;
    }

    .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .status-pendiente {
        background: #fef9c3;
        color: #854d0e;
    }

    .status-confirmada {
        background: #dcfce7;
        color: #15803d;
    }
</style>