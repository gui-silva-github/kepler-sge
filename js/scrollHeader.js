// Hidden header-top on scroll function
const header = document.querySelector('#header-section');
window.addEventListener('scroll', () => {
    document.querySelector('.header-top').classList.toggle('hidden', window.scrollY > 180);
});