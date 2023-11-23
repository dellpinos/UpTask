(function(){


    const btnBurger = document.querySelector('.home__mobile-menu');
    btnBurger.addEventListener('click', function(){


        const bodyScroll = document.querySelector('body');

        const barra = document.querySelector('.home__barra');
        const derecha = document.querySelector('.home__derecha');


        bodyScroll.classList.toggle('scroll-mobile');
        barra.classList.toggle('home__barra--mobile');
        derecha.classList.toggle('home__derecha--mobile');
    });


})();