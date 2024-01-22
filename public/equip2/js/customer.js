/**
 * AJAX
 * Esborra el client
 */
$(document).ready(function () {
    // Manejar el clic en el enlace de eliminación
    $('.delete-link').on('click', function (e) {
        e.preventDefault(); // Evitar que el enlace siga el enlace predeterminado

        // Mostrar el modal de confirmación
        $('#deleteConfirmationModal').show();

        // Obtener la fila del usuario que se eliminará
        var row = $(this).closest('tr');

        // Manejar clic en el botón de confirmación de eliminación
        $('#confirmDeleteButton').on('click', function () {
            // Cerrar el modal
            $('#deleteConfirmationModal').hide();

            // Obtener el ID del usuario a eliminar
            var userId = row.find('td:first').text();

            // Realizar la solicitud AJAX para eliminar al usuario
            $.ajax({
                type: 'POST',
                url: '/customer_delete_process.php', // La URL de tu script PHP para eliminar
                data: { id: userId }, // Datos que se enviarán al script PHP
                success: function (response) {
                    // Ocultar la fila visualmente sin actualizar la página
                    row.fadeOut();

                    // Puedes agregar más lógica según la respuesta del servidor si es necesario
                },
                error: function (error) {
                    console.error('Error en la solicitud AJAX: ', error);
                    // Puedes manejar errores según tus necesidades
                }
            });
        });

        // Manejar clic en el botón de cancelar eliminación
        $('#cancelDeleteButton').on('click', function () {
            // Cerrar el modal
            $('#deleteConfirmationModal').hide();
        });

        // Manejar clic en el icono de cerrar del modal
        $('#closeModal').on('click', function () {
            // Cerrar el modal
            $('#deleteConfirmationModal').hide();
        });

        // Evitar la recarga de la página al finalizar la operación
        return false;
    });
});