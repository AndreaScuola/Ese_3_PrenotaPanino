<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Prenota panino</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
</head>

<body>
    <nav class = "navBar">
        <a href="https://www.itisrossi.edu.it/#">Home</a>
    </nav>

    <header>
        <h1>BENVENUTO ALLA PANINERIA ROSSI</h1>
    </header>

    <form name="form" method="get" action="output.php">
        <h2>Compila i seguenti campi:</h2>
    
        <div class="divDenominativo">
            <label for="denominativo">Denominativo: </label>
            <input type="text" id="denominativo" name="denominativo" maxlength="50" required>
        </div>

        <div class="divDataOra">
            <label for="tempoPrenotazione">Data e ora prenotazione: </label>
            <input type="datetime-local" id="tempoPrenotazione" name="tempoPrenotazione" required>
        </div>
        <br><hr><br>
        
        <h2>Personalizzazione panino:</h2>

        <div class="divIngredienti">

            <label for="pane">Tipo di pane: </label>
            <select name="pane" id="pane" required>
                <option value="" disabled selected>-- Seleziona un tipo di pane --</option>
                <option value="normale">Bun classico</option>
                <option value="glutenFree">Bun gluten free</option>
            </select><br><br>

            <label for="hamburger">Tipo di carne: </label>
            <select name="hamburger" id="hamburger" required>
                <option value="" disabled selected>-- Seleziona un tipo di carne --</option>
                <option value="manzo">Manzo</option>
                <option value="pollo">Pollo</option>
                <option value="suino">Suino</option>
            </select><br><br>

            <input type="checkbox" id="formaggio" name="formaggio" value="formaggio">
            <label for="formaggio">Formaggio</label><br><br>

            <input type="checkbox" id="lattuga" name="lattuga" value="lattuga">
            <label for="lattuga">Lattuga</label><br><br>

            <input type="checkbox" id="pomodoro" name="pomodoro" value="pomodoro">
            <label for="pomodoro">Pomodoro</label><br><br>

            <input type="checkbox" id="cetriolini" name="cetriolini" value="cetriolini">
            <label for="cetriolini">Cetriolini</label><br><br>  
        </div>
        <br>
        
        <div class="btnGestione">
            <button type="submit" onclick="">Invia</button>
            <button type="reset">Cancella</button>
        </div>
    </form>

    <br><br>

    <footer>
        <a href="mailto:10933916@itisrossi.vi.it">Mail aziendale</a>
        <p>Credits: <i>Andrea Bassan</i></p>
    </footer>
</body>
</html>
