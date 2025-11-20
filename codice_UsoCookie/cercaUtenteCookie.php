<?php
session_start();

$loginMsg = "";
$tabellaUtenti = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = new mysqli("localhost", "root", "", "db_accessiPanineria");
    if ($conn->connect_error)
        die("Errore connessione: " . $conn->connect_error);

    //SHOW ALL USERS
    if (isset($_POST['showAll'])) {
        $query = "SELECT id, email, password, nominativo, fidelityCard FROM utenti";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $tabellaUtenti .= "<p><b>Record trovati: " . $result->num_rows . "</b></p>";
            $tabellaUtenti .= "<table border='1' cellpadding='6'>
                                <tr>
                                    <th>ID</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Nominativo</th>
                                    <th>Fidelity Card</th>
                                </tr>";

            while ($row = $result->fetch_assoc()) {
                $tabellaUtenti .= "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['email']}</td>
                                    <td>{$row['password']}</td>
                                    <td>{$row['nominativo']}</td>
                                    <td>{$row['fidelityCard']}</td>
                                   </tr>";
            }

            $tabellaUtenti .= "</table>";
        } else
            $tabellaUtenti = "<p style='color:red;'>Nessun utente trovato.</p>";
    }
    //SEARCH BY ID
    else if (!empty($_POST['IdUtente'])) {
        $id = $_POST['IdUtente'];

        $stmt = $conn->prepare("SELECT id, email, password, nominativo, fidelityCard FROM utenti WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
    }
    //SEARCH BY NOMINATIVO
    else if (!empty($_POST['nominativoUtente'])) {
        $nominativoUtente = $_POST['nominativoUtente'];

        $stmt = $conn->prepare("SELECT id, email, password, nominativo, fidelityCard FROM utenti WHERE nominativo = ?");
        $stmt->bind_param("s", $nominativoUtente);
        $stmt->execute();
        $result = $stmt->get_result();
    }
    else
        $loginMsg = "<p style='color:red;'>Inserire un ID o un Nominativo valido!</p>";

    //OUTPUT RISULTATO SINGOLO UTENTE
    if (!isset($_POST['showAll']) && isset($result) && $result->num_rows == 1) {
        unset($_SESSION['showAll']);
        $row = $result->fetch_assoc();

        $_SESSION['user_id'] = $row['id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['nominativoUtente'] = $row['nominativo'];
        $_SESSION['fidelityCard'] = $row['fidelityCard'];

        $loginMsg = "<p style='color:green;'>Utente trovato <br>
                        ID: {$_SESSION['user_id']}, 
                        Email: {$_SESSION['email']}, 
                        Password: {$_SESSION['password']}, 
                        Nominativo: {$_SESSION['nominativoUtente']}, 
                        Fidelity Card: {$_SESSION['fidelityCard']}
                    </p>";
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">

    <meta name="viewport">
    <title>Accedi o Registrati</title> 
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <nav class="navBar">
        <a href="https://www.itisrossi.edu.it/">Home</a>
        <a href="indexCookie.php">Prenotazioni con Cookie</a>
    </nav>

    <header>
        <h1>Accedi o Registrati</h1>
    </header>

    <!-- FORM RICERCA -->
    <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
        <div class="searchUser">
            <h2>Ricerca</h2>

            <?php if (!empty($loginMsg)) echo $loginMsg; ?>

            <label for="IdUtente">ID:</label>
            <input type="number" id="IdUtente" name="IdUtente">

            <label for="nominativoUtente">Nominativo:</label>
            <input type="text" id="nominativoUtente" name="nominativoUtente">
        </div>

        <div class="btnGestione">
            <button type="submit">Cerca</button>
            <button type="submit" name="showAll">Mostra tutti</button>
            <button type="reset">Cancella</button>
        </div>
    </form>

    <br>

    <div>
        <?php echo $tabellaUtenti; ?>
    </div>

    <footer>
        <a href="mailto:10933916@itisrossi.vi.it">Contatti</a>
        <p>Credits: <i>Andrea Bassan</i></p>
    </footer>
</body>
</html>
