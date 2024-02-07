function burguer(){
    let burger = document.getElementById('burger');
    burger.classList.toggle('active');
    let ocultMenu = document.querySelector('.ocultMenu');
    let menuAside = document.getElementById('menu-aside');
    
    ocultMenu.classList.toggle('displayHambMenu');
    menuAside.classList.toggle('displayHambMenu'); // Toggle la clase para el aside

    // Cierra el submenú cuando se activa el menú hamburguesa
    let submenuContents = document.querySelectorAll('.submenu-content');
    submenuContents.forEach(submenu => submenu.style.display = 'none');
}
