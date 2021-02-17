<?php
    include "../../security/database/connection.php";
    $id = $_POST['id'];

    if ($id == "") {
        $sql = "SELECT * FROM users"; // sintaxe sql

        $stm_sql = $db_connection -> prepare($sql); // transforma a sintaxe em intrução e armazena na variável $stm_sql

        $stm_sql -> execute(); // executa a instrução

        $users = $stm_sql -> fetchAll(PDO::FETCH_ASSOC); // busca todo o retorno da execução, de maneira nominal, e armazena na variável users

        echo json_encode($users);
    } else {
        $sql = "SELECT email, username FROM users WHERE id = :id";
        $stm_sql = $db_connection -> prepare($sql);
        $stm_sql -> bindParam(':id', $id);
        $stm_sql -> execute();
        $user = $stm_sql -> fetch(PDO::FETCH_ASSOC);

        echo json_encode($user);
    }   
?>