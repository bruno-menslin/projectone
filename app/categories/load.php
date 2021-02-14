<?php
    include "../../security/database/connection.php";
    $id = $_POST['id'];

    if ($id == "") {
        $sql = "SELECT * FROM categorias"; //sintaxe
        $stm_sql = $db_connection -> prepare($sql); //sintaxe em instrucao
        $stm_sql -> execute(); //executa a instrucao
        $categories = $stm_sql -> fetchAll(PDO::FETCH_ASSOC); //armazena o resultado

        echo json_encode($categories);
    } else {
        $sql = "SELECT nome, descricao FROM categorias WHERE id = :id";
        $stm_sql = $db_connection -> prepare($sql);
        $stm_sql -> bindParam(':id', $id);
        $stm_sql -> execute();
        $category = $stm_sql -> fetch(PDO::FETCH_ASSOC);

        echo json_encode($category);
    }
?>