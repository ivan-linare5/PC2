//PRINCIPAL*************************************************************************************
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

//PROFESORES**************************************************************************************
let telefonoCount = 1; // Contador para llevar el seguimiento de los campos de teléfono

function agregarTelefono() {
    // Crea un nuevo div que contendrá los nuevos inputs
    const nuevoTelefono = document.createElement('div');
    nuevoTelefono.className = 'input-group mb-3 flex-wrap'; // Agrega margen inferior y permite el ajuste

    // Crea el input para el número de teléfono
    const inputNumero = document.createElement('input');
    inputNumero.type = 'text';
    inputNumero.name = `telefonos[${telefonoCount}][numero]`;
    inputNumero.className = 'form-control me-2'; // Espacio a la derecha
    inputNumero.placeholder = 'Teléfono de Emergencia';
    inputNumero.minLength = 10;
    inputNumero.maxLength = 10;
    inputNumero.pattern = '\\d{10}';
    inputNumero.title = 'Debe tener exactamente 10 dígitos';
    inputNumero.required = true;

    // Crea el input para la descripción
    const inputDescripcion = document.createElement('input');
    inputDescripcion.type = 'text';
    inputDescripcion.name = `telefonos[${telefonoCount}][descripcion]`;
    inputDescripcion.className = 'form-control me-2'; // Espacio a la derecha
    inputDescripcion.placeholder = 'Descripción';
    inputDescripcion.required = true;

    // Crea el botón de eliminar
    const btnEliminar = document.createElement('button');
    btnEliminar.className = 'btn btn-danger'; // Estilo del botón
    btnEliminar.textContent = '−'; // Texto del botón (símbolo de menos)
    btnEliminar.type = 'button'; // Evitar que se envíe el formulario
    btnEliminar.style.width = '40px'; // Ancho del botón
    btnEliminar.style.height = '40px'; // Alto del botón
    btnEliminar.style.marginLeft = '10px'; // Espacio a la izquierda
    btnEliminar.onclick = function() {
        // Elimina el div de los teléfonos
        nuevoTelefono.remove();
    };

    // Crea un contenedor para los inputs y el botón
    const contenedorInputs = document.createElement('div');
    contenedorInputs.className = 'd-flex justify-content-center align-items-center flex-wrap'; // Permite el ajuste responsivo

    // Agrega los inputs y el botón de eliminar al nuevo div
    contenedorInputs.appendChild(inputNumero);
    contenedorInputs.appendChild(inputDescripcion);
    contenedorInputs.appendChild(btnEliminar); // Agrega el botón de eliminar

    // Agrega el contenedor de inputs al div principal
    nuevoTelefono.appendChild(contenedorInputs);

    // Agrega el nuevo div al contenedor de teléfonos
    document.getElementById('telefonos-container').appendChild(nuevoTelefono);

    // Incrementa el contador para el siguiente input
    telefonoCount++;
}


