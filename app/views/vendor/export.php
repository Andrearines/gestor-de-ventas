<div class="vendor-export-container">
    <div class="header">
        <h1>Exportar Reportes</h1>
        <p>Descarga tus datos en diferentes formatos para tu control personal.</p>
    </div>

    <div class="export-options">
        <div class="export-card">
            <div class="icon-bg">
                <i class="fa-solid fa-file-excel"></i>
            </div>
            <div class="content">
                <h3>Reporte Mensual</h3>
                <p>Detalle completo de ventas y comisiones en formato Excel.</p>
                <a href="#" class="btn-download">
                    <i class="fa-solid fa-download"></i> Descargar Excel
                </a>
            </div>
        </div>

        <div class="export-card">
            <div class="icon-bg">
                <i class="fa-solid fa-file-pdf"></i>
            </div>
            <div class="content">
                <h3>Listado de Boletos</h3>
                <p>Documento PDF con el historial de boletos asignados.</p>
                <a href="#" class="btn-download">
                    <i class="fa-solid fa-download"></i> Descargar PDF
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .vendor-export-container {
        padding: 2rem;
    }

    .header {
        margin-bottom: 2rem;
    }

    .export-options {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .card {
        background: white;
        padding: 1.5rem;
        border-radius: 1rem;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1);
    }

    .btn-primary {
        background: #2b8cee;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        cursor: pointer;
        margin-top: 1rem;
    }
</style>