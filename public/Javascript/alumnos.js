$(document).ready(function () {
    // Manejar el envío del formulario para agregar un nuevo alumno
    $('#modalFormulario').on('submit', function (event) {
        event.preventDefault(); // Evitar el envío por defecto

        // Capturar los datos del formulario
        const data = {
            no_registro: $('#no_registro').val(),
            clave_unica: $('#clave_unica').val(),
            nombre: $('#nombre').val(),
            apellido_paterno: $('#apellidoPaterno').val(),
            apellido_materno: $('#apellidoMaterno').val(),
            correo: $('#correo').val(),
            clave_carrera: $('#claveCarrera').val(),
            telefono: $('#telefono').val(),
            fecha_ingreso: $('#fechaIngreso').val(),
        };

        // Enviar los datos usando AJAX
        $.ajax({
            url: '/ruta-a-tu-api/alumnos', // Cambia esto a la ruta correcta
            method: 'POST',
            data: data,
            success: function (response) {
                alert('Alumno agregado correctamente');
                $('#modalForm').modal('hide'); // Cerrar el modal
                $('#modalFormulario')[0].reset(); // Limpiar el formulario
                // Opcional: Aquí puedes agregar código para actualizar la lista de alumnos
            },
            error: function (xhr) {
                alert('Error al agregar el alumno');
            }
        });
    });
});
