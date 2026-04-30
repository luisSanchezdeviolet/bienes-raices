document.addEventListener('DOMContentLoaded', function() {
    addEventListener();
})

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive );
}


function responsiveNavigation() {
    const navigation = document.querySelector('.navegacion');

    navigation.classList.toggle('mostrar');

}