export default function init_sideMenu(){
    const sideMenu = document.querySelector('.side-menu');
    const sideMenuBtn = document.querySelector('.side-menu-btn');
    const sideMenuCloseBtn = document.querySelector('.side-menu-close-btn');

    sideMenuBtn.addEventListener('click', () => {
        sideMenu.classList.toggle('active');
    });

    sideMenuCloseBtn.addEventListener('click', () => {
        sideMenu.classList.remove('active');
    });
}