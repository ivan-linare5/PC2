// Colocar la fecha en el lugar correspondiente
document.addEventListener('DOMContentLoaded', () => {
    // Obtener la fecha actual
    const today = new Date();

    // Opciones de formato para la fecha
    const options = {
        weekday: 'long', // Nombre completo del día
        day: 'numeric',  // Día del mes
        month: 'long',   // Nombre completo del mes
        year: 'numeric'  // Año completo
    };

    // Formatear la fecha en el formato deseado
    const formattedDate = today.toLocaleDateString('es-ES', options);
    
    // Convertir el texto a mayúsculas
    const uppercasedDate = formattedDate.toUpperCase();
    
    // Insertar la fecha en la celda con el ID "date"
    document.getElementById('date').textContent = uppercasedDate;
});

//funcion para cargar dinamicamente el contenido de catalogos
function cargarContenido(ruta) {
    fetch(ruta)
        .then(response => response.text())
        .then(data => {
            document.querySelector('.content').innerHTML = data; // Actualiza el contenedor con el contenido dinámico
        })
        .catch(error => console.error('Error al cargar el contenido:', error));
}

