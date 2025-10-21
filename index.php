<?php
    echo '<!-- TEMPLATE DI BASE PER PAGINE PHP -->';
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <title></title> <!-- AGGIUNGI TITOLO -->
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
</head>

<body>
    <nav class = "btnGroup">
        <a href="">LINK 1</a> <!-- AGGIUNGI LINK -->
    </nav>

    <header>
        <h1></h1> <!-- AGGIUNGI TITOLO -->
    </header>

    <!-- AGGIUNGI ACTION -->
    <form name="form" method="get" action=""> <!-- USA UNA FUNZIONE JS CON ONSUBMIT SE VUOI FARE DELLA VALIDAZIONE -->
        <h2>TITOLO:</h2>
    
        <div class="">
            <label for="">CAMPO: </label>
            <input type="text" id="" name="" maxlength="50" required>
        </div>
        <br>

        <div class="">
            <label for="">CAMPO: </label>
            <input type="radio" name="" id="" value="" required>
            <label for="">Valore1</label>
            <input type="radio" name="" id="" value="">
            <label for="sessoF">Valore2</label>
        </div>
        <br>

        <div class="">
            <label for="">CAMPO SELECT: </label>
            <select name="" id="" required>
                <option value="" disabled selected>-- Seleziona --</option>
                <option value="">SCELTA 1</option>
            </select>
            <br><br>
        </div>
        <br>

        <div class="">
            <label for="">CAMPO DATA: </label>
            <input type="date" id="" name="" required>
        </div>
        <br>

        <div class="">
            <input type="checkbox" id="" name="" value="">
            <label for="">LABEL</label>
        </div>
        <br>

        <div class="btnGestione">
            <button type="submit" onclick="">Invia</button>
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
