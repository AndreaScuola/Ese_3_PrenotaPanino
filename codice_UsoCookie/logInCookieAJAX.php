<?php
session_start();
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "db_accessiPanineria");
if ($conn->connect_error) {
    echo json_encode(["success" => false, "msg" => "Errore di connessione"]);
    exit();
}

/* ===== LOGIN ===== */
if ($_POST['action'] === "login") {

    $email = $_POST['emailIn'];
    $pwd   = $_POST['pwdIn'];

    $stmt = $conn->prepare("SELECT id, password FROM utenti WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id, $password);

    if ($stmt->fetch()) {
        if ($pwd === $password) {   // (uguale al tuo codice)
            $_SESSION['user_id'] = $id;
            $_SESSION['email'] = $email;

            echo json_encode([
                "success" => true,
                "msg" => "<p style='color:green;'>Login effettuato con successo!</p>"
            ]);
            exit();
        } else {
            echo json_encode([
                "success" => false,
                "msg" => "<p style='color:red;'>Password errata!</p>"
            ]);
            exit();
        }
    } else {
        echo json_encode([
            "success" => false,
            "msg" => "<p style='color:red;'>Utente inesistente!</p>"
        ]);
        exit();
    }
}

/* ===== REGISTRAZIONE ===== */
if ($_POST['action'] === "signup") {

    $email = $_POST['emailUp'];
    $pwd1  = $_POST['pwdUp1'];
    $pwd2  = $_POST['pwdUp2'];

    $stmt = $conn->prepare("SELECT id FROM utenti WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo json_encode([
            "success" => false,
            "msg" => "<p style='color:red;'>Email già registrata!</p>"
        ]);
        exit();
    }

    if ($pwd1 !== $pwd2) {
        echo json_encode([
            "success" => false,
            "msg" => "<p style='color:red;'>Le password non corrispondono!</p>"
        ]);
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO utenti (email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $pwd1);

    if ($stmt->execute()) {
        echo json_encode([
            "success" => true,
            "msg" => "<p style='color:green;'>Registrazione completata!</p>"
        ]);
        exit();
    }
}

$conn->close();