<?php
    setcookie('ordinePanineria', '', time() - 3600, '/');
    header("Location: indexCookie.php");
    exit;
?>