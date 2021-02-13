<?php
    if (!isset($_SESSION['idsessao']) || !isset($db_connection)) {
        header("Location: /projectone/index.php?mensagem=Entre com seu usuário e senha para acessar esta página");
        exit;
    }
?>