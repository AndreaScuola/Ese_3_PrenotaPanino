// ----------- FUNZIONE DI SUPPORTO PER LEGGERE COOKIE JSON -----------
function leggiCookieJson(name) {
    const nameEq = name + "=";
    const cookie = document.cookie.split("; ").find(row => row.startsWith(nameEq));
    if (!cookie) return null; // nessun cookie presente

    const raw = cookie.substring(nameEq.length);
    try {
        return JSON.parse(decodeURIComponent(raw));
    } catch (err) {
        console.error("Errore nel parsing del cookie:", err);
        return null;
    }
}

// ----------- FUNZIONE PRINCIPALE PER CREARE LE SEZIONI DINAMICHE -----------
function creaSezione(img) {
    const id = img.id;
    const contenitore = document.getElementById("contenitoreForm");

    // Rileggi SEMPRE il cookie prima di creare la sezione
    const datiSalvati = leggiCookieJson("ordinePanineria") || {};

    // Sezione già esistente → non la ricrea
    if (document.getElementById(`div-${id}`)) return;

    // Helper
    const isChecked = name => Object.prototype.hasOwnProperty.call(datiSalvati, name);
    const getValue = name => datiSalvati[name] || "";

    // Crea div dinamico
    const div = document.createElement("div");
    div.id = `div-${id}`;
    div.className = "sezioneOrdine";

    const titolo = document.createElement("h3");
    titolo.textContent = `Personalizza: ${id}`;
    div.appendChild(titolo);

    switch (id) {
        case "hamburger":
            div.innerHTML += `
                <label><input type="checkbox" checked disabled> Hamburger base (+5.50€)</label><br>
                <input type="hidden" name="hPanino" value="hPanino">
                <label><input type="checkbox" name="hFormaggio" value="hFormaggio" ${isChecked("hFormaggio") ? "checked" : ""}> Formaggio (+0.50€)</label><br>
                <label><input type="checkbox" name="hPomodoro" value="hPomodoro" ${isChecked("hPomodoro") ? "checked" : ""}> Pomodoro (+0.50€)</label><br>
                <label><input type="checkbox" name="hLattuga" value="hLattuga" ${isChecked("hLattuga") ? "checked" : ""}> Lattuga (+0.50€)</label><br>
            `;
            break;

        case "pollo":
            div.innerHTML += `
                <label><input type="checkbox" checked disabled> Panino con pollo base (+6.00€)</label><br>
                <input type="hidden" name="pPanino" value="pPanino">
                <label><input type="checkbox" name="pMaionese" value="pMaionese" ${isChecked("pMaionese") ? "checked" : ""}> Maionese (+0.50€)</label><br>
                <label><input type="checkbox" name="pLttuga" value="pLttuga" ${isChecked("pLttuga") ? "checked" : ""}> Lattuga (+0.50€)</label><br>
                <label><input type="checkbox" name="pPomodoro" value="pPomodoro" ${isChecked("pPomodoro") ? "checked" : ""}> Pomodoro (+0.50€)</label><br>
            `;
            break;

        case "bibita":
            div.innerHTML += `
                <select name="bibita">
                    <option value="coca cola" ${getValue("bibita") === "coca cola" ? "selected" : ""}>Coca Cola - 2.00€</option>
                    <option value="fanta" ${getValue("bibita") === "fanta" ? "selected" : ""}>Fanta - 2.00€</option>
                    <option value="acqua" ${getValue("bibita") === "acqua" ? "selected" : ""}>Acqua - 1.50€</option>
                </select>
            `;
            break;

        case "patatine":
            div.innerHTML += `
                <select name="patatine">
                    <option value="piccole" ${getValue("patatine") === "piccole" ? "selected" : ""}>Patatine piccole - 2.50€</option>
                    <option value="medie" ${getValue("patatine") === "medie" ? "selected" : ""}>Patatine medie - 3.00€</option>
                    <option value="grandi" ${getValue("patatine") === "grandi" ? "selected" : ""}>Patatine grandi - 3.50€</option>
                </select>
            `;
            break;

        case "nuggets":
            div.innerHTML += `
                <select name="nuggets">
                    <option value="normali" ${getValue("nuggets") === "normali" ? "selected" : ""}>Nuggets normali - 3.00€</option>
                    <option value="piccanti" ${getValue("nuggets") === "piccanti" ? "selected" : ""}>Nuggets piccanti - 3.50€</option>
                </select>
            `;
            break;

        case "dessert":
            div.innerHTML += `
                <select name="dessert">
                    <option value="oreo" ${getValue("dessert") === "oreo" ? "selected" : ""}>McFlurry oreo - 4.00€</option>
                    <option value="cioccolato" ${getValue("dessert") === "cioccolato" ? "selected" : ""}>McFlurry cioccolato - 4.00€</option>
                    <option value="pistacchio" ${getValue("dessert") === "pistacchio" ? "selected" : ""}>McFlurry pistacchio - 4.50€</option>
                </select>
            `;
            break;
    }

    // Bottone rimuovi
    const btnRimuovi = document.createElement("img");
    btnRimuovi.src = "img/cestino.png";
    btnRimuovi.alt = "Rimuovi";
    btnRimuovi.className = "btnRimuovi";
    btnRimuovi.onclick = () => div.remove();

    div.appendChild(btnRimuovi);
    contenitore.appendChild(div);
}

// ----------- CONTROLLO FORM / DATA -----------
function controllaInvio() {
    return controllaForm() && limitaData();
}

function controllaForm() {
    const contenitore = document.getElementById("contenitoreForm");
    if (contenitore.children.length === 0) {
        alert("Devi aggiungere almeno un elemento al tuo ordine prima di inviarlo.");
        return false;
    }
    return true;
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

// ----------- ALL'AVVIO PAGINA: RIPRISTINA SE POSSIBILE -----------
window.addEventListener("DOMContentLoaded", () => {
    const dati = leggiCookieJson("ordinePanineria");
    if (!dati) {
        console.log("Nessun cookie trovato, form vuoto.");
        return;
    }

    // Compila i campi principali
    if (dati.denominativo) document.getElementById("denominativo").value = dati.denominativo;
    if (dati.tempoPrenotazione) document.getElementById("tempoPrenotazione").value = dati.tempoPrenotazione;

    // Ricrea le sezioni se presenti
    if (dati.hPanino) creaSezione({ id: "hamburger" });
    if (dati.pPanino) creaSezione({ id: "pollo" });
    if (dati.bibita) creaSezione({ id: "bibita" });
    if (dati.patatine) creaSezione({ id: "patatine" });
    if (dati.nuggets) creaSezione({ id: "nuggets" });
    if (dati.dessert) creaSezione({ id: "dessert" });
});
