$(document).ready(function() {
    // Función para abrir el modal con el contenido específico cargado por AJAX
    function openModalWithContent(content) {
        $('#modal-AJAX-content').html(content);
        $('#modal-container').show();
        $('#background-modal').show();
    }

    // Función para cerrar el modal
    function closeModal() {
        $('#modal-container').hide();
        $('#background-modal').hide();
    }

    // Función genérica para cargar contenido por URL
    function loadContentByUrl(url) {
        $.ajax({
            type: "GET",
            url: url,
            success: function(response) {
                // Buscar y extraer el contenido del section
                var sectionStart = response.indexOf('<section');
                var sectionEnd = response.indexOf('</section>', sectionStart) + 9;
                var sectionHTML = response.substring(sectionStart, sectionEnd);

                openModalWithContent(sectionHTML);
            },
            error: function() {
                console.error('Error al cargar el contenido.');
            }
        });
    }

    // Función para cargar detalles de factura mediante AJAX
    function loadInvoiceDetails(invoiceId) {
        // Asumiendo que la URL se forma agregando el ID a la base "/invoice_detail.php"
        var url = "/invoice_detail.php?id=" + invoiceId;

        // Llama a la función genérica de carga
        loadContentByUrl(url);
    }

    // Función para cargar información de borrado mediante AJAX
    function loadDeleteInvoice(invoiceId) {
        // Asumiendo que la URL se forma agregando el ID a la base "/invoice_delete.php"
        var url = "/invoice_delete.php?id=" + invoiceId;

        // Llama a la función genérica de carga
        loadContentByUrl(url);
    }

    // Función para cargar información de edición mediante AJAX
    function loadEditInvoice(invoiceId) {
        // Asumiendo que la URL se forma agregando el ID a la base "/invoice_update.php"
        var url = "/invoice_update.php?id=" + invoiceId;

        // Llama a la función genérica de carga
        loadContentByUrl(url);
    }

    // Manejador de eventos para el botón "Ver detalles"
    $(document).on('click', '.details-button', function(e) {
        e.preventDefault();
        var invoiceId = $(this).data('invoice-id');
        loadInvoiceDetails(invoiceId);
    });

    // Manejador de eventos para el botón "Borrar"
    $(document).on('click', '.delete-button', function(e) {
        e.preventDefault();
        var invoiceId = $(this).data('invoice-id');
        loadDeleteInvoice(invoiceId);
    });

    // Manejador de eventos para el botón "Editar"
    $(document).on('click', '.edit-button', function(e) {
        e.preventDefault();
        var invoiceId = $(this).data('invoice-id');
        loadEditInvoice(invoiceId);
    });

    // Manejador de eventos para cerrar el modal al hacer clic fuera de él
    $(document).on('click', '#modal-container', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Manejador de eventos para cerrar el modal al presionar la tecla Esc
    $(document).on('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });

    // Asegurémonos de que la función closeModal esté disponible globalmente
    window.closeModal = closeModal;

    // Ocultar el modal al inicio
    $('#modal-container').hide();
    $('#background-modal').hide();
});
