<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <title>Riepilogo ordine</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <nav class = "navBar">
        <a href="https://www.itisrossi.edu.it/">Home</a>
        <a href="index.php">Nuova prenotazione</a>
    </nav>
    
    <header>
        <h1>Riepilogo dell'ordine</h1>
    </header>

    <div class="riepilogoOrdine">
        <?php //Gestione codice sconto
            $scontoAttivo = false;
            if (isset($_GET['sconto'])) {
                $codiceInserito = trim($_GET['sconto']);
                $codiciValidi = file("codiceSconto.txt");   //Crea un array

                if (in_array($codiceInserito, $codiciValidi)) {
                    $scontoAttivo = true;
                    echo "<p style='color:green; text-align:center;'>Codice sconto valido! Sconto 20% applicato sui panini</p>";
                } else 
                    echo "<p style='color:red; text-align:center;'>Codice sconto non valido, nessuno sconto applicato</p>";
            }
        ?>

        <table border="1" cellpadding="10" style="width:80%; margin:auto; border-collapse:collapse; text-align:center;">
            <tr style="background-color:#008cba; color:white;">
                <th>Immagine</th>
                <th>Dettagli</th>
                <th>Prezzo (€)</th>
            </tr>

            <?php

            $totale = 0;
            $denominativo = isset($_GET['denominativo']) ? $_GET['denominativo'] : null;
            $tempoPrenotazione = isset($_GET['tempoPrenotazione']) ? $_GET['tempoPrenotazione'] : null;

            echo "<strong>Denominativo:</strong> $denominativo<br>";
            echo "<strong>Data e ora prenotazione:</strong> $tempoPrenotazione<br><br>";

            if (isset($_GET['hPanino'])) {
                $ingredienti = [];
                if (isset($_GET['hFormaggio']))  
                    $ingredienti[] = "Formaggio";
                if (isset($_GET['hPomodoro']))   
                    $ingredienti[] = "Pomodoro";
                if (isset($_GET['hLattuga']))    
                    $ingredienti[] = "Lattuga";

                $stringIngredienti = "Hamburger classico con " . implode(", ", $ingredienti);
                $totaleHamburger = 5.50 + 0.50 * count($ingredienti);
                if ($scontoAttivo)  $totaleHamburger *= 0.8; //Sconto del 20%
                
                $totale += $totaleHamburger;

                echo "<tr>
                        <td><img src='img/hamburger.png' width='80'></td>
                        <td>$stringIngredienti</td>
                        <td>" . number_format($totaleHamburger, 2) . "</td></tr>";
            }
            if (isset($_GET['pPanino'])) {
                $ingredienti = [];
                if (isset($_GET['pMaionese']))  
                    $ingredienti[] = "Maionese";
                if (isset($_GET['pLttuga']))    
                    $ingredienti[] = "Lattuga";
                if (isset($_GET['pPomodoro']))   
                    $ingredienti[] = "Pomodoro";

                $stringIngredienti = "Panino con pollo classico con " . implode(", ", $ingredienti);
                $totalePollo = 6.00 + 0.50 * count($ingredienti);
                if ($scontoAttivo)  $totalePollo *= 0.8; //Sconto del 20%

                $totale += $totalePollo;

                echo "<tr>
                        <td><img src='img/pollo.png' width='80'></td>
                        <td>$stringIngredienti</td>
                        <td>" . number_format($totalePollo, 2) . "</td></tr>";
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

            echo "<tr style='background-color:#e8f4f8; font-weight:bold;'>
                    <td colspan='2'>Totale</td>
                    <td>" . number_format($totale, 2) . "</td>
                </tr></table>";
            ?>

        <br><br>    
        
         <div style="text-align: center; margin-top: 20px;">
            <a class="btnIndex" href="index.php">Nuova prenotazione</a>
        </div>
    </div>

    <footer>
        <a href="mailto:10933916@itisrossi.vi.it">Mail aziendale</a>
        <p>Credits: <i>Andrea Bassan</i></p>
    </footer>

</body>
</html>