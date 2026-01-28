<?php
/**
 * Componente de Gráfico de Barras con Chart.js
 * 
 * @var string $chartId ID único para el canvas
 * @var string $title Título del gráfico
 * @var array $labels Etiquetas del eje X
 * @var array $data Datos a mostrar
 * @var string $label Etiqueta del conjunto de datos
 */
?>

<div class="bar-chart-component">
    <canvas id="<?php echo $chartId; ?>"></canvas>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('<?php echo $chartId; ?>').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                label: '<?php echo $label; ?>',
                data: <?php echo json_encode($data); ?>,
                backgroundColor: 'rgba(43, 140, 238, 0.2)',
                borderColor: 'rgb(43, 140, 238)',
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false,
                }]
            },
        options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                backgroundColor: '#1f2937',
                padding: 12,
                cornerRadius: 8,
                displayColors: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    display: true,
                    drawBorder: false,
                    color: '#f3f4f6'
                },
                ticks: {
                    color: '#9ca3af',
                    font: {
                        size: 11
                    }
                }
            },
            x: {
                grid: {
                    display: false
                },
                ticks: {
                    color: '#9ca3af',
                    font: {
                        size: 11
                    }
                }
            }
        }
    }
        });
    });
</script>

<style>
    .bar-chart-component {
        width: 100%;
        height: 100%;
        min-height: 250px;
    }
</style>