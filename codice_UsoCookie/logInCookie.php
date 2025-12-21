<?php
session_start();
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
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
<form id="loginForm">
    <div class="signin">
        <h2>Login</h2>

        <div id="loginMsg"></div>

        <label>Email:</label>
        <input type="email" name="emailIn" required>

        <label>Password:</label>
        <input type="password" name="pwdIn" required>
    </div>

    <div class="btnGestione">
        <button type="submit">Accedi</button>
        <button type="reset">Cancella</button>
    </div>
</form>

<br><hr><br>

<!-- REGISTRAZIONE -->
<form id="signupForm">
    <div class="signup">
        <h2>Registrazione</h2>

        <div id="signupMsg"></div>

        <label>Email:</label>
        <input type="email" name="emailUp" required>

        <label>Password:</label>
        <input type="password" name="pwdUp1" required>

        <label>Ripeti Password:</label>
        <input type="password" name="pwdUp2" required>
    </div>

    <div class="btnGestione">
        <button type="submit">Registrati</button>
        <button type="reset">Cancella</button>
    </div>
</form>

<footer>
    <a href="mailto:10933916@itisrossi.vi.it">Contatti</a>
    <p>Credits: <i>Andrea Bassan</i></p>
</footer>

<script>
// LOGIN AJAX
document.getElementById("loginForm").addEventListener("submit", function(e) {
    e.preventDefault();

    let xhr = new XMLHttpRequest();
    let formData = new FormData(this);
    formData.append("action", "login");

    xhr.open("POST", "logInCookieAJAX.php", true);
    xhr.onload = function () {
        let res = JSON.parse(xhr.responseText);
        document.getElementById("loginMsg").innerHTML = res.msg;

        /*
        if (res.success) {
            setTimeout(() => {
                window.location.href = "areaRiservata.php";
            }, 800);
        }*/
    };
    xhr.send(formData);
});

// REGISTRAZIONE AJAX
document.getElementById("signupForm").addEventListener("submit", function(e) {
    e.preventDefault();

    let xhr = new XMLHttpRequest();
    let formData = new FormData(this);
    formData.append("action", "signup");

    xhr.open("POST", "logInCookieAJAX.php", true);
    xhr.onload = function () {
        let res = JSON.parse(xhr.responseText);
        document.getElementById("signupMsg").innerHTML = res.msg;
    };
    xhr.send(formData);
});
</script>

</body>
</html>
