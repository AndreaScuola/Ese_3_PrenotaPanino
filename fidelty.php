<?php
    session_start();
    
    foreach ($_GET as $key => $value) {
        $_SESSION[$key] = $value;
    }

    /*
    if (isset($_GET['hPanino'])) {
        $ingredienti = [];
        if (isset($_GET['hFormaggio']))  
            $ingredienti[] = "Formaggio";
        if (isset($_GET['hPomodoro']))   
            $ingredienti[] = "Pomodoro";
        if (isset($_GET['hLattuga']))    
            $ingredienti[] = "Lattuga";

        $_SESSION['hPanino'] = "Panino classico";
        $_SESSION['hIngredienti'] = $ingredienti;        
    }
    if (isset($_GET['pPanino'])) {
        $ingredienti = [];
        if (isset($_GET['pMaionese']))  
            $ingredienti[] = "Maionese";
        if (isset($_GET['pLttuga']))    
            $ingredienti[] = "Lattuga";
        if (isset($_GET['pPomodoro']))   
            $ingredienti[] = "Pomodoro";
        $_SESSION["pPanino"] = "Panino con pollo";
        $_SESSION["pIngredienti"] = $ingredienti;
    }
    if (isset($_GET['bibita'])) {
        $bibita = $_GET['bibita'];

        switch ($bibita) {
            case 'coca cola':
                $prezzoBibita = 2.00;
                $nomeBibita = "Coca-Cola";
                break;
            case 'fanta':
                $prezzoBibita = 2.00;
                $nomeBibita = "Fanta";
                break;
            case 'acqua':
                $prezzoBibita = 1.50;
                $nomeBibita = "Sprite";
                break;
        }
        $totale += $prezzoBibita;

        echo "<tr>
                <td><img src='img/bibita.png' width='80'></td>
                <td>$nomeBibita</td>
                <td>" . number_format($prezzoBibita, 2) . "</td></tr>";
    }
    if (isset($_GET['patatine'])) {
        $tipoPatatine = $_GET['patatine'];

        switch ($tipoPatatine) {
            case 'piccole':
                $prezzoPatatine = 2.50;
                break;
            case 'medie':
                $prezzoPatatine = 3.00;
                break;
            case 'grandi':
                $prezzoPatatine = 3.50;
                break;
        }
        $totale += $prezzoPatatine;

        echo "<tr>
                <td><img src='img/patatine.png' width='80'></td>
                <td>Patatine $tipoPatatine</td>
                <td>" . number_format($prezzoPatatine, 2) . "</td></tr>";
    }
    if (isset($_GET['nuggets'])) {
        $tipoNuggets = $_GET['nuggets'];

        switch ($tipoNuggets) {
            case 'normali':
                $prezzoNuggets = 3.00;
                break;
            case 'piccanti':
                $prezzoNuggets = 3.50;
                break;
        }
        $totale += $prezzoNuggets;

        echo "<tr>
                <td><img src='img/nuggets.png' width='80'></td>
                <td>Nuggets $tipoNuggets</td>
                <td>" . number_format($prezzoNuggets, 2) . "</td></tr>";
    }

    if (isset($_GET['dessert'])) {
        $tipoDessert = $_GET['dessert'];

        switch ($tipoDessert) {
            case 'oreo':
                $prezzoDessert = 4.00;
                break;
            case 'cioccolato':
                $prezzoDessert = 4.00;
                break;
            case 'pistacchio':
                $prezzoDessert = 4.50;
                break;
        }
        $totale += $prezzoDessert;

        echo "<tr>
                <td><img src='img/dessert.png' width='80'></td>
                <td>McFlurry $tipoDessert</td>
                <td>" . number_format($prezzoDessert, 2) . "</td></tr>";
    }
    */
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