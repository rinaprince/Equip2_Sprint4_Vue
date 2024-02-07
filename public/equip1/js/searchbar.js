const searchBarContainerEl = document.querySelector(".search-bar-container");

const magnifierEl = document.querySelector(".magnifier");

magnifierEl.addEventListener("click", () => {
    searchBarContainerEl.classList.toggle("active");
});

const searchBar = document.querySelector('.active.search-bar-container');

searchBar.addEventListener('transitionend', function (event) {
    // Verifica si la propiedad que ha terminado la transición es 'width'
    if (event.propertyName === 'width') {
        // Agrega la clase "transition-done" después de la transición de 'width'
        searchBar.classList.add('transition-done');
    }
});