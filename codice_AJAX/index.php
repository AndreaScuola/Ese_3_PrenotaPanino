<?php
session_start();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Ordini AJAX</title>
    <script>
        // Funzione per inviare l'ordine via AJAX
        function inviaOrdineAJAX(event) {
            event.preventDefault(); // blocca l'invio normale del form

            const form = document.getElementById("formOrdini");
            const formData = new FormData(form);

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "indexAJAX.php", true);

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Riceve il JSON dei dati dal server
                    const ordini = JSON.parse(xhr.responseText);
                    stampaTabella(ordini);
                }
            };

            xhr.send(formData);
        }

        // Funzione per stampare la tabella degli ordini
        function stampaTabella(ordini) {
            const container = document.getElementById("tabellaOrdini");
            container.innerHTML = ""; // pulisce eventuali vecchie tabelle

            let html = "<table border='1' cellpadding='5'><tr><th>ID ordine</th><th>Prodotto</th></tr>";
            ordini.forEach((ordine, index) => {
                html += `<tr><td>${index + 1}</td><td>${ordine}</td></tr>`;
            });
            html += "</table>";

            container.innerHTML = html;
        }
    </script>
</head>
<body>
    <h1>Ordina i tuoi panini</h1>

    <form id="formOrdini" onsubmit="inviaOrdineAJAX(event)">
        <label><input type="checkbox" name="prodotti[]" value="Hamburger"> Hamburger</label><br>
        <label><input type="checkbox" name="prodotti[]" value="Panino pollo"> Panino pollo</label><br>
        <label><input type="checkbox" name="prodotti[]" value="Bibita"> Bibita</label><br>
        <label><input type="checkbox" name="prodotti[]" value="Patatine"> Patatine</label><br>
        <button type="submit">Invia ordine</button>
    </form>

    <h2>Riepilogo ordini (AJAX)</h2>
    <div id="tabellaOrdini"></div>
</body>
</html>
