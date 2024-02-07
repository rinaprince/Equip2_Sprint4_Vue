
        let div = document.getElementById('dropdown');
        let additionalInfo = document.querySelector('#additionalInfo');
        let dropdownImg = document.getElementById('dropdownImg');
        if(additionalInfo.style.display === 'none'){
            dropdownImg.setAttribute('src','/equip3/img/icones/flecha-derecha-dropdown.png');
        }
        else{
            dropdownImg.setAttribute('src','/equip3/img/icones/flecha-abajo-dropdown.png');
        }
        div.addEventListener('click',function(){
            if(additionalInfo.style.display === 'none'){
                additionalInfo.style.display = 'initial';
                dropdownImg.classList.remove('src');
                dropdownImg.setAttribute('src','/equip3/img/icones/flecha-abajo-dropdown.png');
            }
            else{
                additionalInfo.style.display = 'none';
                dropdownImg.classList.remove('src');
                dropdownImg.setAttribute('src','/equip3/img/icones/flecha-derecha-dropdown.png');
            }
        });

        let button = document.getElementById('addWish');
        let wishlist = button.querySelector('img');
        button.addEventListener('mouseover',function(){
            wishlist.classList.remove('src');
            wishlist.setAttribute('src','/equip3/img/icones/llistaDeDesitjos-GrocOscur-relleno.png');
        });
        button.addEventListener('mouseout',function(){
            wishlist.classList.remove('src');
            wishlist.setAttribute('src','/equip3/img/icones/llistaDeDesitjos-GrocOscur.png');
        });



