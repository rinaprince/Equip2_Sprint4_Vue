document.addEventListener("DOMContentLoaded", function () {
    var submenuItems = document.querySelectorAll('#main-menu .submenu');

    submenuItems.forEach(function (submenuItem) {
        submenuItem.addEventListener('click', function (event) {
            // Toggle para mostrar/ocultar el submenú al hacer clic en el elemento del menú
            var submenuContent = submenuItem.querySelector('.submenu-content');
            submenuContent.style.display = (submenuContent.style.display === 'block') ? 'none' : 'block';

            // Cambiar dinámicamente la clase del segundo ícono en el enlace del submenú
            var chevronIcon = submenuItem.querySelector('i.fas.fa-chevron-right');
            if (chevronIcon) {
                chevronIcon.classList.remove('fa-chevron-right');
                chevronIcon.classList.add('fa-chevron-down');
            } else {
                var chevronDownIcon = submenuItem.querySelector('i.fas.fa-chevron-down');
                chevronDownIcon.classList.remove('fa-chevron-down');
                chevronDownIcon.classList.add('fa-chevron-right');
            }

            // Detén la propagación del evento para que no afecte al contenedor del submenú
            event.stopPropagation();
        });
    });
});
