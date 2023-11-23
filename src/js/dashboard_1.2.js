(function(){

    const btnBurger = document.querySelector('.dashboard__mobile-menu');
    btnBurger.addEventListener('click', function(){

        const bodyScroll = document.querySelector('body');
        const sidebarNav = document.querySelector('.dashboard__sidebar-nav');
        const sidebar = document.querySelector('.dashboard__sidebar');
        const grid = document.querySelector('.dashboard__grid');

        bodyScroll.classList.toggle('scroll-mobile');
        sidebarNav.classList.toggle('dashboard__sidebar-nav--mobile');
        sidebar.classList.toggle('dashboard__sidebar--mobile');
        grid.classList.toggle('dashboard__grid--mobile');
    });

})();