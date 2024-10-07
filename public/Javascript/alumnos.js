$(document).ready(function() {
    $("#alumnoForm").on("submit", function(event) {
        event.preventDefault(); // Evitar el envío normal del formulario

        // Captura los datos del formulario
        var data = {
            claveUnica: $("#claveUnica").val(),
            nombre: $("#nombreAlumno").val(),
            apellidoPaterno: $("#apellidoPaterno").val(),
            apellidoMaterno: $("#apellidoMaterno").val(),
            correo: $("#correo").val(),
            claveCarrera: $("#claveCarrera").val(),
            telefono: $("#telefono").val(),
            fechaIngreso: $("#fechaIngreso").val()
        };

        // Enviar los datos al servidor
        $.ajax({
            type: "POST",
            url: "ruta/a/tu/endpoint", // Cambia esto a la ruta de tu endpoint en el backend
            data: JSON.stringify(data),
            contentType: "application/json",
            success: function(response) {
                alert("Alumno guardado con éxito.");
                // Opcional: Limpiar el formulario después de guardar
                $("#alumnoForm")[0].reset();
            },
            error: function(xhr, status, error) {
                alert("Error al guardar el alumno: " + error);
            }
        });
    });
});
