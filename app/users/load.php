<?php
    include "../../security/database/connection.php";
    // include "../../security/authentication/validation.php";

    $sql = "SELECT * FROM usuarios"; // sintaxe sql

    $stm_sql = $db_connection -> prepare($sql); // transforma a sintaxe em intrução e armazena na variável $stm_sql

    $stm_sql -> execute(); // executa a instrução

    $users = $stm_sql -> fetchAll(PDO::FETCH_ASSOC); // busca todo o retorno da execução, de maneira nominal, e armazena na variável users

    echo json_encode($users);
?>