<?php
session_start();

if (!isset($_SESSION['ordini'])) {
    $_SESSION['ordini'] = array();
}

// Controlla se ci sono prodotti inviati
if (isset($_POST['prodotti']) && is_array($_POST['prodotti'])) {
    foreach ($_POST['prodotti'] as $prodotto) {
        $_SESSION['ordini'][] = $prodotto;
    }
}

// Ritorna i dati come JSON
header('Content-Type: application/json');
echo json_encode($_SESSION['ordini']);
?>