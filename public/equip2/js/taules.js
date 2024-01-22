"use strict";

let bttn = document.querySelector('#bttn-selection');
let tds = document.querySelectorAll('.multiple-selector');
let checkboxes = document.querySelectorAll('input[name=multiple-selector]');
let icon =  document.getElementById('close-selection');

function main() {

    bttn.addEventListener('click', function () {
        icon.style.display = 'inline';
        for (let i = 0; i < tds.length; i++) {
            tds[i].style.display = 'block';
            for (let j = i; j < checkboxes.length; j++) {
                checkboxes[j].checked = true;
            }
        }
    });

    icon.addEventListener('click', function () {
        icon.style.display = 'none';
        for (let i = 0; i < tds.length; i++) {
            tds[i].style.display = 'none';
            for (let j = i; j < checkboxes.length; j++) {
                checkboxes[j].checked = false;
            }
        }
    });
    $('.delete').on('click', function () {
        let tr = this.closest('tr'); // Encuentra el elemento tr más cercano al botón pulsado
        let providerId = $(tr).find('td:eq(1)').text(); // Obtiene el contenido del segundo td dentro del tr
        let datastring = 'id=' + providerId;
        loadContent('/provider_delete.php?', datastring, providerId, tr);
    });
}
    function loadContent(url, datastring, id, tr) {
        $.ajax({
            type: "GET",
            url: url + datastring,
            success: function (response) {
                modalStyles(document.querySelector('.modal'), document.querySelector('.modal-content'));
                var fragment = $(response).find('.modal-delete');
                $('.modal-content').html(fragment);
                $('.confirmDel').click(function (event) {
                    deleteProvider(datastring, id, tr);
                    document.querySelector('.modal').style.display = 'none';
                })
                $('.cancelDel').click(function (event) {
                    document.querySelector('.modal').style.display = 'none';
                })
            }
        })
    }

    function deleteProvider(datastring, id, tr) {
        $.ajax({
            type: "POST",
            url: "/provider_delete_process.php",
            data: datastring,
            success: function (response) {
                tr.remove(); // Elimina directamente la fila del DOM
                $('.alert-success').empty();
                $('.alert-success').append(response).fadeIn("slow");
                // No necesitas hacer nada con $(parent), ya que no está definido aquí
            }
        });
    }


    /**
 let burger = document.getElementById('burger');
 burger.addEventListener('click',function(){
 burger.classList.toggle('active');
 let ocultMenu = document.querySelector('.ocultMenu');
 ocultMenu.classList.toggle('displayHambMenu');
 });
 */

/**
 *     const data = {
 *         labels: ['España', 'Alemanya', 'França', 'Portugal', 'Paisos Baixos', 'Andorra'],
 *         datasets: [{
 *             label: '# of Votes',
 *             data: [12, 19, 3, 5, 2, 3],
 *             borderWidth: 1,
 *             backgroundColor: ['#CB4335', '#1F618D', '#F1C40F', '#27AE60', '#884EA0', '#D35400'],
 *         }]
 *     };
 *     const myChart = new Chart(document.getElementById('grafic'), {
 *         type: 'pie',
 *         data: data,
 *         options: {
 *             plugins: {
 *                 legend: {
 *                     onHover: handleHover,
 *                     onLeave: handleLeave
 *                 }
 *             }
 *         }
 *     });
 *
 *     // Append '4d' to the colors (alpha channel), except for the hovered index
 *     function handleHover(evt, item, legend) {
 *         legend.chart.data.datasets[0].backgroundColor.forEach((color, index, colors) => {
 *             colors[index] = index === item.index || color.length === 9 ? color : color + '4D';
 *         });
 *         legend.chart.update();
 *     }
 *
 *     // Removes the alpha channel from background colors
 *     function handleLeave(evt, item, legend) {
 *         legend.chart.data.datasets[0].backgroundColor.forEach((color, index, colors) => {
 *             colors[index] = color.length === 9 ? color.slice(0, -2) : color;
 *         });
 *         legend.chart.update();
 *     }
 * */

function modalStyles(modal,modal_content){
    modal.style.position = "absolute";
    modal.style.top = 0;
    modal.style.left = 0;
    modal.style.width = '100%';
    modal.style.height = '100%';
    modal.style.display = "flex";
    modal.style.justifyContent = "center";
    modal.style.alignItems = "center";

    modal_content.style.backgroundColor = "rgba(255,255,255,.8)";
    modal_content.style.textAlign = "center";

}

document.addEventListener('DOMContentLoaded', main);
