<?php
    if(isset($_COOKIE['ordinePanineria']))
        $datiCookie = json_decode($_COOKIE['ordinePanineria'], true);

    session_start();
    if(!isset($_SESSION["contatore"]))
        $_SESSION["contatore"] = 1;
    else
        $_SESSION["contatore"] += 1;
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <title>Riepilogo ordine</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <nav class = "navBar">
        <a href="https://www.itisrossi.edu.it/">Home</a>
        <a href="indexCookie.php">Nuova prenotazione con Cookie</a>
    </nav>
    
    <header>
        <h1>Riepilogo dell'ordine (Con cookie)</h1>
    </header>

    <div class="riepilogoOrdine">
        <?php 
            echo "<h2>Numero di visite a questa pagina in questa sessione: " . $_SESSION["contatore"] . "</h2><br>";

            //Gestione codice sconto
            $scontoAttivo = false;
            if (isset($_GET['sconto'])) {
                $codiceInserito = trim($_GET['sconto']);
                $codiciValidi = file("../codiceSconto.txt");   //Crea un array

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

                $denominativo = isset($datiCookie['denominativo']) ? $datiCookie['denominativo'] : null;
                $tempoPrenotazione = isset($datiCookie['tempoPrenotazione']) ? $datiCookie['tempoPrenotazione'] : null;

                echo "<strong>Denominativo:</strong> $denominativo<br>";
                echo "<strong>Data e ora prenotazione:</strong> $tempoPrenotazione<br><br>";

                if (isset($datiCookie['hPanino'])) {
                    $ingredienti = [];
                    if (isset($datiCookie['hFormaggio']))  
                        $ingredienti[] = "Formaggio";
                    if (isset($datiCookie['hPomodoro']))   
                        $ingredienti[] = "Pomodoro";
                    if (isset($datiCookie['hLattuga']))    
                        $ingredienti[] = "Lattuga";

                    $stringIngredienti = "Hamburger classico con " . implode(", ", $ingredienti);
                    $totaleHamburger = 5.50 + 0.50 * count($ingredienti);
                    
                    $totale += $totaleHamburger;

                    echo "<tr>
                            <td><img src='img/hamburger.png' width='80'></td>
                            <td>$stringIngredienti</td>
                            <td>" . number_format($totaleHamburger, 2) . "</td></tr>";
                }
                if (isset($datiCookie['pPanino'])) {
                    $ingredienti = [];
                    if (isset($datiCookie['pMaionese']))  
                        $ingredienti[] = "Maionese";
                    if (isset($datiCookie['pLttuga']))    
                        $ingredienti[] = "Lattuga";
                    if (isset($datiCookie['pPomodoro']))   
                        $ingredienti[] = "Pomodoro";

                    $stringIngredienti = "Panino con pollo classico con " . implode(", ", $ingredienti);
                    $totalePollo = 6.00 + 0.50 * count($ingredienti);

                    $totale += $totalePollo;

                    echo "<tr>
                            <td><img src='img/pollo.png' width='80'></td>
                            <td>$stringIngredienti</td>
                            <td>" . number_format($totalePollo, 2) . "</td></tr>";
                }
                if (isset($datiCookie['bibita'])) {
                    $bibita = $datiCookie['bibita'];

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
                if (isset($datiCookie['patatine'])) {
                    $tipoPatatine = $datiCookie['patatine'];

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
                if (isset($datiCookie['nuggets'])) {
                    $tipoNuggets = $datiCookie['nuggets'];

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

                if (isset($datiCookie['dessert'])) {
                    $tipoDessert = $datiCookie['dessert'];

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
                    </tr>";

                if($scontoAttivo){
                    $scontoApplicato = 0;
                    
                    if(isset($datiCookie['hPanino']))
                        $scontoApplicato = $totaleHamburger * 0.2;
                    if(isset($datiCookie['pPanino']))
                        $scontoApplicato += $totalePollo * 0.2;

                    echo "<tr style='background-color:#e8f4f8; font-weight:bold;'>
                        <td colspan='2'>Sconto applicato</td>
                        <td>" . number_format($scontoApplicato, 2) . "</td>
                    </tr>";

                    echo "<tr style='background-color:#e8f4f8; font-weight:bold;'>
                        <td colspan='2'>Prezzo scontato</td>
                        <td>" . number_format($totale - $scontoApplicato, 2) . "</td>
                    </tr>";
                }

                echo "</table>";
            ?>

        <br><br>    
        
         <div style="text-align: center; margin-top: 20px;">
            <a class="btnIndex" href="indexCookie.php">Nuova prenotazione con Cookie</a>
        </div>
    </div>

    <footer>
        <a href="mailto:10933916@itisrossi.vi.it">Mail aziendale</a>
        <p>Credits: <i>Andrea Bassan</i></p>
    </footer>

</body>
</html>