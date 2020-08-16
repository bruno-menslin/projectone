<?php
    include "../../security/authentication/validation.php";

    // session_start();
    session_unset(); //'limpar' as variáveis
    session_destroy(); //destruir
    header("Location: ../../index.php");
?>