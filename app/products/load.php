<?php
    include "../../security/database/connection.php";
    $code = $_POST['code'];

    if ($code == 'categories') { //todas as categories

        $sql = "SELECT id, name FROM categories";
        $stm_sql = $db_connection -> prepare($sql);
        $stm_sql -> execute();
        $data = $stm_sql -> fetchAll(PDO::FETCH_ASSOC);

    } else if ($code == "") { //todos os products

        $sql = "SELECT code, categories.name, model, value, products.description FROM products INNER JOIN categories ON products.categories_id = categories.id";
        $stm_sql = $db_connection -> prepare($sql);
        $stm_sql -> execute();
        $data = $stm_sql -> fetchAll(PDO::FETCH_ASSOC);

    } else { //produto em alteracao

        $sql = "SELECT model, value, description, categories_id FROM products WHERE code = :code";
        $stm_sql = $db_connection -> prepare($sql);
        $stm_sql -> bindParam(':code', $code);
        $stm_sql -> execute();
        $data = $stm_sql -> fetch(PDO::FETCH_ASSOC);

    }   
    echo json_encode($data);
?>