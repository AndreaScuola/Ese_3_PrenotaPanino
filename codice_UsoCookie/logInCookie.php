<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Connessione al DB
    $conn = new mysqli("localhost", "root", "", "db_accessiPanineria");

    if ($conn -> connect_error)
        die("Errore connessione: " . $conn -> connect_error);

    //LOGIN
    if (isset($_POST['emailIn']) && isset($_POST['pwdIn'])) {

        $email = $_POST['emailIn'];
        $pwd = $_POST['pwdIn'];

        $stmt = $conn->prepare("SELECT id, password FROM utenti WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result -> num_rows == 1) {
            $row = $result->fetch_assoc();

            if ($pwd == $row['password']) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['email'] = $email;
                $loginMsg = "<p style='color:green;'>Login effettuato con successo!</p>";
            } else {
                $loginMsg = "<p style='color:red;'>Password errata!</p>";
            }
        } else {
            $loginMsg = "<p style='color:red;'>Utente inesistente!</p>";
        }
    }


    //REGISTRAZIONE
    if (isset($_POST['emailUp']) && isset($_POST['pwdUp1']) && isset($_POST['pwdUp2'])) {

        $email = $_POST['emailUp'];
        $pwd1 = $_POST['pwdUp1'];
        $pwd2 = $_POST['pwdUp2'];

        $stmt = $conn->prepare("SELECT id, password FROM utenti WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result -> num_rows > 0) 
            $signupMsg = "<p style='color:red;'>Email già registrata!</p>";
        else if ($pwd1 !== $pwd2) 
            $signupMsg = "<p style='color:red;'>Le password non corrispondono!</p>";
        else {
            $stmt = $conn->prepare("INSERT INTO utenti (email, password) VALUES (?, ?)");
            $stmt -> bind_param("ss", $email, $pwd1);

            if ($stmt -> execute() === TRUE) 
                $signupMsg = "<p style='color:green;'>Registrazione completata!</p>";
             else 
                $signupMsg = "<p style='color:red;'>Email già registrata!</p>";
        }
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

    <!-- LOGIN -->
    <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
        <div class="signin">
            <h2>Login</h2>

            <?php if (!empty($loginMsg)) echo $loginMsg; ?>

            <label for="emailIn">Email:</label>
            <input type="email" id="emailIn" name="emailIn" required>

            <label for="pwdIn">Password:</label>
            <input type="password" id="pwdIn" name="pwdIn" required>
        </div>

        <div class="btnGestione">
            <button type="submit">Accedi</button>
            <button type="reset">Cancella</button>
        </div>
    </form>

    <br><hr><br>

    <!-- REGISTRAZIONE -->
    <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
        <div class="signup">
            <h2>Registrazione</h2>

            <?php if (!empty($signupMsg)) echo $signupMsg; ?>

            <label for="emailUp">Email:</label>
            <input type="email" id="emailUp" name="emailUp" required>

            <label for="pwdUp1">Password:</label>
            <input type="password" id="pwdUp1" name="pwdUp1" required>

            <label for="pwdUp2">Ripeti Password:</label>
            <input type="password" id="pwdUp2" name="pwdUp2" required>
        </div>

        <div class="btnGestione">
            <button type="submit">Registrati</button>
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
