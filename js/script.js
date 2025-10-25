function creaSezione(img) {
    const id = img.id;
    const contenitore = document.getElementById("contenitoreForm");

    //se il div esiste già --> non lo ricrea
    if (document.getElementById(`div-${id}`)) {
        alert(`Hai già aggiunto la sezione per ${id}.`);
        return;
    }

    //crea il div dinamico
    const div = document.createElement("div");
    div.id = `div-${id}`;
    div.className = "sezioneOrdine";

    //crea il titolo
    const titolo = document.createElement("h3");
    titolo.textContent = `Personalizza: ${id}`;
    div.appendChild(titolo);

    //aggiunge il contenuto dinamico in base all'immagine cliccata
    switch (id) {
        case "hamburger":
            div.innerHTML += `
                <label><input type="checkbox" checked disabled> Hamburger base (+5.50€)</label><br>
                <input type="hidden" name="hPanino" value="hPanino">
                <label><input type="checkbox" name="hFormaggio" value="hFormaggio" checked> Formaggio (+0.50€)</label><br>
                <label><input type="checkbox" name="hPomodoro" value="hPomodoro" checked> Pomodoro (+0.50€)</label><br>
                <label><input type="checkbox" name="hLattuga" value="hLattuga" checked> Lattuga (+0.50€)</label><br>
            `;
            break;

        case "pollo":
            div.innerHTML += `
                <label><input type="checkbox" name="pPanino" value="pPanino" checked disabled> Panino con pollo base (+6.00€)</label><br>
                <input type="hidden" name="pPanino" value="pPanino">
                <label><input type="checkbox" name="pMaionese" value="pMaionese" checked> Maionese (+0.50€)</label><br>
                <label><input type="checkbox" name="pLttuga" value="pLttuga" checked> Lattuga (+0.50€)</label><br>
                <label><input type="checkbox" name="pPomodoro" value="pPomodoro" checked> Pomodoro (+0.50€)</label><br>
            `;
            break;

        case "bibita":
            div.innerHTML += `
                <select name="bibita">
                    <option value="coca cola">Coca Cola - 2.00€</option>
                    <option value="fanta">Fanta - 2.00€</option>
                    <option value="acqua">Acqua - 1.50€</option>
                </select>
            `;
            break;

        case "patatine":
            div.innerHTML += `
                <select name="patatine">
                    <option value="piccole">Patatine piccole - 2.50€</option>
                    <option value="medie">Patatine medie - 3.00€</option>
                    <option value="grandi">Patatine grandi - 3.50€</option>
                </select>
            `;
            break;

        case "nuggets":
            div.innerHTML += `
                <select name="nuggets">
                    <option value="normali">Nuggets normali - 3.00€</option>
                    <option value="piccanti">Nuggets piccanti - 3.50€</option>
                </select>
            `;
            break;

        case "dessert":
            div.innerHTML += `
                <select name="dessert">
                    <option value="oreo">McFlurry oreo - 4.00€</option>
                    <option value="cioccolato">McFlurry cioccolato - 4.00€</option>
                    <option value="pistacchio">McFlurry pistacchio - 4.50€</option>
                </select>
            `;
            break;
    }

    //crea l'immagine per cancellare il div
    const btnRimuovi = document.createElement("img");
    btnRimuovi.src = "img/cestino.png";
    btnRimuovi.alt = "Rimuovi";
    btnRimuovi.className = "btnRimuovi";
    btnRimuovi.onclick = () => div.remove(); //rimuove solo il suo contenitore

    div.appendChild(btnRimuovi);

    //aggiunge il div al contenitore principale
    contenitore.appendChild(div);
}

function controllaInvio() {
    return controllaForm() && limitaData();
}

function controllaForm() {
    const contenitore = document.getElementById("contenitoreForm");
    if (contenitore.children.length === 0) {
        alert("Devi aggiungere almeno un elemento al tuo ordine prima di inviarlo.");
        return false; //blocca l'invio del form
    }

    return true; //permette l'invio del form
}

function limitaData() {
    const inputData = document.getElementById("tempoPrenotazione");
    const dataInserita = new Date(inputData.value);
    const adesso = new Date();

    if (dataInserita < adesso) {
        alert("Non puoi selezionare una data o ora nel passato!");
        return false;
    }

    return true;
}