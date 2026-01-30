
/**
 * Lógica genérica de inicialización de gráficas
 */
document.addEventListener('DOMContentLoaded', function () {
    const charts = document.querySelectorAll('canvas[data-chart-type]');

    charts.forEach(canvas => {
        const ctx = canvas.getContext('2d');
        const type = canvas.dataset.chartType || 'bar';
        const labels = JSON.parse(canvas.dataset.chartLabels || '[]');
        const data = JSON.parse(canvas.dataset.chartData || '[]');
        const labelText = canvas.dataset.chartLabel || '';

        new Chart(ctx, {
            type: type,
            data: {
                labels: labels,
                datasets: [{
                    label: labelText,
                    data: data,
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
});
