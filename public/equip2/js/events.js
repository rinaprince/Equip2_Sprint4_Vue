"use strict";

function main(){
    let burger = document.getElementById('burger');
    burger.addEventListener('click', function () {
        burger.classList.toggle('active');
        let ocultMenu = document.querySelector('.ocultMenu');
        let menuAside = document.getElementById('menu-aside');

        ocultMenu.classList.toggle('displayHambMenu');
        menuAside.classList.toggle('displayHambMenu'); // Toggle la clase para el aside

        // Cierra el submenú cuando se activa el menú hamburguesa
        let submenuContents = document.querySelectorAll('.submenu-content');
        submenuContents.forEach(submenu => submenu.style.display = 'none');
    });

    let searcher = document.querySelector('.searcher>img');
    searcher.addEventListener('click', function () {
        let div = document.querySelector('.searcher');
        div.classList.toggle('searcherClicked');
    });
}

document.addEventListener('DOMContentLoaded', main);