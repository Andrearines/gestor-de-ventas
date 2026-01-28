document.addEventListener('DOMContentLoaded', () => {
    const combosRaw = document.getElementById('php-combos').value;
    const boletosRaw = document.getElementById('php-boletos').value;

    const combos = JSON.parse(combosRaw);
    const boletos = JSON.parse(boletosRaw);

    console.log('Combos:', combos);
    console.log('Boletos:', boletos);

    // Lógica para actualizar resumen al seleccionar
});
