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
    <canvas id="<?php echo $chartId; ?>" data-chart-type="bar" data-chart-labels='<?php echo json_encode($labels); ?>'
        data-chart-data='<?php echo json_encode($data); ?>' data-chart-label="<?php echo $label; ?>"></canvas>
</div>

<style>
    .bar-chart-component {
        width: 100%;
        height: 100%;
        min-height: 250px;
    }
</style>