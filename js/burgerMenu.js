document.addEventListener('DOMContentLoaded', function () {
    const burger = document.querySelector('.burger');
    const nav = document.querySelector('.nav-center');

    burger.addEventListener('click', function () {
        nav.classList.toggle('active'); // Ajoute/enlève la classe active
    });
});