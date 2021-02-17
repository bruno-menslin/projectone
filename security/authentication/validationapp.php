<?php
    if (!isset($_SESSION['id']) || !isset($db_connection)) {
        header("Location: /projectone/index.php");
        exit;
    }
?>