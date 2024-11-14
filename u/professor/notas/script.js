const drops = document.querySelectorAll('.dropdown');

drops.forEach((drop) => {
    const classroom = drop.querySelector('.classroom-name');
    const name = drop.querySelector('.nome');
    const caret = drop.querySelector('.caret');
    const table = drop.querySelector('.daily-table');

    classroom.addEventListener("click", () => {
        caret.classList.toggle('caret-rotate');
        table.classList.toggle('menu-open');
    });
});
