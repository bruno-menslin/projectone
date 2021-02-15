<?php
    include "../../security/database/connection.php";
    $codigo = $_POST['code'];

    if ($codigo == 'categories') { //todas as categorias

        $sql = "SELECT id, nome FROM categorias";
        $stm_sql = $db_connection -> prepare($sql);
        $stm_sql -> execute();
        $data = $stm_sql -> fetchAll(PDO::FETCH_ASSOC);

    } else if ($codigo == "") { //todos os produtos

        $sql = "SELECT codigo, categorias.nome, modelo, valor, produtos.descricao FROM produtos INNER JOIN categorias ON produtos.categorias_id = categorias.id";
        $stm_sql = $db_connection -> prepare($sql);
        $stm_sql -> execute();
        $data = $stm_sql -> fetchAll(PDO::FETCH_ASSOC);

    } else { //produto em alteracao

        $sql = "SELECT modelo, valor, descricao, categorias_id FROM produtos WHERE codigo = :codigo";
        $stm_sql = $db_connection -> prepare($sql);
        $stm_sql -> bindParam(':codigo', $codigo);
        $stm_sql -> execute();
        $data = $stm_sql -> fetch(PDO::FETCH_ASSOC);

    }   
    echo json_encode($data);
?>