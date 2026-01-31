document.addEventListener('DOMContentLoaded', () => {
  const alertasInput = document.getElementById('alertas');
  if (alertasInput) {
    try {
      const alertas = JSON.parse(alertasInput.value);
      mandarAlertas(alertas);
    } catch (e) {
      console.error('Error al procesar alertas:', e);
    }
  }
});

async function mandarAlertas(alertas) {
  for (const tipo of Object.keys(alertas)) {
    const mensajes = alertas[tipo];
    if (Array.isArray(mensajes)) {
      for (const mensaje of mensajes) {
        // Título capitalizado
        const titulo = tipo.charAt(0).toUpperCase() + tipo.slice(1);
        notify(titulo, mensaje, tipo, 4000);

        // Esperamos 600ms antes de mostrar la siguiente para que no se traslapen
        await new Promise(resolve => setTimeout(resolve, 900));
      }
    }
  }
}
