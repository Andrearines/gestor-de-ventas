document.addEventListener('DOMContentLoaded', () => {
    // Capturar datos de PHP (usando ID del componente oficial)
    const alertElement = document.getElementById('alertas');

    if (alertElement) {
        try {
            const alertas = JSON.parse(alertElement.value);
            console.log('Datos cargados de PHP:', alertas);

            // Si existen alertas de backend, mostrarlas con SweetAlert
            if (alertas && Object.keys(alertas).length > 0) {
                // Aquí iría la integración con SweetAlert para mostrar errores/éxito
            }
        } catch (e) {
            console.error('Error al parsear alertas de PHP:', e);
        }
    }
});
