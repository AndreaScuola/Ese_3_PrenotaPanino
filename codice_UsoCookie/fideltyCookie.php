<?php
    $arrayGenerale = array();

    foreach ($_GET as $key => $value) {
        $arrayGenerale[$key] = $value;
    }

    setcookie('ordinePanineria', json_encode($arrayGenerale), time() + (86400 * 7), '/');
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <title>Codice sconto</title> 
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/scriptCookie.js"></script>
</head>

<body>
    <nav class = "navBar">
        <a href="https://www.itisrossi.edu.it/">Home</a>
        <a href="indexCookie.php">Prenotazioni con Cookie</a>
    </nav>

    <header>
        <h1>Inserisci il codice sconto (con Cookie)</h1>
    </header>

    <form name="form" method="get" action="outputCookie.php">
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