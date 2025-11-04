<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Prenotazione</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/scriptCookie.js"></script>
</head>

<body>
    <nav class="navBar">
        <a href="https://www.itisrossi.edu.it/">Home</a>
        <a href="resetCookie.php">Cancella preferenze</a>
    </nav>

    <header>
        <h1>BENVENUTO ALLA PANINERIA ROSSI CON COOKIE</h1>
    </header>

    <form name="form" method="get" action="fideltyCookie.php" onsubmit="return controllaInvio()">
        <h2>Compila i seguenti campi:</h2>

        <div class="divDenominativo">
            <label for="denominativo">Denominativo:</label>
            <input type="text" id="denominativo" name="denominativo" maxlength="50" required>
        </div>

        <div class="divDataOra">
            <label for="tempoPrenotazione">Data e ora prenotazione:</label>
            <input type="datetime-local" id="tempoPrenotazione" name="tempoPrenotazione" required>
        </div>

        <hr>

        <h2>Scegli cosa ordinare:</h2>
        <div class="menuImmagini">
            <img src="../img/hamburger.png" alt="Hamburger" id="hamburger" onclick="creaSezione(this)">
            <img src="../img/pollo.png" alt="Panino pollo" id="pollo" onclick="creaSezione(this)">
            <img src="../img/bibita.png" alt="Bibita" id="bibita" onclick="creaSezione(this)">
            <img src="../img/patatine.png" alt="Patatine" id="patatine" onclick="creaSezione(this)">
            <img src="../img/nuggets.png" alt="Nuggets" id="nuggets" onclick="creaSezione(this)">
            <img src="../img/dessert.png" alt="Dessert" id="dessert" onclick="creaSezione(this)">
        </div>

        <!-- Qui appariranno i div generati -->
        <div id="contenitoreForm"></div>

        <div class="btnGestione">
            <button type="submit">Invia</button>
            <button type="reset">Cancella</button>
        </div>
    </form>

    <footer>
        <a href="mailto:10933916@itisrossi.vi.it">Mail aziendale</a>
        <p>Credits: <i>Andrea Bassan</i></p>
    </footer>
</body>
</html>
