<div class="sales-report-container">
    <div class="header">
        <h1>Reporte de Ventas Globales</h1>
        <p>Monitoreo en tiempo real de las transacciones del sistema.</p>
    </div>

    <div class="table-card">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Vendedor</th>
                    <th>Evento</th>
                    <th>Monto</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sales as $sale): ?>
                    <tr>
                        <td>#
                            <?php echo $sale['id']; ?>
                        </td>
                        <td>
                            <?php echo $sale['vendedor']; ?>
                        </td>
                        <td>
                            <?php echo $sale['evento']; ?>
                        </td>
                        <td>$
                            <?php echo number_format($sale['monto'], 2); ?>
                        </td>
                        <td>
                            <?php echo $sale['fecha']; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    .sales-report-container {
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

    .admin-table th {
        text-align: left;
        padding: 1rem;
        border-bottom: 2px solid #f3f4f6;
        color: #6b7280;
        font-size: 0.875rem;
    }

    .admin-table td {
        padding: 1rem;
        border-bottom: 1px solid #f3f4f6;
        color: #111827;
    }
</style>