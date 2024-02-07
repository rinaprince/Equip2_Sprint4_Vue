document.addEventListener('DOMContentLoaded', function () {
    // Obtener elementos del DOM
    const busquedaIcono = document.getElementById('busqueda');
    const header = document.querySelector('.navegador-header');
    const originalCol12 = document.querySelector('.navegador-header .col-12');

    // Configurar el ícono de flecha izquierda
    const flechaIzquierda = document.createElement('div');
    flechaIzquierda.className = 'fas fa-arrow-left';
    flechaIzquierda.style.cursor = 'pointer';
    flechaIzquierda.style.color = '#e7d381ff';
    flechaIzquierda.style.marginRight = '20px';
    flechaIzquierda.style.display = 'block';

    // Configurar el evento de clic al ícono de búsqueda
    busquedaIcono.addEventListener('click', function () {
        // Ocultar el div.col-12 original
        originalCol12.style.display = 'none';

        // Crear el nuevo div.col-12
        const nuevoCol12 = document.createElement('div');
        nuevoCol12.className = 'col-12';
        nuevoCol12.style.display = 'flex';
        nuevoCol12.style.alignItems = 'center';  // Centrar verticalmente
        nuevoCol12.style.height = '50px';  // Establecer altura

        // Configurar la barra de búsqueda en el nuevo div.col-12
        const barraBusqueda = document.createElement('div');
        barraBusqueda.className = 'barra-busqueda-header';

        // Configurar el div contenedor dentro de barra-busqueda-header
        const contenedorBusqueda = document.createElement('div');

        // Configurar el input de búsqueda
        const inputBusqueda = document.createElement('input');
        inputBusqueda.type = 'text';
        inputBusqueda.className = 'input-busqueda-header';
        inputBusqueda.placeholder = 'Buscar...';

        // Configurar el botón de búsqueda
        const botonBusqueda = document.createElement('button');
        botonBusqueda.className = 'boto-busqueda-header';
        const iconoBusqueda = document.createElement('i');
        iconoBusqueda.className = 'fas fa-search';
        botonBusqueda.appendChild(iconoBusqueda);

        // Configurar la flecha izquierda para alternar
        const flechaIzquierdaAlt = flechaIzquierda.cloneNode(true);
        flechaIzquierdaAlt.addEventListener('click', function () {
            // Ocultar el nuevo div.col-12 con la barra de búsqueda
            header.removeChild(header.lastChild); // Eliminar el último hijo (nuevoCol12)

            // Mostrar el div.col-12 original
            originalCol12.style.display = 'flex';
        });

        // Agregar elementos al DOM
        contenedorBusqueda.appendChild(inputBusqueda);
        contenedorBusqueda.appendChild(botonBusqueda);
        barraBusqueda.appendChild(flechaIzquierdaAlt);
        barraBusqueda.appendChild(contenedorBusqueda);
        nuevoCol12.appendChild(barraBusqueda);
        header.appendChild(nuevoCol12);

        // Mostrar el div.col-12 con la barra de búsqueda
        nuevoCol12.style.display = 'flex';

        // Mostrar la flecha izquierda
        flechaIzquierda.style.display = 'block';
    });
});
