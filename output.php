<?php
$denominativo = isset($_GET['denominativo']) ? trim($_GET['denominativo']) : null;
$tempoPrenotazione = isset($_GET['tempoPrenotazione']) ? trim($_GET['tempoPrenotazione']) : null;
$pane = isset($_GET['pane']) ? trim($_GET['pane']) : null;
$hamburger = isset($_GET['hamburger']) ? trim($_GET['hamburger']) : null;

$ingredienti = [];
if (isset($_GET['formaggio']))  
    $ingredienti[] = "Formaggio";
if (isset($_GET['lattuga']))    
    $ingredienti[] = "Lattuga";
if (isset($_GET['pomodoro']))   
    $ingredienti[] = "Pomodoro";
if (isset($_GET['cetriolini'])) 
    $ingredienti[] = "Cetriolini";
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Riepilogo prenotazione</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body { font-family: Arial, Helvetica, sans-serif; padding: 20px; max-width: 800px; margin: auto; }
        .error { color: #a00; background:#fdd; padding:10px; border-radius:6px; margin-bottom:16px; }
        .card { border:1px solid #ddd; padding:16px; border-radius:8px; background:#fafafa; }
        .label { font-weight:700; }
        a.btn { display:inline-block; margin-top:12px; padding:8px 12px; background:#007bff; color:#fff; text-decoration:none; border-radius:6px; }
    </style>
</head>
<body>
    <nav class = "navBar">
        <a href="https://www.itisrossi.edu.it/#">Home</a>
    </nav>
    
    <header>
        <h1>Riepilogo prenotazione</h1>
    </header>

   <div class="riepilogoPrenotazione">
        <p><span class="label">Denominativo:</span> <?php echo $denominativo ?></p>
        <p><span class="label">Data e ora prenotazione:</span> <?php echo $tempoPrenotazione; ?></p>
        <p><span class="label">Tipo di pane:</span> <?php echo $pane ?></p>
        <p><span class="label">Tipo di carne:</span> <?php echo $hamburger ?></p>
        <p><span class="label">Ingredienti aggiuntivi:</span> <?php echo implode(', ',$ingredienti); ?></p>
    </div>
 
    <a class="btn" href="index.html">Nuova prenotazione</a>

    <footer>
        <a href="mailto:10933916@itisrossi.vi.it">Mail aziendale</a>
        <p>Credits: <i>Andrea Bassan</i></p>
    </footer>

</body>
</html>
