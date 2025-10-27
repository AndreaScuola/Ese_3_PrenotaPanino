<?php
    session_start();
    session_unset(); //Pulisce tutte le variabili di sessione
    
    foreach ($_GET as $key => $value) {
        $_SESSION[$key] = $value;
    }
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <title>Codice sconto</title> 
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
</head>

<body>
    <nav class = "navBar">
        <a href="https://www.itisrossi.edu.it/">Home</a>
        <a href="index.php">Prenotazioni</a>
    </nav>

    <header>
        <h1>Inserisci il codice sconto</h1>
    </header>

    <form name="form" method="get" action="output.php">
        <div class="codice">
            <label for="sconto">Codice sconto: </label>
            <input type="text" id="sconto" name="sconto" required>
        </div><br>

        <div class="btnGestione">
            <button type="submit">Invia</button>
            <button type="reset">Cancella</button>
        </div>
    </form>

    <br><br>

    <footer>
        <a href="mailto:10933916@itisrossi.vi.it">Contatti</a>
        <p>Credits: <i>Andrea Bassan</i></p>
    </footer>
</body>
</html>