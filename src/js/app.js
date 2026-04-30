document.addEventListener('DOMContentLoaded', function() {
    eventListeners();

    darkMode();
})

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', responsiveNavigation );
}


function responsiveNavigation() {
    const navigation = document.querySelector('.navegacion');

    navigation.classList.toggle('mostrar');

}


function darkMode() {
    
    const btnDarkMode = document.querySelector('.dark-mode-boton');
    btnDarkMode.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode')
    })
}