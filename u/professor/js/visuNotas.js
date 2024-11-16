const drops = document.querySelectorAll(".dropdown");

drops.forEach(async (drop) => {
    await loadNotas(drop);

    drop.querySelector("#disc").addEventListener("change", async () => {
        drop.querySelector("tbody").innerHTML = "";
        await loadNotas(drop);
    });
});

async function loadNotas(drop){
    const discSelect = drop.querySelector("#disc");
    let idDisc = discSelect.options[discSelect.selectedIndex];

    let notas = await fetchNotas(idDisc.value);
    for (let n of notas){

        let tableRow = document.createElement("tr");
        let media = ((Number(n.av1)+Number(n.av2)+Number(n.ad))/3).toFixed(2);
        let stats = n.status;
        if (media < 5){
            tableRow.innerHTML = `<th scope="row">${n.nome}</th><td>${n.av1}</td><td>${n.av2}</td><td>${n.ad}</td><td style="color: red">${media}</td><td>${stats}</td>`;
        }else{
            tableRow.innerHTML = `<th scope="row">${n.nome}</th><td>${n.av1}</td><td>${n.av2}</td><td>${n.ad}</td><td style="color: green">${media}</td><td>${stats}</td>`;
        }

        drop.querySelector("tbody").appendChild(tableRow);
    }
}

async function fetchNotas(idDisc){
    idDisc = Number(idDisc);

    return await fetch(`/u/professor/api/visuNotas.php?disc=${idDisc}`)
        .then(response => response.json())
        .catch(error => console.error('Error:', error));
}