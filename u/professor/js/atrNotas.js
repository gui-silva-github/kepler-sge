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

const forms = document.querySelectorAll("form");
forms.forEach((form) => {

    let notaInputs = form.querySelectorAll("input[type=number]");
    notaInputs.forEach((inp) => {
        inp.addEventListener("focusout", () => {
            let soma = Number(form.querySelector("#notaAV1").value) + Number(form.querySelector("#notaAV2").value) + Number(form.querySelector("#notaAD").value);
            form.querySelector("#inpMedia").value =  (soma/3).toFixed(2);
        });
    });
});